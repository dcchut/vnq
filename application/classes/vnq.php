<?php defined('SYSPATH') or die('No direct script access.');

class VNQ {
    public static function is_logged_in()
    {
        return (Session::instance()->get('logged_in', FALSE));
    } 
    
    public static function login()
    {
        return (Session::instance()->set('logged_in', TRUE));
    }
    
    public static function logout()
    {
        return (Session::instance()->set('logged_in', FALSE));
    }
    
    public static function render_quote(ORM $quote, $moderate = FALSE, $end_break = FALSE)
    {
         return View::factory('quotes/quote', array('quote' => $quote, 
                                                    'moderate' => $moderate,
                                                    'end_break' => $end_break,));
    }
}