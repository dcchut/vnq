<?php
class Model_Quote extends ORM
{
    public static function insert_quote($text, $status)
    {
        // does this quote exist already?
        $quote = self::reset()->where('quote', '=', $text)
                              ->find_all();
        
        if (count($quote) == 0)
        {
            $quote         = ORM::factory('quote');
            $quote->date   = time();
            $quote->quote  = $text;
            $quote->status = $status;
            
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
                    ->order_by(DB::expr('up - down'), 'DESC')
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
}