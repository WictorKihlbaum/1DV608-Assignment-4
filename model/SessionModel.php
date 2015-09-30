<?php



class SessionModel {
    
    private static $userSession = "SessionModel::UserSession";
    
    
    public function __construct() {
        // Start the session as first thing to do when 'SessionModel' is being created. 
        session_start();
    }
    
    public function setUserSession() {
        // This will keep track on whether the user is logged in or not.
        $_SESSION[self::$userSession] = true;
    }
    
    public function unsetUserSession() {
        // Removes the created session.
        unset($_SESSION[self::$userSession]);
    }
    
    public function getUserSession() {
        
        if (isset($_SESSION[self::$userSession])) {
        
            return $_SESSION[self::$userSession];
        }
        
        return false;
    }
}