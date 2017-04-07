<?php
header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

	class AccountTransaction extends REST_Controller {

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
