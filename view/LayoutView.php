<?php

class LayoutView {
  
  private static $registerUserLink = "LayoutView::RegisterUserLink";
  
  
  public function render($isLoggedIn, LoginView $loginView, DateTimeView $dateTimeView, RegisterView $registerView) {
    
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this -> showNavigationLink($isLoggedIn) . '
          ' . $this -> renderIsLoggedIn($isLoggedIn) . '
          ' . $this -> showForm($isLoggedIn, $loginView, $registerView) . '
          
          <div class="container">
              
              ' . $dateTimeView -> showDateTime() . '
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
  
  // Set correct navigation link and name depending on in which view the user is.
  private function showNavigationLink($isLoggedIn) {
    
    if (!$isLoggedIn && $_SERVER['QUERY_STRING'] != "registration") {
      
      return ' <a href="/?registration" name="' . self::$registerUserLink . '">Register a new user</a> ';

    } else if (!$isLoggedIn && $_SERVER['QUERY_STRING'] == "registration") {
      
      return ' <a href="/?">Back to login</a> ';
    }
    
    return null;
  }
    
  // Check the url-string and show the correct HTML-form.
  private function showForm($isLoggedIn, $loginView, $registerView) {
    
    if ($_SERVER['QUERY_STRING'] == "registration") {
      
      return $registerView -> generateRegisterFormHTML();
  
    } else {
      
      return $loginView -> response($isLoggedIn);
    }
  }
    
}
  
  
  

