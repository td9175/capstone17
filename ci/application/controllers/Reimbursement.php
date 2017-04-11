<?php
header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

	class Reimbursement extends REST_Controller {

    // Gets the scanned amount to reimburse from OCR and handles the reimbursement transaction
    // Make POST requests to https://capstone.td9175.com/ci/index.php/AccountTransaction/reimburse_account
    // POST variables: account_number, amount
    function reimburse_account_post(){
      // Load the model
      $this->load->model('AccountTransactionModel');
      // Get the input for amount to reimburse
      $acct_num = $this->post('account_number');
      $amount = $this->post('amount');
      // Pass the user input to the model to make the transaction query in the database
      $result = $this->AccountTransactionModel->reimburse_account($acct_num, $amount);
      // If response has data respond with data and success, or 404
      if($result){
        $this->response($result, 200); // 200 Success
      } else {
        $this->response(NULL, 404); // 404 Not found
      }
    }


		// Get all reimbursement records
		function all_reimbursements_get() {
			// Load the model
      $this->load->model('AccountTransactionModel');
			// Call the model to query the db
			$result = $this->AccountTransactionModel->all_reimbursements();
			// If response has data respond with data and success, or 404
      if($result){
        $this->response($result, 200); // 200 Success
      } else {
        $this->response(NULL, 404); // 404 Not found
      }
		}

		// Get all reimbursement records for a single user by email
		function user_reimbursements_get() {
			// Load the model
      $this->load->model('AccountTransactionModel');
			// Check for the get variable
			if (!$this->get('email')) {
				$this->response(NULL, 404); // 400 Bad request
			}
			// Call the model to query the db
			$result = $this->AccountTransactionModel->get_user_reimbursements($this->get('email'));
			// If response has data respond with data and success, or 404
      if($result){
        $this->response($result, 200); // 200 Success
      } else {
        $this->response(NULL, 404); // 404 Not found
      }
		}

  }
