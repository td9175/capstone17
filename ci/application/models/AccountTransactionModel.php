<?php
	class AccountTransactionModel extends CI_Model {

		// Get a user's transaction history
		// Make requests to https://capstone.td9175.com/ci/index.php/AccountTransaction/
    function get_transaction_history($email) {
    	//http://capstone.td9175.com/ci/index.php/rest/user/id/1
    	//request for a specfic id
			// Load the database
    	$this->load->database();
			// Build the query string
    	$query = "SELECT H.account_number, H.account_type, A.amount, A.date_time_stamp FROM AccountTransaction AS A JOIN HealthAccount AS H USING (account_number) WHERE H.email = ?";

			$result = $this->db->query($query, $email);
			foreach ($result->result_array() as $row) {
				$data[] = array(
					'account_number' => $row['account_number'],
					'account_type' => $row['account_type'],
					'amount' => $row['amount'],
					'date_time_stamp' => $row['date_time_stamp']
				);
			}
			// Pass back the data
			return $data;
    }


}


?>
