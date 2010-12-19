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
        return $this->reset()
                    ->where('status', '=', 1)
                    ->limit((int)$limit)
                    ->offset((int)$offset)
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
                    ->order_by(DB::expr('up'), 'DESC')
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

    public function ninwa()
    {
        /*
         * 	protected static $_db_methods = array
	(
		'where', 'and_where', 'or_where', 'where_open', 'and_where_open', 'or_where_open', 'where_close',
		'and_where_close', 'or_where_close', 'distinct', 'select', 'from', 'join', 'on', 'group_by',
		'having', 'and_having', 'or_having', 'having_open', 'and_having_open', 'or_having_open',
		'having_close', 'and_having_close', 'or_having_close', 'order_by', 'limit', 'offset', 'cached'
	);
         */
        return $this->reset()->select('*')->from('quotes')->where('quote', 'like', '%ninwa%')
                                                          ->or_where('quote', 'like', '%ninja%')
                                                          ->or_where('quote', 'like', '%nina%')
                                                          ->order_by('up', 'DESC')
                                                          ->find_all();
    }
}