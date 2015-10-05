<?php

class RegisterModel {
    
    // These two variables will act as stored database values for an already registered user.
    //private $registeredUserName = "Admin";
    //private $registeredPassword = "Password";
    
    
    public function validateUserInput($newUser) {
        
        $inputToSearchFor = "Username: " . $newUser -> getUserName() . " Password: " . $newUser -> getPassword();
        $textFileToSearchIn = file_get_contents("./Users/RegisteredUsers.txt");
        
        $textFileToSearchIn = explode("\n", $textFileToSearchIn);
        
        if (in_array($inputToSearchFor, $textFileToSearchIn)){
        
            throw new \UserAlreadyExistsException("User exists, pick another username");
        }
        

        /*
        if ($this -> registeredUserName == $newUser -> getUserName() && 
            $this -> registeredPassword == $newUser -> getPassword()) {
            
            throw new \UserAlreadyExistsException("User exists, pick another username");
        } 
        */
    }
}