<?php

//INCLUDE THE FILES NEEDED...

// Views.
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegistrationView.php');

// Controllers.
require_once('controller/LoginController.php');
require_once('controller/RegistrationController.php');

// Models.
require_once('model/LoginModel.php');
require_once('model/UserModel.php');
require_once('model/SessionModel.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// CREATE OBJECTS OF THE MODELS
$sessionModel = new SessionModel();
$loginModel = new LoginModel($sessionModel);

//CREATE OBJECTS OF THE VIEWS
$loginView = new LoginView($loginModel);
$dateTimeView = new DateTimeView();
$layoutView = new LayoutView();
$registrationView = new RegistrationView();

//CREATE OBJECTS OF THE CONTROLLERS
$loginController = new LoginController($loginView, $loginModel);
$registrationController = new RegistrationController($registrationView);

// Verify whether user is logged in or not.
$isLoggedIn = $loginController -> verifyUserState();
$registrationController -> registrateUser();

// Render page.
$layoutView -> render($isLoggedIn, $loginView, $dateTimeView, $registrationView);