<?php

class RegisterController {
    
    private $registerView;
    private $registerModel;
    private $loginModel;
    
    
    public function __construct($registerView, $registerModel, $loginModel) {
        
        $this -> registerView = $registerView;
        $this -> registerModel = $registerModel;
        $this -> loginModel = $loginModel;
    }
    
    public function verifyUserState() {
        
        if (!$this -> loginModel -> loggedInUser() &&
             $this -> registerView -> didUserPressRegister()) {
            
            $this -> registerUser();
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