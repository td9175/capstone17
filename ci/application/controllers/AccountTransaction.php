<?php
header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

	class AccountTransaction extends REST_Controller {

		// RESTful API to get a user's health account transaction history
		// Make GET requests to https://capstone.td9175.com/ci/index.php/AccountTransaction/transaction
		// GET variable to send: email
		function transaction_get() {
			// Load the model
			$this->load->model('AccountTransactionModel');
			// Check if the email get variable was passed
			if(!$this->get('email')) {
				$this->response(NULL, 400);
			}

			// URL decode the email
			$decoded_email = json_decode($this->get('email'));
			echo "Decoded: $decoded_email \n";
			// Call the transaction_history function in the model
			$response = $this->AccountTransactionModel->get_transaction_history($decoded_email);
			// Verify there is something, and respond with the JSON
			if($response) {
				$this->response($response, 200);
			} else {
				$this->response(NULL, 404);
			}
		}



  }
