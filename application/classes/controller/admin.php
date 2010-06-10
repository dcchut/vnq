<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Site
{
    public function before()
    {
        parent::before();

        if (!VNQ::is_admin())
            return $this->home();
        
        $this->template->scripts = array('media/admin.js');
    }
    
    
    public function action_moderate2()
    {
        $id     = (int)Arr::get($_POST, 'id', 0);
        $status = (int)Arr::get($_POST, 'status', 0);
		$text   = Arr::get($_POST, 't', FALSE);
		
        // rubbish status, throw it away!
        if (!in_array($status, array(1, 2, 3)))
            exit('0');
     
        // does this quote exist?
        $quote = ORM::factory('quotes', $id);
        
        if (!$quote->loaded())
            exit('0');
            
        $quote->status = $status;
        
        if ($text != FALSE)
			$quote->quote = $text;
        
        $quote->save();
            
        exit('1');
    }
    /**
     * 	Special magic JS
     */
    public function action_js()
    {
        header('Content-Type: text/javascript');
        header("cache-control: no-store, no-cache, must-revalidate"); 
        header("Pragma: no-cache");
        echo View::factory('admin/js');
        exit();
    }
    
    public function action_moderate()
    {
        $unmoderated = ORM::factory('quotes')->unmoderated();
        
        if (count($unmoderated) == 0)
        {
			$this->template->content = 'no quotes to moderate';
		}
		else
		{
			foreach ($unmoderated as $quote)
			{
				$this->template->content  .= VNQ::render_quote($quote, TRUE, TRUE);
			}
        }
    }
}