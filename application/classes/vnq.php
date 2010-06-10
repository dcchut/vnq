<?php defined('SYSPATH') or die('No direct script access.');

class VNQ {
    public static function is_admin()
    {
        return $_SERVER['REMOTE_ADDR'] == '127.0.0.1';
    } 
    
    public static function render_quote(ORM $quote, $moderate = FALSE, $end_break = FALSE)
    {
         return View::factory('quotes/quote', array('quote' => $quote, 
													'moderate' => $moderate,
													'end_break' => $end_break,));
    }
}