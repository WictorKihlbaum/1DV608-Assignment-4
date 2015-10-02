<?php

class RegisterController {
    
    private $registerView;
    
    
    public function __construct($registerView) {
        
        $this -> registerView = $registerView;
    }
    
    public function registerUser() {
        
        if ($this -> registerView -> didUserPressRegister()) {
            
            echo "TEST";
        }
    }
}