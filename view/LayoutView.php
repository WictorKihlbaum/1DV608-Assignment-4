<?php

class LayoutView {
  
  private static $registerUserLink = "LayoutView::RegisterUserLink";
  
  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv, RegistrationView $registrationView) {
    
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this -> createRegistrationLink($isLoggedIn) . '
          ' . $this -> renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $v -> response($isLoggedIn) . '
              ' . $dtv -> show() . '
              ' . $registrationView -> generateRegistrationFormHTML() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    
    if ($isLoggedIn) {
      
      return '<h2>Logged in</h2>';
      
    } else {
      
      return '<h2>Not logged in</h2>';
    }
  }
  
  private function createRegistrationLink($isLoggedIn) {
    
    if (!$isLoggedIn) {
      
      return ' <a href="#" name="' . self::$registerUserLink . '">Register a new user</a> ';
    }
  }
  
  private function didUserPressRegisterNewUser() {
    
    return isset($_POST[self::$registerUserLink]);
  }
  
}
