<?php
class Model_Quote extends ORM
{
    public static function vote($quote_id)
    {     
        $quote = self::factory('quote')->where('id', '=', $quote_id)
                                       ->find_all();
        
        if (count($quote) == 0)
            return FALSE;
            
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
    
    public function total()
    {
        return (int)$this->reset()
                         ->where('status', '=', 1)
                         ->count_all();
    }
    
    public function unmoderated()
    {
        return $this->reset()
                    ->where('status', '=', 2)
                    ->order_by('date', 'ASC')
                    ->find_all();
    }
    
    public function is_public()
    {
		return ($this->loaded() && $this->status == 1);
	}
}