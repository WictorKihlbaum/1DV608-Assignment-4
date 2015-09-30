<?php

class RegistrationView {
    
    private static $register = 'RegistrationView::Register';
    private static $desiredUserName = 'RegistrationView::DesiredUserName';
	private static $desiredPassword = 'RegistrationView::DesiredPassword';
	private static $repeatDesiredPassword = 'RegistrationView::RepeatDesiredPassword';
	
    
    public function generateRegistrationFormHTML() {
		
		return '
			<h2>Register new user</h2>
		
			<form method="post" > 
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					
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
	
}