<?php

class Controller_Site extends Controller_Template
{      
    public $template    = 'site/template'; 
    public $auto_render = TRUE;
    
    protected function generate_heading($heading)
    {
        return View::factory('site/heading', array('heading' => $heading));
    }
    
    protected function home()
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
}