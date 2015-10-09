<?php

class NavigationView {
    
    private static $registerUserLink = "NavigationView::RegisterUserLink";
    private static $registerURL = "register";
    
    
    public function renderNavigationLink() {
        
        if (!$this -> userWantsToRegister()) {
            
             return $this -> getLinkToRegisterForm();
            
        } else {
            
            return $this -> getLinkToGoBack();
        }
    }
    
    private function getLinkToRegisterForm() {
	    
	    return '<a href="?' . self::$registerURL . '" name="' . self::$registerUserLink . '">Register a new user</a>';
 	}
    
    private function getLinkToGoBack() {
        
		return "<a href='?'>Back to login</a>";
	}
	
	private function userWantsToRegister() {
	    
	    return isset($_GET[self::$registerURL]);
	}
	
	public function getRegisterURL() {
	    
	    return self::$registerURL;
	}
	
	public function navigateToIndexURL() {
	    
		header('Location:/?');
		exit();
	}
	
}