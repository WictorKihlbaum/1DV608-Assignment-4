<?php

class RegisterController {
    
    private $registerView;
    private $registerModel;
    private $loginModel;
    private $registeredUserFile = './Users/RegisteredUsers.txt';
    
    
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
                $this -> saveNewUserToTextFile($newUser);
                $this -> registerView -> setRegisteredNewUserFeedbackMessage();
            }
  
        } catch (UserAlreadyExistsException $e) {
            
            $this -> registerView -> setUserAlreadyExistsFeedbackMessage();
        }
    }
    
    private function saveNewUserToTextFile($newUser) {
                
        // Open the file to get existing content.
        $fileContent = file_get_contents($registeredUserFile);
        // Save new user to the textfile.
        $fileContent .= "\nUsername: " . $newUser -> getUserName() . " Password: " . $newUser -> getPassword();
        // Write the content back to the textfile.
        file_put_contents($registeredUserFile, $fileContent);
    }
    
}