<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM {
     public static function exists($id)
    {
        $class  = get_called_class();
        $object = new $class(null);

        return ($object->where($object->_primary_key, '=', $id)
                       ->count_all() == 1);
    }
}