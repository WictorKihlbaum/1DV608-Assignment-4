<?php

class RegisterView {
	
	private $registerModel;
    
    private static $register = 'RegisterView::Register';
    private static $userName = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $passwordRepeat = 'RegisterView::PasswordRepeat';
	private static $messageId = 'RegisterView::Message';
	
	// '$feedbackMessage' will get one of the below values depending on situation. 
	private $feedbackMessage = "";
	// Feedback messages.
	private static $registeredNewUserMessage = "Registered new user";
	private static $noCredentialsMessage = "Username has too few characters, at least 3 characters.<br>Password has too few characters, at least 6 characters";
	private static $noUserNameMessage = "Username has too few characters, at least 3 characters";
	private static $noPasswordMessage = "Password has too few characters, at least 6 characters";
	private static $passwordsDoNotMatchMessage = "Passwords do not match";
	private static $invalidCharactersMessage = "Username contains invalid characters";
	private static $UserAlreadyExistsMessage = "User exists, pick another username";
	
	
	public function __construct($registerModel){
		
		$this -> registerModel = $registerModel;
	}
    
    public function generateRegisterFormHTML() {
		
		return '
			<h2>Register new user</h2>
		
			<form method="post" > 
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
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
		
		try { // TODO: Throw extended custom exceptions instead.
			
			if ($this -> getRequestUserName() && 
				$this -> getRequestPassword() &&
				$this -> getRequestPasswordRepeat() == "") {
				
				throw new \Exception(self::$noCredentialsMessage);
				
			} else if ($this -> getRequestUserName() == "" && $this -> getRequestPassword() != "") {

				throw new \Exception(self::$noUserNameMessage);
			
			} else if ($this -> getRequestPassword() == "" && $this -> getRequestUserName() != "") {

				throw new \Exception(self::$noPasswordMessage);
				
			} else if ($this -> getRequestPassword() != $this -> getRequestPasswordRepeat()) {
				
				throw new \Exception(self::$passwordsDoNotMatchMessage);
				
			} else if (!ctype_alnum($this -> getRequestUserName())) {
				
				throw new \Exception(self::$invalidCharactersMessage);
			}
			
			return new UserModel($this -> getRequestUserName(), $this -> getRequestPassword());		
		
		} catch (Exception $e) {
			
			switch ($e -> getMessage()) { // TODO: Remove switch and catch extended exception-classes instead.
				
				case self::$noCredentialsMessage: 
					$this -> setFeedbackMessage(self::$noCredentialsMessage);
					
				case self::$noUserNameMessage:
					$this -> setFeedbackMessage(self::$noUserNameMessage);
					
				case self::$noPasswordMessage:
					$this -> setFeedbackMessage(self::$noPasswordMessage);
					
				case self::$passwordsDoNotMatchMessage:
					$this -> setFeedbackMessage(self::$passwordsDoNotMatchMessage);
					
				case self::$invalidCharactersMessage:
					$this -> setFeedbackMessage(self::$invalidCharactersMessage);
					
				default: break;
			}
		}	
	}
	
	/*private function checkUserNameCharacters($userNameInput) {
		
		if (ctype_alnum($userNameInput)) {
			
			return true;
		}
		
		return false;
	}*/
	
	private function setFeedbackMessage($feedbackMessage) {
		
		$this -> feedbackMessage = $feedbackMessage;
	}
	
	/*private function getFeedbackMessage() {
		
        return $this -> feedbackMessage;
	}*/
	
	public function setRegisteredNewUserFeedbackMessage() {
		
		$this -> setFeedbackMessage(self::$registeredNewUserMessage);
	}
	
	public function setNoCredentialsFeedbackMessage() {
		
		$this -> setFeedbackMessage(self::$noCredentialsMessage);
	}
	
	public function setNoUserNameFeedbackMessage() {
		
		$this -> setFeedbackMessage(self::$noUserNameMessage);
	}
	
	public function setNoPasswordFeedbackMessage() {
		
		$this -> setFeedbackMessage(self::$noPasswordMessage);
	}
	
	public function setPasswordsDoNotMatchFeedbackMessage() {
		
		$this -> setFeedbackMessage(self::$passwordsDoNotMatchMessage);
	}
	
	public function setInvalidCharactersFeedbackMessage() {
		
		$this -> setFeedbackMessage(self::$invalidCharactersMessage);
	}
	
	public function setUserAlreadyExistsFeedbackMessage() {
		
		$this -> setFeedbackMessage(self::$UserAlreadyExistsMessage);
	}
	
}