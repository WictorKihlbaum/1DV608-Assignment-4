<?php

class LoginModel {

    private $sessionModel;
    
    
    public function __construct($sessionModel) {
        
        $this -> sessionModel = $sessionModel;
    }

    public function validateUserInput($user) {
        
        $inputToSearchFor = "Username: " . $user -> getUserName() . " Password: " . $user -> getPassword();
        $textFileToSearchIn = file_get_contents("./Users/RegisteredUsers.txt");
        $textFileToSearchIn = explode("\n", $textFileToSearchIn);
        
        if (!in_array($inputToSearchFor, $textFileToSearchIn)) {
        
            throw new \WrongInputException("Wrong name or password");
        }
        
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