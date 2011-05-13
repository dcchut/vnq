<?php

class Controller_Site extends Controller_Template
{      
    public $template    = 'site/template'; 
    public $auto_render = TRUE;
    
    protected static function home()
    {
        return Request::instance()->redirect('');
    }
    
    public function before()
    {
        parent::before();
        
        if ($this->auto_render)
        {
  	    	$this->template->title   = 'VNQ';
  	    	$this->template->content = '';
  			
  	    	$this->template->styles = array();
  		    $this->template->scripts = array();
  		    
  		    // only need to count these if we are logged in as an admin
            if (VNQ::is_logged_in()) {
                $this->template->unmoderated_quotes = count(ORM::factory('quote')->unmoderated());
  		    } else {
                $this->template->unmoderated_quotes = 0;
            }
        }
    }
    
    public function after()
    {
        parent::after();
        
        if ($this->auto_render)
        {
            $styles = array('media/css/style.css',);
            
            $this->template->styles = array_merge($this->template->styles, $styles);
        }
    }

    public function action_login()
    {
        if (VNQ::is_logged_in())
            self::home();

        $this->template->subtitle = 'login';
        $this->template->content  = View::factory('site/login');
    }
    
    public function action_login2()
    {
        // try to get the user record for this person
        $user = Model_User::get_user(Arr::get($_POST, 'username', FALSE),
                                     Arr::get($_POST, 'password', FALSE));

        // pee off, peon
        if (!$user)
            Request::instance()->redirect('site/login');
            
        VNQ::login();
        self::home();
    }

    /**
     * Logout of a current session
     */
    public function action_logout()
    {
        VNQ::logout();
        self::home();
    }

    /**
     * Here we show the javascript (dynamically generated)
     * required to operate VNQ
     */
    public function action_vnqjs()
    {
        $this->auto_render       = FALSE;
        $this->request->response = View::factory('site/vnqjs');
    }

    /**
     * file not fond
     */
    public function action_404()
    {
        $this->template->subtitle = '404 error';
        $this->template->content  = 'the page you were looking for could not be found.<br />';
    }
}