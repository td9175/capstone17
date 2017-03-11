<?php
require('application/libraries/REST_Controller.php');

	class Rest extends REST_Controller {

		function user_get() {
		//index.php/rest/user/id/1/format/json
		//"id/1" is the parameter

    	$this->load->model('UserAccountModel');

			if(!$this->get('id'))
			{
				$this->response(NULL, 400);
			}

			$user = $this->UserAccountModel->get_user_id($this->get('id') );

			if($user)
			{
				$this->response($user, 200); // 200 being the HTTP response code
			}

			else
			{
				$this->response(NULL, 404);
			}

  	}

    	function users_get() {
        // respond with information about several users
        // index.php/rest/users

        $this->load->model('UserAccountModel');

  			if(!$this->get('id'))
  			{
  				$this->response(NULL, 400);
  			}

  			$users = $this->UserAccountModel->get_users();

  			if($users)
  			{
  				$this->response($users, 200); // 200 being the HTTP response code
  			}

  			else
  			{
  				$this->response(NULL, 404);
  			}

    	}


      // RESTful API to register a user
			// Author: Robert Fink
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
  				$this->response($registration_response, 200); // 200 Success
  			} else {
  				$this->response(NULL, 404); // 404 Not found
  			}

      }

			// RESTful API to login a user
			// Author: Robert Fink
      function login_post(){

        // Load the model
        $this->load->model('UserAccountModel');

				// Get user information for registration
        $email = $this->post('email');
        $password = $this->post('password');

				// Send the user information to the model to check for the email
        $login_response = $this->UserAccountModel->post_login($email);


				var_dump($login_response);

				// If registration_response has data respond with data and success, or 404
        // if($login_response){
  			// 	$this->response($login_response, 200); // 200 Success
  			// } else {
  			// 	$this->response(NULL, 404); // 404 Not found
  			// }
				//
				// console.log("Rest controller login response: " . $response);
				// console.log("checkpoint 1");
				//
				// // Check if the password matches the hashed password in the database
				// if (password_verify($password, $response->hash_pass)){
				//
				// 	// Log in, redirect to landing page
				// 	$this->load->view('landing_page');
				//
				// } else {
				//
				// 	// Error
				// 	$error_response = "Email or password incorrect";
  			// 	$this->load->view('login', $error_response);
  			// }

      }



	}


?>
