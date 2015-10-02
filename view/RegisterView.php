<?php

class RegisterView {
    
    private static $register = 'RegisterView::Register';
    private static $userName = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $passwordRepeat = 'RegisterView::PasswordRepeat';
	private static $messageId = 'RegisterView::Message';
	
	// '$feedbackMessage' will get one of the below values depending on situation. 
	private $feedbackMessage = "";
	// Feedback messages.
	private static $noCredentialsMessage = "Username has too few characters, at least 3 characters. Password has too few characters, at least 6 characters";
	private static $noUserNameMessage = "Username has too few characters, at least 3 characters";
	private static $noPasswordMessage = "Password has too few characters, at least 6 characters";
	private static $passwordsDoNotMatchMessage = "Passwords do not match";
	
    
    public function generateRegisterFormHTML() {
		
		return '
			<h2>Register new user</h2>
		
			<form method="post" > 
				<fieldset>
					<legend>Register a new user - Write username and password</legend>¨
					<p id="' . self::$messageId . '">' . $this -> feedbackMessage . '</p>
					
					<label for="' . self::$userName . '">Username :</label>
					<input type="text" id="' . self::$userName . '" name="' . self::$userName . '" /><br>
					
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" /><br>
					
					<label for="' . self::$passwordRepeat . '">Repeat password :</label>
					<input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" /><br>
					
					<input type="submit" name="' . self::$register . '" value="Register" />
					
				</fieldset>
			</form>
		';
	}
	
	public function didUserPressRegister() {
		
		return isset($_POST[self::$register]);
	}
	
	private function getRequestUserName() {
	
		if (isset($_POST[self::$userName])) {
			
			return $_POST[self::$userName];
		}
		
		return "";
	}
	
	private function getRequestPassword() {
	
		if (isset($_POST[self::$password])) {
			
			return $_POST[self::$password];
		}
			
		return "";
	}
	
	private function getRequestPasswordRepeat() {
		
		if (isset($_POST[self::$passwordRepeat])) {
			
			return $_POST[self::$passwordRepeat];
		} 
	
		return "";
	}
	
	public function getNewUser() {
		
		try { 
			
			if ($this -> getRequestUserName() && $this -> getRequestPassword() == "") {
				
				throw new \Exception(self::$noCredentialsMessage);
				
			} else if ($this -> getRequestUserName() == "") {

				throw new \Exception(self::$noUserNameMessage);
			
			} else if ($this -> getRequestPassword() == "") {

				throw new \Exception(self::$noPasswordMessage);
				
			} else if ($this -> getRequestPassword() != $this -> getRequestPasswordRepeat()) {
				
				throw new \Exception(self::$passwordsDoNotMatchMessage);
			}
			
			return new UserModel($this -> getRequestUserName(), $this -> getRequestPassword());		
		
		} catch (Exception $e) {
			
			switch ($e -> getMessage()) {
				
				case self::$noCredentialsMessage: 
					$this -> setFeedbackMessage(self::$noCredentialsMessage);
			} // Continue...
		}	
	}
	
}