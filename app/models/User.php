<?php

class User extends Model
{
    private $_sessionName;
    public static $currentLoggedInUser = '';

    public function __construct()
    {
        $table = 'user';
        parent::__construct($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
    }

    public function findByUserName($user_id)
    {
        $this->findFirst(['conditions' => 'user_id=?', 'bind' => [$user_id]]);
    }

    //currentLoggedInUser user has the user id
    public static function currentLoggedInUser()
    {
        if (self::$currentLoggedInUser === '') {
            self::$currentLoggedInUser = (Session::get('user_id'));
        }
        return self::$currentLoggedInUser;
    }

    public function login()
    {
        Session::set('user_id', $this->user_id);
        self::$currentLoggedInUser = $this;
    }

    public function logout()
    {
        Session::delete();
        self::$currentLoggedInUser = null;
        return true;
    }

    public function findAllUsers($user_id)
    {
        return $this->_db->find('user', ['conditions' => 'user_id=?', 'bind' => [$user_id]]);
    }
}