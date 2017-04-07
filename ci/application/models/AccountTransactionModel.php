<?php
	class AccountTransactionModel extends CI_Model {


    function get_trans_info($acct_num) {
    	//http://capstone.td9175.com/ci/index.php/rest/user/id/1
    	//request for a specfic id

    	$this->load->database();

    	$query = "SELECT * FROM AccountTransaction WHERE account_number = ?";

			 $result = $this->db->query($query, $acct_num);
			foreach ($result->result_array() as $row) {
				$data[] = array(
					'transaction_id' => $row['transaction_id'],
					'account_number' => $row['account_number'],
					'amount' => $row['amount']
				);
			}

			return $data;

    }


}


?>
