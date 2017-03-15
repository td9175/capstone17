<?php
	class AccountTransactionModel extends CI_Model {

	
	function get_transaction_info($acct_num) {
		
		$this->load->database();

		 $query = "SELECT * FROM AccountTransaction WHERE account_number = ?";

		 $result = $this->db->query($query, $acct_num);


		 foreach ($result->result_array() as $row) {

        	$res[] = array(
				'transaction_id' => $row['transaction_id'],
				'account_number' => $row['account_number'],
				'amount' => $row['amount'],
				't_date' => $row['t_date']
				);

			}


    		return $res;
	
	
	
	
	}
	



}


?>