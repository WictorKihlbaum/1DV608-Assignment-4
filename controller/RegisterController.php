<?php

class RegisterController {
    
    private $registerView;
    private $registerModel;
    private $loginView; // Do I use this??
    private $loginModel; // Do I need to use this??
    //private $registeredUsersFile = './UserDAL/RegisteredUsers.txt';
    
    
    public function __construct($registerView, $registerModel, $loginView, $loginModel) {
        
        $this -> registerView = $registerView;
        $this -> registerModel = $registerModel;
        $this -> loginView = $loginView;
        $this -> loginModel = $loginModel;
    }
    
    public function verifyUserState() {
        
        try {
            
            if (!$this -> loginModel -> loggedInUser() &&
                 $this -> registerView -> didUserPressRegister()) {
            
                $this -> registerUser();
            
            } else if ($this -> loginModel -> loggedInUser() &&
                       $this -> registerView -> didUserPressRegister()) {
            
                throw new \RegisterWhileLoggedInException();
            }
            
        } catch (RegisterWhileLoggedInException $e) {
            
            $this -> registerView -> setRegisterWhileLoggedInFeedbackMessage();
        }
    }
    
    private function registerUser() {
        
         $newUser = $this -> registerView -> getNewUser();
         
         try {
            
            if ($newUser != null) {
                
                $this -> registerModel -> validateUserInput($newUser);
                $this -> registerView -> setRegisteredNewUserFeedbackMessage();
            }
  
        } catch (UserAlreadyExistsException $e) {
            
            $this -> registerView -> setUserAlreadyExistsFeedbackMessage();
        }
    }
    
}