<?php

class RegisterView {
    
    private static $register = 'RegisterView::Register';
    private static $userName = 'RegisterView::UserName';
	private static $desiredPassword = 'RegisterView::DesiredPassword';
	private static $repeatDesiredPassword = 'RegisterView::RepeatDesiredPassword';
	
	private static $messageId = 'RegisterView::Message';
	private $feedbackMessage = "";
	
    
    public function generateRegisterFormHTML() {
		
		return '
			<h2>Register new user</h2>
		
			<form method="post" > 
				<fieldset>
					<legend>Register a new user - Write username and password</legend>¨
					<p id="' . self::$messageId . '">' . $this -> feedbackMessage . '</p>
					
					<label for="' . self::$desiredUserName . '">Username :</label>
					<input type="text" id="' . self::$desiredUserName . '" name="' . self::$desiredUserName . '" /><br>
					
					<label for="' . self::$desiredPassword . '">Password :</label>
					<input type="password" id="' . self::$desiredPassword . '" name="' . self::$desiredPassword . '" /><br>
					
					<label for="' . self::$repeatDesiredPassword . '">Repeat password :</label>
					<input type="password" id="' . self::$repeatDesiredPassword . '" name="' . self::$repeatDesiredPassword . '" /><br>
					
					<input type="submit" name="' . self::$register . '" value="Register" />
					
				</fieldset>
			</form>
		';
	}
	
	public function didUserPressRegister() {
		
		return isset($_POST[self::$register]);
	}
	
	private function getRequestDesiredUserName() {
	
		if (isset($_POST[self::$desiredUserName])) {
			
			return $_POST[self::$desiredUserName];
			
		} else {
			
			return "";
		}
	}
	
	private function getRequestDesiredPassword() {
	
		if (isset($_POST[self::$desiredPassword])) {
			
			return $_POST[self::$desiredPassword];
			
		} else {
			
			return "";
		}
	}
	
	private function getRequestRepeatDesiredPassword() {
		
		if (isset($_POST[self::$repeatDesiredPassword])) {
			
			return $_POST[self::$repeatDesiredPassword];
			
		} else {
			
			return "";
		}
	}
	
	public function getNewUser() {
		
		return new UserModel($this -> getRequestDesiredUserName(), $this -> getRequestDesiredPassword());		
	}
	
}