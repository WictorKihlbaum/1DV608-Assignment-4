<?php

/**
 * Created by PhpStorm.
 * User: wk222as
 * Date: 2015-09-23
 * Time: 12:23
 */
class LoginController {

    private $loginView;
    private $loginModel;


    public function __construct($loginView, $loginModel) {

        $this -> loginView = $loginView;
        $this -> loginModel = $loginModel;
    }
    
    public function verifyUserState() {
        // If user's not already logged in - log in user.
        if (!$this -> loginModel -> loggedInUser() && 
            $this -> loginView -> didUserPressLogin()) {
              
              $this -> loginUser();
        // If user pressed logout while logged in - log out user.
        } else if ($this -> loginModel -> loggedInUser() && 
                   $this -> loginView -> didUserPressLogout()) {
              
              $this -> logOutUser();
        }
        // Return session for user.
        return $this -> loginModel -> loggedInUser();
    }
    
    public function loginUser() {
        // Get user object containing the posted form inputs (username/password).
        $user = $this -> loginView -> getUser();
        
        try { // Validate user input and set feedback message thereafter.
            
            if ($user != null) {
                
                $this -> loginModel -> validateUserInput($user);
                $this -> loginView -> setLoginFeedbackMessage();
            }
  
        } catch (\Exception $e) {
            
            $this -> loginView -> setWrongInputFeedbackMessage();
        }
    }
    
    public function logOutUser() {
        // Logout user and set/present feedback message.
        $this -> loginView -> setLogoutFeedbackMessage();
        $this -> loginModel -> logoutUser();
    }
    
}