<?php
header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

	// RESTful API for User Account functions
	// Author: Robert Fink
	class UserAccount extends REST_Controller {

		// Register a user account
		// Make POST requests to https://capstone.td9175.com/ci/index.php/UserAccount/registration
		// POST variables to send: email, password, first_name, last_name
    function registration_post(){

      // Load the model
      $this->load->model('UserAccountModel');

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

      // Set the initial logged_in flag to FALSE
      $logged_in = "FALSE";

      // Generic error message
      $error_message = "Incorrect email or password.";

      // Load the model
      $this->load->model('UserAccountModel');

      // Get user information for login
      $email = $this->post('email');
      $password = $this->post('password');

      // Send the user information to the model to check for the email
      $login_response = $this->UserAccountModel->post_login($email);

      if (strcmp($login_response['response'], $error_message) == 0){ // The strings are a match.
        // Email not found, send back a response with $error_message, 200 Success
        $this->response($error_message, 200);
      } elseif (password_verify($password, $login_response['response'])){
          // Email and password match
          // Set the login_message flag to TRUE
          $logged_in = "TRUE";

          // Set the session variable
          $_SESSION['email'] = $email;

          // Send back a response with $logged_in = TRUE, 200 Success
          $this->response($logged_in, 200);

        } else {
          // Password does not match, send back a response with $error_message, 200 Success
          $this->response($error_message, 200);
      }
    }

		// Get all user info for the logged in account
		// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/user
    function user_get() {
    	$this->load->model('UserAccountModel');

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

			// Get info for every user
			// Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/users
    	function users_get() {
        $this->load->model('UserAccountModel');

  			$users = $this->UserAccountModel->get_users();

  			if($users){
  				$this->response($users, 200); // 200 Success
  			} else{
  				$this->response(NULL, 404);
  			}

    	}

			// Disable a users account
			// Make a POST request to https://capstone.td9175.com/ci/index.php/UserAccount/disable_user
			function disable_user_post() {
				$this->load->model('UserAccountModel');

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

			// Enable a users account
			// Make a POST request to https://capstone.td9175.com/ci/index.php/UserAccount/enable_user
			function enable_user_post() {
				$this->load->model('UserAccountModel');

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
				$this->load->model('UserAccountModel');

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
				$this->load->model('UserAccountModel');

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
				// Initialize the session
				session_start();

				// Unset all of the session variables
				$_SESSION = array();

				// Destroy the session
				session_destroy();

				// Send back a response
				$this->response("Success: logged out.", 200); // 200 Success
			}


  }