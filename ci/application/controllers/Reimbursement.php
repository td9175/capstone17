<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

	class Reimbursement extends REST_Controller {

    // Gets the amount to reimburse from parsed OCR data and handles the reimbursement transaction
    // Make POST requests to https://capstone.td9175.com/ci/index.php/AccountTransaction/reimburse_account
    // POST variables: account_number, amount
    function reimburse_account_post(){
      // Load the model
      $this->load->model('ReimbursementModel');
      // Get the input for amount to reimburse
			$receipt_id = $this->post('receipt_id');
      $acct_num = $this->post('account_number');
      $amount = $this->post('amount');
      // Pass the user input to the model to make the transaction query in the database
      $result = $this->ReimbursementModel->reimburse_account($acct_num, $amount);
      // If response has data respond with data and success, or 404
      if($result){
        $this->response($result, 200); // 200 Success
      } else {
        $this->response(NULL, 404); // 404 Not found
      }
    }

		// Get all reimbursement records for a single user by email
		// Make GET requests to https://capstone.td9175.com/ci/index.php/AccountTransaction/user_reimbursements
    // GET variables: email
		function user_reimbursements_get() {
			// Load the model
      $this->load->model('ReimbursementModel');
			// Check for the get variable
			if (!$this->get('email')) {
				// 400 Bad request
				$this->response(NULL, 400);
			}
			// Decode the url encoded variable
			$decoded_email = urldecode($this->get('email'));
			// Call the model to query the db
			$result = $this->ReimbursementModel->get_user_reimbursements($decoded_email);
			// If response has data respond with data and success, or 404
      if($result){
        $this->response($result, 200); // 200 Success
      } else {
        $this->response(NULL, 404); // 404 Not found
      }
		}

		// // Get all reimbursement records
		// function all_reimbursements_get() {
		// 	// Load the model
		//   $this->load->model('ReimbursementModel');
		// 	// Call the model to query the db
		// 	$result = $this->ReimbursementModel->all_reimbursements();
		// 	// If response has data respond with data and success, or 404
		//   if($result){
		//     $this->response($result, 200); // 200 Success
		//   } else {
		//     $this->response(NULL, 404); // 404 Not found
		//   }
		// }

  }
