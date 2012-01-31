<?php
class Model_Quote extends ORM
{
    /**
     * Register an upvote for this quote
     * @param integer $quote_id
     * @return bool
     */
    public static function vote($quote_id)
    {
        if (!self::exists($quote_id))
            return FALSE;

        $quote = new Model_Quote($quote_id);
            
        // only vote once per cookie, noob
        $voted = (array)Session::instance()->get('voted');
        
        if (array_key_exists($quote_id, $voted))
            return FALSE;
            
        $voted[$quote_id] = TRUE;
        
        Session::instance()->set('voted', $voted);
            
        $values = array('up' => DB::expr('up + 1'));
            
        DB::update('quotes')->set($values)->where('id', '=', $quote_id)->execute();
        
        return TRUE;
    }

    /**
     * Insert a new quote with $text and $status into the DB
     * @param string $text
     * @param integer $status
     * @return <type>
     */
    public static function insert_quote($text, $status)
    {
        // does this quote exist already?
        $quote = self::factory('quote')->where('quote', '=', $text)
                                       ->find_all();
        
        if (count($quote) == 0)
        {
            $quote         = ORM::factory('quote');
            $quote->date   = time();
            $quote->quote  = $text;
            $quote->status = $status;
            $quote->up     = 0;
            $quote->down   = 0;
            $quote->ip     = Request::$client_ip;
            
            return $quote->save();
        }
        else
            return FALSE;
    }
    
    /**
     * Recent quotes
     * @param integer $limit
     */
    public function recent($limit, $offset)
    {
        return $this->reset()->where('status', '=', 1)
                             ->and_where_open()
                             ->where('up','>',0)
                             ->or_where(DB::expr(time() . ' - date'),'<',60*60*24*7)
                             ->and_where_close()
                             ->order_by('id', 'DESC')
                             ->find_all();
    }
    
    /**
     * Top 
     * @param integer $limit
     */
    public function top($limit, $offset)
    {
        return $this->reset()
                    ->where('status', '=', 1)
                    ->limit((int)$limit)
                    ->offset((int)$offset)
                    ->order_by('up', 'DESC')
                    ->find_all();
    }

    /**
     * Count the total number of active quotes
     * @return integer
     */
    public function total()
    {
        return (int)$this->reset()
                         ->where('status', '=', 1)
                         ->count_all();
    }

    /**
     * Get all the unmoderated quotes
     * @return Model_Quote
     */
    public function unmoderated()
    {
        return $this->reset()
                    ->where('status', '=', 2)
                    ->order_by('date', 'ASC')
                    ->find_all();
    }

    /**
     * Is this quote publically viewable?
     * @return bool
     */
    public function is_public()
    {
        return ($this->loaded() && $this->status == 1);
    }

    /**
     * Get all the quotes relating to ninwa
     * @return Model_Quote
     */
    public function ninwa()
    {
        return $this->reset()->select('*')->from('quotes')->where('status', '=', 1)
                                                          ->and_where_open()
                                                          ->where('quote', 'like', '%ninwa%')
                                                          ->or_where('quote', 'like', '%ninja%')
                                                          ->or_where('quote', 'like', '%nina%')
                                                          ->and_where_close()
                                                          ->order_by('up', 'DESC')
                                                          ->find_all();
    }
    
    /**
     * Get all the quotes relating to cthulhu
     * @return Model_Quote
     */
    public function cthulhu()
    {
        return $this->reset()->select('*')->from('quotes')->where('status', '=', 1)
                                                          ->where('quote', 'like', '%cthulhu%')
                                                          ->order_by('up', 'DESC')
                                                          ->find_all();
    }
    
    /**
     * Get all the quotes relating to username
     * @return Model_Quote
     */
    public function username()
    {
        return $this->reset()->select('*')->from('quotes')->where('status', '=', 1)
                                                          ->where('quote', 'like', '%username%')
                                                          ->order_by('up', 'DESC')
                                                          ->find_all();
    }
}