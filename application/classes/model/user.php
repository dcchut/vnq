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

    public static function username_exists($username)
    {
        return (ORM::factory('user')->where('username', '=', $username)->count_all() > 0);
    }

    public static function add_user($username, $password, $secret)
    {
        if (self::username_exists($username))
            return FALSE;

        // is the secret key valid
        if (sha1($secret) !== 'ff76d91095f2f370722254461ad8a9f0424b3093')
            return FALSE;

        // create the user
        $user = ORM::factory('user');
        $user->username = $username;
        $user->password = sha1($password);
        $user->save();

        return $user;
    }
}