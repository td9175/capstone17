<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

	class Reimbursement extends REST_Controller {

		// Load the model for every call
    function __construct() {
      parent::__construct();
      $this->load->model('ReimbursementModel');
    }

    // Gets the amount to reimburse from parsed OCR data and handles the reimbursement transaction
    // Make POST requests to https://capstone.td9175.com/ci/index.php/Reimbursement/reimburse_hsa_account
    // POST variables: email, amount
    function reimburse_hsa_account_post(){
      // Required: email, amount
			// Check for a valid JSON web token
			verifyJWT($this->post('token'));

      $this->load->model('AccountTransactionModel');
      $this->load->model('ReceiptModel');

      // Get the input for amount to reimburse
      $email = $this->post('email');
      $acct_num = $this->AccountTransactionModel->get_hsa_account_num($email);
			$receipt_id = $this->ReceiptModel->user_last_receipt_get($email);
			$amount = $this->post('amount');

			$amount = (Double) $amount;
			$amount = ($amount * -1);

      // Pass the user input to the model to make the transaction query in the database
      $result = $this->ReimbursementModel->reimburse_account($receipt_id, $amount, $acct_num);
      $result2 = $this->AccountTransactionModel->post_transaction($amount, $acct_num);
      // If response has data respond with data and success, or 404
      if($result){
        $this->response($result, 200); // 200 Success
      } else {
        $this->response(NULL, 404); // 404 Not found
      }
    }

		// Gets the amount to reimburse from parsed OCR data and handles the reimbursement transaction
		// Make POST requests to https://capstone.td9175.com/ci/index.php/Reimbursement/reimburse_fsa_account
		// POST variables: email, amount
    function reimburse_fsa_account_post(){
			// Check for a valid JSON web token
			verifyJWT($this->post('token'));

      $this->load->model('AccountTransactionModel');
      $this->load->model('ReceiptModel');

      // Get the input for amount to reimburse
      $email = $this->post('email');
      $acct_num = $this->AccountTransactionModel->get_fsa_account_num($email);
			$receipt_id = $this->ReceiptModel->user_last_receipt_get($email);
			$amount = $this->post('amount');

			$amount = (Double) $amount;
			$amount = ($amount * -1);

      // Pass the user input to the model to make the transaction query in the database
      $result = $this->ReimbursementModel->reimburse_account($receipt_id, $amount, $acct_num);
      $result2 = $this->AccountTransactionModel->post_transaction($amount, $acct_num);
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
			// Check for a valid JSON web token
			verifyJWT($this->get('token'));

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


  }
