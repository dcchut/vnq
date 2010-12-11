<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Site
{
    public function before() 
    {
        parent::before();

        if (!VNQ::is_logged_in())
            return  self::home();
        
        // All the pages here need the jscript, chuck it in there
        $this->template->scripts = array('admin/jscript');
    }
    
    /**
     *  Present the jscript needed to do admin actions
     */
    public function action_jscript()
    {
        $this->auto_render = FALSE;
        
        $this->request->response = View::factory('admin/jscript');
    }
    
    /**
     *  Show the quotes that need to be moderated
     */
    public function action_moderate()
    {
        $unmoderated = ORM::factory('quote')->unmoderated();
        
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

    /**
     *  Actually moderate a specific quote (done using AJAX)
     */
    public function action_moderate2()
    {
        $id     = (int)Arr::get($_POST, 'id', 0);
        $status = (int)Arr::get($_POST, 'status', 0);
		$text   = Arr::get($_POST, 't', FALSE);
		
        // status must be 1, 2, 3
        if (!in_array($status, array(1, 2, 3)) || !Model_Quote::exists($id))
            exit('0');

        // save the stuff
        $quote         = ORM::factory('quote', $id);
        $quote->status = $status;
        
        if ($text != FALSE)
            $quote->quote  = $text;
        
        $quote->save();

        exit('1');
    }
}