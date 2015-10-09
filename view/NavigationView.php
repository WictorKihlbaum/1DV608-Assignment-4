<?php

class NavigationView {
    
    private static $registerURL = "register";
    
    
    public function getLinkToGoBack() {
        
		return "<a href='?'>Back to login</a>";
	}
	
	public function getURLToRegisterForm() {
	    
		return "?" . self::$registerURL; // maybe have to change this.
	}
	
	public function userWantsToRegister() {
	    
	    return isset($_GET[self::$registerURL]);
	}
	
	public function getLinkToRegisterForm() {
	    
	    return '<a href="?' . self::$registerURL . '">Register a new user</a>';
 	}
}