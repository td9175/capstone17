<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

	// RESTful API for User Account functions
	class UserAccount extends REST_Controller {

		// Load the model for every call
    function __construct() {
      parent::__construct();
      $this->load->model('UserAccountModel');
			if (is_logged_in() == FALSE) {
				$this->response("Please log in.");
			}
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
      // Beware that DEFAULT may change over time, so you would want to prepare
      // By allowing your storage to expand past 60 characters (255 would be good)
      $hash_pass = password_hash($password, PASSWORD_DEFAULT);

      // Send the user information to the model and try to register the user account
      $registration_response = $this->UserAccountModel->post_registration($email, $hash_pass, $first_name, $last_name);

      // If registration_response has data respond with data and success, or 404
      if($registration_response){
        // Create the user's folder to store receipt images
        mkdir("/var/www/html/ci/application/receipts/$email", 0777, TRUE);
        $this->response($registration_response, 400); // 200 Success
      } else {
        $this->response(NULL, 404); // 404 Not found
      }

    }

    // Login a user
		// Make POST requests to https://capstone.td9175.com/ci/index.php/UserAccount/login
		// POST variables to send: email, password
    function login_post(){
			// Set generic login messages
			$success_msg = "Logging in...";
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
				// Email and password match
			} elseif (password_verify($password, $login_response['hash_pass'])){
          // Set the session variable
					$_SESSION['logged_in'] = TRUE;
          $_SESSION['email'] = $email;
					// If the account has admin priviledge set the admin session variable
					if ($login_response['is_admin']) {
						$_SESSION['is_admin'] = TRUE;
					}
          // Send back a response with $success_msg, 200 Success
          $this->response($success_msg, 200);
        } else {
          // Password does not match, send back a response with $error_message, 400 Bad request
          $this->response($error_msg, 400);
      }
    }

		// Checks if a user is logged in or not
		// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/is_authenticated
		function is_logged_in() {
			$response = "Please log in.";
			if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
				$email = $_SESSION['email'];
				$response = "$email logged in.";
			}
			// Send back a response
			$this->response($response);
		}

		// // Get all user info for the logged in account
		// // Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/session_user
    function session_user_get() {

			if(!$_SESSION){
				$this->response(NULL, 400);
			}

			$user = $this->UserAccountModel->get_user($_SESSION['email']);

			if($user){
				$this->response($user, 200); // 200 Success
			} else{
				$this->response(NULL, 404);
			}
  	}

		// Get all user info for an account
		// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/user
		function user_get() {
			// Check for the email variable
			if(!$this->get('email')){
	      $this->response(NULL, 400);
	    }
			// URL decode email variable
			$decoded_email = urldecode($this->get('email'));
			// Call the model function using the email
			$user = $this->UserAccountModel->get_user($decoded_email);

			if($user){
				$this->response($user, 200); // 200 Success
			} else{
				$this->response(NULL, 404);
			}
		}

			// Get info for every user
			// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/users
    	function users_get() {
  			$users = $this->UserAccountModel->get_users();

  			if($users){
  				$this->response($users, 200); // 200 Success
  			} else{
  				$this->response(NULL, 404);
  			}

    	}

			// Disable a user's account
			// Make a POST request to https://capstone.td9175.com/ci/index.php/UserAccount/disable_user
			// POST variable to send: email
			function disable_user_post() {

				if(!$this->post('email')){
					$this->response(NULL, 400); // 400 Bad request
				}

				$response = $this->UserAccountModel->disable_user($this->post('email'));

				if($response){
					$this->response($response, 200); // 200 Success
				} else{
					$this->response(NULL, 404); // 404 Not found
				}
			}

			// Enable a user's account
			// Make a POST request to https://capstone.td9175.com/ci/index.php/UserAccount/enable_user
			// POST variable to send: email
			function enable_user_post() {

				if(!$this->post('email')){
					$this->response(NULL, 400); // 400 Bad request
				}

				$response = $this->UserAccountModel->enable_user($this->post('email'));

				if($response){
					$this->response($response, 200); // 200 Success
				} else{
					$this->response(NULL, 404); // 404 Not found
				}
			}

			// Get all enabled user accounts
			// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/enabled_users
			function enabled_users_get() {

				$response = $this->UserAccountModel->get_enabled_users();

				if($response){
					$this->response($response, 200); // 200 Success
				} else{
					$this->response(NULL, 404); // 404 Not found
				}
			}

			// Get all disabled user accounts
			// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/disabled_users
			function disabled_users_get() {

				$response = $this->UserAccountModel->get_disabled_users();

				if($response){
					$this->response($response, 200); // 200 Success
				} else{
					$this->response(NULL, 404); // 404 Not found
				}
			}

			// Logout a user
			// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/logout
			function logout_get(){
				// Unset all of the session variables
				$_SESSION = array();
				// Destroy the session
				session_destroy();
				// Send back a response
				$this->response("Success: logged out.", 200); // 200 Success
			}


  }
