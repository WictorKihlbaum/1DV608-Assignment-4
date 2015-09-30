<?php

/**
 * Created by PhpStorm.
 * User: wk222as
 * Date: 2015-09-23
 * Time: 12:26
 */
class UserModel {

    private $username;
    private $password;

    // 'UserModel' will contain the form input the user posted.
    public function __construct($username, $password) {
        
        $this -> username = $username;
        $this -> password = $password;
    }

    public function getUserName() {

        return $this -> username;
    }

    public function getPassword() {

        return $this -> password;
    }
}