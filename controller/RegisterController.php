<?php

class RegisterController {
    
    private $registerView;
    private $registerModel;
    private $loginView;
    private $loginModel;
    private $registeredUsersFile = './Users/RegisteredUsers.txt';
    
    
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
                $this -> saveNewUserToTextFile($newUser);
                $this -> registerView -> setRegisteredNewUserFeedbackMessage();
            }
  
        } catch (UserAlreadyExistsException $e) {
            
            $this -> registerView -> setUserAlreadyExistsFeedbackMessage();
        }
    }
    
    private function saveNewUserToTextFile($newUser) {
                
        // Open the file to get existing content.
        $fileContent = file_get_contents($this -> registeredUsersFile);
        // Save new user to the textfile.
        $fileContent .= "\nUsername: " . $newUser -> getUserName() . " Password: " . $newUser -> getPassword();
        // Write the content back to the textfile.
        file_put_contents($this -> registeredUsersFile, $fileContent);
    }
    
}