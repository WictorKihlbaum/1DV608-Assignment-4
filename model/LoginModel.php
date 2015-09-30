<?php

/**
 * Created by PhpStorm.
 * User: wk222as
 * Date: 2015-09-23
 * Time: 12:25
 */
class LoginModel {

    private $sessionModel;
    
    // These two variables will act as stored database values for an already registered user.
    private $registeredUserName = "Admin";
    private $registeredPassword = "Password";
    
    
    public function __construct($sessionModel) {
        
        $this -> sessionModel = $sessionModel;
    }

    public function validateUserInput($user) {
        // Validate user input and throw an exception if one doesn't match.
        if ($this -> registeredUserName !== $user -> getUserName() || 
            $this -> registeredPassword !== $user -> getPassword()) {
            
            throw new \Exception("Wrong name or password");
        }           
        // If correct user input create session.
        $this -> sessionModel -> setUserSession();
    }
    
    public function logoutUser() {
        // Remove user-session when user is being logged out.
        $this -> sessionModel -> unsetUserSession();
    }
    
    public function loggedInUser() {
        // Return session for user.
        return $this -> sessionModel -> getUserSession();
    }
    
}