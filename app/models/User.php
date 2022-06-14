<?php

class User extends Model
{
    private $_sessionName;
    public static $currentLoggedInUser = null;

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

    public static function currentLoggedInUser()
    {
        if (!(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $user = new User();
            $user->findByUserName(Session::get('user_id'));
            self::$currentLoggedInUser = $user;
        }
        return self::$currentLoggedInUser;
    }

    public function login()
    {
        Session::set($this->_sessionName, $this->id);
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