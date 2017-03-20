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
      
function upload_post() {
		$target_dir = "uploads/";
		
		
		$image = $this->post('image');
		
		echo "in upload_image";
		//fileToUpload is post variable from form
		
		$target_file = $target_dir . basename($_FILES[$image]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES[$image]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES[$image]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES[$image]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES[$image]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}


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
      
      function do_upload()
	{
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('ocr', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			echo "success";
			//$this->load->view('registration', $data);
		}
	}

	


	}
