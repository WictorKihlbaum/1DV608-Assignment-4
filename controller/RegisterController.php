<?php

class RegisterController {
    
    private $registerView;
    private $registerModel;
    private $navigationView;
    
    
    public function __construct($registerView, $registerModel, $navigationView, $loginView) {
        
        $this -> registerView = $registerView;
        $this -> registerModel = $registerModel;
        $this -> navigationView = $navigationView;
        $this -> loginView = $loginView;
    }
    
    public function verifyUserState() {
        
        try {
            
            if (!$this -> registerModel -> loggedInUser() &&
                 $this -> registerView -> didUserPressRegister()) {
            
                $this -> registerUser();
            
            } else if ($this -> registerModel -> loggedInUser() &&
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
                //$this -> loginView -> setRegisteredNewUserFeedbackMessage();
                $this -> navigationView -> navigateToIndexURL();
            }
  
        } catch (UserAlreadyExistsException $e) {
            
            $this -> registerView -> setUserAlreadyExistsFeedbackMessage();
        }
    }
    
}