<?php

class RegistrationController {
    
    private $registrationView;
    
    
    public function __construct($registrationView) {
        
        $this -> registrationView = $registrationView;
    }
    
    public function registrateUser() {
        
        if ($this -> registrationView -> didUserPressRegister()) {
            
            echo "TEST";
        }
    }
}