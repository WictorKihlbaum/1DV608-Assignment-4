<?php

class LoginView {
	
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	// Feedback messages.
	private static $loginMessage = "Welcome";
	private static $logoutMessage = "Bye bye!";
	private static $missingUserNameMessage = "Username is missing";
	private static $missingPasswordMessage = "Password is missing";
	private static $wrongInputMessage = "Wrong name or password";
	
	private $feedbackMessage = "";
	private $loginModel;
	
	
	public function __construct($loginModel){
		
		$this -> loginModel = $loginModel;
	}
	
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isLoggedIn) {
		
		$message = "";
		/* Whether user is/gets logged in or not, present fitting feedback message and render correct HTML-code.*/
		if ($this -> loginModel -> loggedInUser()) { 
			
			$message = $this -> getFeedbackMessage();
			$response = $this -> generateLogoutButtonHTML($message);
			
		} else {
			
			$message = $this -> getFeedbackMessage();
			$response = $this -> generateLoginFormHTML($message);			
		}

		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {

		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this -> getRequestUserName() . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	public function didUserPressLogin() {

		return isset($_POST[self::$login]);
	}
	
	public function didUserPressLogout() {
		
		return isset($_POST[self::$logout]);
	}

	public function getUser() {
		
		try { // If one or the other of the two input fields are empty throw an exception describing what's wrong...
			
			if ($this -> getRequestUserName() == "") {

				throw new \Exception(self::$missingUserNameMessage);
			
			} else if ($this -> getRequestPassword() == "") {

				throw new \Exception(self::$missingPasswordMessage);
			}
			// ...return user if everything is typed in correctly.
			return new UserModel($this -> getRequestUserName(), $this -> getRequestPassword());		
		
		} catch (\Exception $e) { // Double-check which exception-message was thrown and set it to feedback message.
			
			if ($e -> getMessage() == self::$missingUserNameMessage) {
				
				$this -> setFeedbackMessage(self::$missingUserNameMessage);
				
			} else if ($e -> getMessage() == self::$missingPasswordMessage) {

				$this -> setFeedbackMessage(self::$missingPasswordMessage);				
			}
		}
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
		if (isset($_POST[self::$name])) {
			
			return $_POST[self::$name];
		}
		
		return "";
	}

	private function getRequestPassword() {
		//RETURN REQUEST VARIABLE: PASSWORD
		if (isset($_POST[self::$name])) {
			
			return $_POST[self::$password];
		}
		
		return "";
	}

	public function reloadPage() {
		
		header('Location: ' . $_SERVER['REQUEST_URI']);
		exit();
	}
	
	private function setFeedbackMessage($feedbackMessage) {
		
		$this -> feedbackMessage = $feedbackMessage;
	}
	
	private function getFeedbackMessage() {
		
        return $this -> feedbackMessage;
	}
	
	public function setLoginFeedbackMessage() {
		
		$this -> setFeedbackMessage(self::$loginMessage);
	}
	
	public function setLogoutFeedbackMessage() {
		
		$this -> setFeedbackMessage(self::$logoutMessage);
	}
	
	public function setWrongInputFeedbackMessage() {
		
		$this -> setFeedbackMessage(self::$wrongInputMessage);
	}
	
}