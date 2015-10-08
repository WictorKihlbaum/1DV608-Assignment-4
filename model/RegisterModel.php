<?php

class RegisterModel {
    
    private $registeredUsersFile = "./Users/RegisteredUsers.txt";
    
    public function validateUserInput($newUser) {
        
        $inputToSearchFor = "Username: " . $newUser -> getUserName() . " Password: " . $newUser -> getPassword();
        $textFileToSearchIn = file_get_contents($this -> registeredUsersFile);
        $textFileToSearchIn = explode("\n", $textFileToSearchIn);
        
        if (in_array($inputToSearchFor, $textFileToSearchIn)) {
        
            throw new \UserAlreadyExistsException("User exists, pick another username");
        }
    }
}