<?php

class RegisteredUsers {
    
    private $registeredUsers = array();
    
    
    public function addUser($newUserToAdd) {
        
        if (empty($this -> registeredUsers)) {
            
            $this -> registeredUsers[] = $newUserToAdd;
            
        } else {
            
            $userAlreadyExists = 0;
            
            foreach ($this -> registeredUsers as $registeredUser) {
                
                if ($registeredUser -> getUserName() == $newUserToAdd -> getUserName() &&
                    $registeredUser -> getPassword() == $newUserToAdd -> getPassword()) {
                    
                    $userAlreadyExists += 1;
                }
            }
            
            if ($userAlreadyExists == 0) {
                
                $this -> registeredUsers[] = $newUserToAdd;
            }
        }
    }
    
    /*public function doesUserExist($userToMatch) {
        
        $userExist = 0;
        
        foreach ($this -> registeredUsers as $registeredUser) {
                
            if ($registeredUser -> getUserName() == $userToMatch -> getUserName() &&
                $registeredUser -> getPassword() == $userToMatch -> getPassword()) {
                    
                $userExist += 1;
            }
        }
        
        if ($userExist != 0) {
            
            return true;
        }
        
        return false;
    }*/
}