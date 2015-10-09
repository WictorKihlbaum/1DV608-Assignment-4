<?php

//INCLUDE THE FILES NEEDED...

// Views.
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('view/NavigationView.php');

// Controllers.
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');

// Models.
require_once('model/LoginModel.php');
require_once('model/RegisterModel.php');
require_once('model/UserModel.php');
require_once('model/SessionModel.php');

// Extended Custom Exceptions.
require_once('Exceptions/InvalidCharactersException.php');
require_once('Exceptions/NoCredentialsException.php');
require_once('Exceptions/NoValidPasswordException.php');
require_once('Exceptions/NoValidUserNameException.php');
require_once('Exceptions/PasswordsDoNotMatchException.php');
require_once('Exceptions/UserAlreadyExistsException.php');
require_once('Exceptions/WrongInputException.php');
require_once('Exceptions/RegisterWhileLoggedInException.php');

// MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$registeredUsersFile = './UserDAL/RegisteredUsers.txt'; // This should actually be put outside root-catalogue.

// CREATE OBJECTS OF THE MODELS
$sessionModel = new SessionModel();
$loginModel = new LoginModel($sessionModel, $registeredUsersFile);
$registerModel = new RegisterModel($sessionModel, $registeredUsersFile);

// CREATE OBJECTS OF THE VIEWS
$loginView = new LoginView($loginModel, $sessionModel);
$dateTimeView = new DateTimeView();
$layoutView = new LayoutView();
$registerView = new RegisterView($registerModel);
$navigationView = new NavigationView();

// CREATE OBJECTS OF THE CONTROLLERS
$loginController = new LoginController($loginView, $loginModel, $sessionModel);
$registerController = new RegisterController($registerView, $registerModel, $navigationView, $loginView);

// Verify whether user is logged in or not.
$isLoggedIn = $loginController -> verifyUserState();
$registerController -> verifyUserState();

// Render page.
$layoutView -> render($isLoggedIn, $loginView, $dateTimeView, $registerView, $navigationView);

// Dev purpose.
//var_dump(file_get_contents($registeredUsersFile)); 