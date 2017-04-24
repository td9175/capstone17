<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

	class AccountTransaction extends REST_Controller {

		// RESTful API to get a user's HSA transaction history
		// Make GET requests to https://capstone.td9175.com/ci/index.php/AccountTransaction/hsa_transaction
		// GET variable to send: email
		function hsa_transaction_get() {
			// Check for a valid JSON web token
			verifyJWT($this->get('token'));
			// Load the model
			$this->load->model('AccountTransactionModel');
			// Check if the email get variable was passed
			if(!$this->get('email')) {
				$this->response(NULL, 400);
			}
			// URL decode the email
			$decoded_email = urldecode($this->get('email'));
			// Call the transaction_history function in the model
			$response = $this->AccountTransactionModel->get_hsa_transaction_history($decoded_email);
			// Respond
			$this->response($response, 200);
		}


		function transaction_post() {
			if ($this->post('amount')==NULL || $this->post('account_number')) {
				$this->response('Amount and account_number are required.');
			} else {
				// Check for a valid JSON web token
				verifyJWT($this->post('token'));
				// Load the model
				$this->load->model('AccountTransactionModel');
				// Check if the email get variable was passed
				if(!$this->get('email')) {
					$this->response(NULL, 400);
				}
				// Call the transaction_history function in the model
				$response = $this->AccountTransactionModel->post_transaction($this->post('amount'), $this->post('account_number'));
				// Respond
				$this->response($response, 200);
			}
		}

		// RESTful API to get a user's FSA transaction history
		// Make GET requests to https://capstone.td9175.com/ci/index.php/AccountTransaction/fsa_transaction
		// GET variable to send: email
		function fsa_transaction_get() {
			// Check for a valid JSON web token
			verifyJWT($this->get('token'));
			// Load the model
			$this->load->model('AccountTransactionModel');
			// Check if the email get variable was passed
			if(!$this->get('email')) {
				$this->response(NULL, 400);
			}
			// URL decode the email
			$decoded_email = urldecode($this->get('email'));
			// Call the transaction_history function in the model
			$response = $this->AccountTransactionModel->get_fsa_transaction_history($decoded_email);
			// Respond
			$this->response($response, 200);
		}

		// Get the balance for a user's HSA account
		// Make GET requests to https://capstone.td9175.com/ci/index.php/AccountTransaction/hsa_balance
		// GET variable to send: email
		function hsa_balance_get() {
			// Check for a valid JSON web token
			verifyJWT($this->get('token'));
			//Load the model
			$this->load->model('AccountTransactionModel');
			// Check if the email get variable was passed
			if(!$this->get('email')) {
				$this->response(NULL, 400);
			}
			// URL decode the email
			$decoded_email = urldecode($this->get('email'));
			// Call the transaction_history function in the model
			$response = $this->AccountTransactionModel->hsa_balance($decoded_email);
			// Respond
			$this->response($response, 200);
		}

		// Get the balance for a user's FSA account
		// Make GET requests to https://capstone.td9175.com/ci/index.php/AccountTransaction/fsa_balance
		// GET variable to send: email
		function fsa_balance_get() {
			// Check for a valid JSON web token
			verifyJWT($this->get('token'));
			//Load the model
			$this->load->model('AccountTransactionModel');
			// Check if the email get variable was passed
			if(!$this->get('email')) {
				$this->response(NULL, 400);
			}
			// URL decode the email
			$decoded_email = urldecode($this->get('email'));
			// Call the transaction_history function in the model
			$response = $this->AccountTransactionModel->fsa_balance($decoded_email);
			// Respond
			$this->response($response, 200);
		}


  }
