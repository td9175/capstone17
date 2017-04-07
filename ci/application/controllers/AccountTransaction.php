<?php
header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

	class AccountTransaction extends REST_Controller {

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
