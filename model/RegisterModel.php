<?php

class RegisterModel {
    
    public function validateUserInput($newUser) {
        
        $inputToSearchFor = "Username: " . $newUser -> getUserName() . " Password: " . $newUser -> getPassword();
        $textFileToSearchIn = file_get_contents("./Users/RegisteredUsers.txt");
        $textFileToSearchIn = explode("\n", $textFileToSearchIn);
        
        if (in_array($inputToSearchFor, $textFileToSearchIn)){
        
            throw new \UserAlreadyExistsException("User exists, pick another username");
        }
    }
}