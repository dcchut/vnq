<?php
class Model_User extends ORM 
{

    public static function get_user($username, $password)
    {
        // hash the password, brah
        $password = sha1($password);

        $user = ORM::factory('user')->where('username', '=', $username)
                                    ->where('password', '=', $password)
                                    ->find_all();

        if (count($user) !== 1)
            return FALSE;

        return $user;
    }
}