<?php
header("Access-Control-Allow-Origin: *");
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

				// Set the initial logged_in flag to FALSE
				$logged_in = "FALSE";

        // Load the model
        $this->load->model('UserAccountModel');

				// Get user information for login
        $email = $this->post('email');
        $password = $this->post('password');

				// Send the user information to the model to check for the email
        $login_response = $this->UserAccountModel->post_login($email);

				// // Check if the email exists
				// if ($login_response['hash_pass'] == NULL){
				//
				// 	// Email not found, send back a response with $logged_in = FALSE, 200 Success
  			// 	$this->response($logged_in, 200);
				// }

				// Check if the password hashes match
				if (password_verify($password, $login_response['hash_pass'])){

					// Set the login_message flag to TRUE
					$logged_in = "TRUE";

					// Set the session variable
					$_SESSION['email'] = $email;

					// Email and password match, send back a response with $logged_in = TRUE, 200 Success
  				$this->response($logged_in, 200);

	  			} else {

						// Password does not match, send back a response with $logged_in = FALSE, 200 Success
	  				$this->response($logged_in, 200);
	  			}
      }
      
      function ocr_get($image) {
			
			echo "ocr_post()";
			
			$image = $this->get('image');
			echo "Image: " . $image;
			echo "<br><Br>";
			
			// Get cURL resource
			$curl = curl_init();
			// Set some options - we are passing in a useragent too here
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => 'https://api.ocr.space/Parse/Image',
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => array(
					'apikey' => '26be4c08a388957',
					'language' => 'eng',
					'file' => $image
				)
			));
			// Send the request & save response to $resp
			echo "Request: " . $curl;
			echo "<br>";
			$resp = curl_exec($curl);
			$data = array(
				'resp' => $resp
				);
			echo "response: " . json_encode($resp);
			// Close request to clear up some resources
			curl_close($curl);

	  
      
      
      }
      
      
      function hsa_get($id) {
      	
    	$this->load->model('HealthAccountModel');

			if(!$this->get('id'))
			{
				$this->response(NULL, 400);
			}

			$user = $this->HealthAccountModel->get_hsa_info($this->get('id') );

			if($user)
			{
				$this->response($user, 200); // 200 being the HTTP response code
			}

			else
			{
				$this->response(NULL, 404);
			}
      
      
      
      }
      function fsa_get($id) {
      	$this->load->model('HealthAccountModel');

			if(!$this->get('id'))
			{
				$this->response(NULL, 400);
			}

			$user = $this->HealthAccountModel->get_fsa_info($this->get('id'));

			if($user)
			{
				$this->response($user, 200); // 200 being the HTTP response code
			}

			else
			{
				$this->response(NULL, 404);
			}
      
      
      }
      
      function transaction_get($acct_num) {
      	$this->load->model('AccountTransactionModel');
      	
      	if(!$this->get('acct_num')) {
      		$this->response(NULL, 400);
      	} 
      	$trans_info = $this->AccountTransactionModel->get_trans_info($this->get('acct_num'));
      	
      	if($trans_info) {
      		$this->response($trans_info, 200);
      	} else {
      		$this->response(NULL, 404);
      	}
      	
      
      }

	


	}
