<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');
require '/var/www/html/vendor/autoload.php';
use Lcobucci\JWT\Builder;

	// RESTful API for User Account functions
	class UserAccount extends REST_Controller {

		// Load the model for every call
    function __construct() {
      parent::__construct();
      $this->load->model('UserAccountModel');
			$this->config->load('jwt');
    }

		// Register a user account
		// Make POST requests to https://capstone.td9175.com/ci/index.php/UserAccount/registration
		// POST variables to send: email, password, first_name, last_name
    function registration_post(){
      // Get user information for registration
      $email = $this->post('email');
      $password = $this->post('password');
      $first_name = $this->post('first_name');
      $last_name = $this->post('last_name');
      // Hash the password for security
      $hash_pass = password_hash($password, PASSWORD_DEFAULT);
      // Send the user information to the model and try to register the user account
      $registration_response = $this->UserAccountModel->post_registration($email, $hash_pass, $first_name, $last_name);
      // Send back success or error response
      if(isset($registration_response['error'])  && !empty($registration_response['error'])){
				$this->response($registration_response, 400); // Bad request
      } elseif (isset($registration_response['success']) && !empty($registration_response['success'])) {
				// Create the user's folder to store receipt images
        mkdir("/var/www/html/ci/application/receipts/$email", 0777, TRUE);
        $this->response($registration_response, 200); // 200 Success
      }
    }

    // Login a user
		// Make POST requests to https://capstone.td9175.com/ci/index.php/UserAccount/login
		// POST variables to send: email, password
    function login_post(){
			// Set generic error messages
			$error_msg = "Incorrect email or password.";
			$disabled_msg = "Account is disabled.";
      // Get user information for login
      $email = $this->post('email');
      $password = $this->post('password');
      // Send the user information to the model to check for the email
      $login_response = $this->UserAccountModel->post_login($email);
			// Check for errors
			if (isset($login_response['error']) && !empty($login_response['error'])) {
				$this->response($error_msg, 400); // 400 Bad request
				// Check if account is enabled
			} elseif (isset($login_response['is_enabled']) && $login_response['is_enabled'] == 0) {
				$this->response($disabled_msg, 403); // 403 Forbidden
				// Check if email and password match
			} elseif (password_verify($password, $login_response['hash_pass'])){
				$builttoken = (new Builder())
										 ->setIssuer('https://capstone.td9175.com') // Configures the issuer (iss claim)
										 ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
										 ->setExpiration(time() + 3600) // Configures the expiration time of the token (nbf claim)
										 ->set('sub', $this->post('jwtSubject')) // Configures a new claim, called "uid"
										->getToken(); // Retrieves the generated token
				$tokenSecret = $this->config->item('SECRET_KEY');
				$token = hash_hmac('sha256', $builttoken, $tokenSecret);
				$tokenFinal = $builttoken . $token;
				$session_data = array('token' => $tokenFinal);
        // Send back a response with session data, 200 Success
        $this->response($session_data, 200);
        } else {
          // Password does not match, send back a response with $error_message, 400 Bad request
          $this->response($error_msg, 400);
      }
    }

		// Get all user info for the logged in account
		// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/session_user
    function session_user_get() {
			// Check if a user is logged in
			verifyJWT($this->get('token'));
			// is_logged_in();
			// Get a user from the model by email
			$user = $this->UserAccountModel->get_user($_SESSION['email']);
			// Respond
			$this->response($user, 200); // 200 Success
  	}

		// Get all user info for an account
		// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/user
		function user_get() {
			// Check for a valid JSON web token
			verifyJWT($this->get('token'));
			// Check for the email variable
			if(!$this->get('email')){
	      $this->response(NULL, 400);
	    }
			// URL decode email variable
			$decoded_email = urldecode($this->get('email'));
			// Call the model function using the email
			$user = $this->UserAccountModel->get_user($decoded_email);
			// Respond
			$this->response($user, 200); // 200 Success
		}

			// Get info for every user
			// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/users
    	function users_get() {
				// Check if a user is logged in
				// is_logged_in();
				// Call the model function
  			$users = $this->UserAccountModel->get_users();
				// Respond
				$this->response($user, 200); // 200 Success

    	}

			// Disable a user's account
			// Make a POST request to https://capstone.td9175.com/ci/index.php/UserAccount/disable_user
			// POST variable to send: email
			function disable_user_post() {
				// Check if a user is logged in
				// is_logged_in();
				if(!$this->post('email')){
					$this->response(NULL, 400); // 400 Bad request
				}
				// Call the model function and pass the email
				$response = $this->UserAccountModel->disable_user($this->post('email'));
				// Respond
				$this->response($response, 200); // 200 Success
			}

			// Enable a user's account
			// Make a POST request to https://capstone.td9175.com/ci/index.php/UserAccount/enable_user
			// POST variable to send: email
			function enable_user_post() {
				// Check if a user is logged in
				// is_logged_in();
				// Check if an email was included in the POST request
				if(!$this->post('email')){
					$this->response(NULL, 400); // 400 Bad request
				}
				// Call the model function and pass the email
				$response = $this->UserAccountModel->enable_user($this->post('email'));
				// Respond
				$this->response($response, 200); // 200 Success
			}

			// Get all enabled user accounts
			// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/enabled_users
			function enabled_users_get() {
				// Check if a user is logged in
				// is_logged_in();
				// Call the model function
				$response = $this->UserAccountModel->get_enabled_users();
				// Respond
				$this->response($response, 200); // 200 Success
			}

			// Get all disabled user accounts
			// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/disabled_users
			function disabled_users_get() {
				// Check if a user is logged in
				// is_logged_in();
				// Call the model function
				$response = $this->UserAccountModel->get_disabled_users();
				// Respond
				$this->response($response, 200); // 200 Success
			}

			// Logout a user
			// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/logout
			function logout_get(){
				// Check if a user is logged in
				// is_logged_in();
				// Unset all of the session variables
				$_SESSION = array();
				// Destroy the session
				session_destroy();
				// Send back a response
				$this->response("Success: logged out.", 200); // 200 Success
			}


  }
