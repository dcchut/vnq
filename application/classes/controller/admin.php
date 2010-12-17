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

        // parameters to pass to the view
        $view_data = array();

        // here we build the 'top' half of the moderation section
        $view_data['panel'] = '';

        if (count($unmoderated) == 0)
        {
            $view_data['panel'] = 'no quotes to accept';
		}
		else
		{
			foreach ($unmoderated as $quote)
			{
                $view_data['panel'] .= VNQ::render_quote($quote, TRUE, TRUE);
			}
        }

        // what are the moderation options avaiable
        // possibly put this closer to the model ~_~
        $view_data['options'] = array('hide' => 'hide', 'show' => 'show');

        // have we moderated anything?
        $id     = (int)Arr::get($_POST, 'id', 0);
        $action = Arr::get($_POST, 'action', FALSE);

        if ($id > 0 && $action !== FALSE && Model_Quote::exists($id) && in_array($action, $view_data['options']))
        {
            $quote = ORM::factory('quote', $id);

            // i'm not going to allow you to moderate a quote in this fashion
            // unless it's been accepted/denied by a moderator
            if ($quote->status != 2)
            {
                if ($action == 'hide')
                    $quote->status = 3;

                if ($action == 'show')
                    $quote->status = 1;

                // save the quote
                $quote->save();

                // set a message
                $view_data['message'] = 'fiddle successful (' . $id . ', ' . $action . ')';
            }
            else
            {
                $view_data['message'] = 'fiddle failed';
            }
        }

        $this->template->content .= View::factory('admin/moderate', $view_data);
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