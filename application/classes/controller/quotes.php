<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Quotes extends Controller_Site
{
    protected $_quotes_per_page = 1000; // if you make this zero, I will kill you

    public function action_vote()
    {
        $quote_id = (int)Arr::get($_POST, 'id', 0);

        $vote = Model_Quote::vote($quote_id);
 
        if (!$vote)
            exit('0');
        else
            exit('1');
    }
    
    public function action_submit()
    {
        $this->template->subtitle = 'submit a quote';
        $this->template->content  = View::factory('quotes/submit');
    }
    
    public function action_submit2()
    {
        $quote_text = Arr::get($_POST, 'quote');
        
        if (empty($quote_text))
            return self::home();
            
        // insert the quote, it doesn't appear to be empty
        Model_Quote::insert_quote($quote_text, 2);
        
        // show them nice shit
        $this->template->subtitle = 'quote submitted';
        $this->template->content  = View::factory('quotes/submit2');
    }
    
    
    public function action_view($id)
    {
        $quote = ORM::factory('quote', $id);
        
        if (!$quote->loaded() || !$quote->is_public())
            return self::home();

        $this->template->subtitle = 'single quote';
        $this->template->content  = VNQ::render_quote($quote);
    }
    
	/**
	 * 	Show a listing of most recent quotes
	 *  @param integer $page
	 */
	public function action_recent($page = 0)
	{
        $this->template->subtitle = 'recent quotes';
	    $this->template->content  = $this->paged_quotes('recent', $page);
	}
	
	/**
	 * Show the top-ranked quotes
	 * @param integer $page
	 */
	public function action_top($page = 0)
	{
        $this->template->subtitle = 'top quotes';
	    $this->template->content  = $this->paged_quotes('top', $page);
	}

    /**
     * Get all comments relating to ninwa
     */
    public function action_ninwa()
    {
        $quotes = ORM::factory('quote')->ninwa();

        $output = '';

        foreach ($quotes as $quote)
        {
            if ($output != '')
                $output .= '<br />';

            $output .= VNQ::render_quote($quote);
        }

        // set the content to this, as desired
        $this->template->subtitle = 'ninwa quotes';
        $this->template->content  = $output;
    }
	
    /**
     * Get all comments relating to cthulhu
     */
    public function action_cthulhu()
    {
        $quotes = ORM::factory('quote')->cthulhu();

        $output = '';

        foreach ($quotes as $quote)
        {
            if ($output != '')
                $output .= '<br />';

            $output .= VNQ::render_quote($quote);
        }

        // set the content to this, as desired
        $this->template->subtitle = 'cthulhu quotes';
        $this->template->content  = $output;
    }
    
	/**
	 * Show a listing of quotes
	 * @param ORM $quotes
	 * @param integer $page
	 */
	protected function paged_quotes($method, $page)
	{	    
	    // get a positive integer
	    $page = (int)$page;
	    
	    if ($page < 0)
	        $page = 0;
	        
	    // only have $this->_quotes_per_page quotes per page, therefore
	    $offset = $this->_quotes_per_page * $page;
	    
	    // get our quotes object
	    $quotes = ORM::factory('quote')->$method($this->_quotes_per_page, $offset);
	    
	    // run away if we didn't find anything
	    if (count($quotes) == 0)
	    {
	        if ($page > 0)
	            return $this->show_quotes($method, 0); // show the first page, at least
	        else 
	            return 'error: no quotes found';      // we're fucked if we ever get here
	    }
	  
	    $output = '';
	    
	    foreach ($quotes as $quote)
	    {
	        if ($output != '')
	            $output .= '<br />';
	            
	        $output .= VNQ::render_quote($quote);
	    }
	    
	    return $output;
	}
}
