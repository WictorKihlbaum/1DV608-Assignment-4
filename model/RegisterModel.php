<?php

class RegisterModel {
    
    // These two variables will act as stored database values for an already registered user.
    private $registeredUserName = "Admin";
    private $registeredPassword = "Password";
    
    
    public function validateUserInput($newUser) {
       
        if ($this -> registeredUserName == $newUser -> getUserName() && 
            $this -> registeredPassword == $newUser -> getPassword()) {
            
            throw new \UserAlreadyExistsException("User exists, pick another username");
        }         
    }
}