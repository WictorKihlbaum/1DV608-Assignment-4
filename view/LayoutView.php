<?php

class LayoutView {
  
  private static $registerUserLink = "LayoutView::RegisterUserLink";
  private static $registerURL = "register";
  
  
  public function render($isLoggedIn, LoginView $loginView, DateTimeView $dateTimeView, RegisterView $registerView, NavigationView $navigationView) {
    
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 4</h1>
          ' . $navigationView -> renderNavigationLink() . '
          ' . $this -> renderIsLoggedIn($isLoggedIn) . '
          ' . $this -> renderForm($isLoggedIn, $loginView, $registerView, $navigationView) . '
          
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
    
  // Check the url-string and show the correct HTML-form.
  private function renderForm($isLoggedIn, $loginView, $registerView, $navigationView) {
    
    if ($_SERVER['QUERY_STRING'] == $navigationView -> getRegisterURL()) {
      
      return $registerView -> response($isLoggedIn);
  
    } else {
      
      return $loginView -> response($isLoggedIn);
    }
  }
    
}
  
  
  

