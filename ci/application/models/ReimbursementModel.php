<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

	class ReimbursementModel extends CI_Model {

		// Load the database for every call
    function __construct() {
      parent::__construct();
      $this->load->database();
    }

    // Gets data (amount to reimburse) from receipt OCR and handles the database transaction for reimbusement
    function reimburse_account($receipt_id, $amount, $acct_num) {
      // Build the query
      $query = "INSERT INTO Reimbursement (receipt_id, amount, account_number) VALUES (?,?,?)";
      // Build the parameter array
      $params = array($receipt_id, $amount, $acct_num);
			var_dump($params);
      // Execute the query
      $result = $this->db->query($query, $params);
      // Check if the insert was successful
      if ($result != 1) {
        $result = "Error: account reimbursement failed.";
      } else { $result = "Reimbursement successfully processed!"; }
      // Return the result
      return $result;
    }

		// Get all reimbursment records for a user and tie to a receipt and account number
		function get_user_reimbursements($email){
			// Build the query
			$query = "SELECT X.email, X.image, X.date_time_stamp, Y.amount, Y.account_number FROM Receipt AS X JOIN Reimbursement AS Y USING (receipt_id) WHERE X.email = ?";
			// Execute the query passing the email into the query parameter
			$result = $this->db->query($query, $email);
			// Check if any results were returned
			if ($result->num_rows() > 0) {
				foreach ($result->result_array() as $row) {
						$data[] = array(
							'email' => $row['email'],
							'image' => $row['image'],
							'amount' => $row['amount'],
							'account_number' => $row['account_number'],
							'date_time_stamp' => date("F jS, Y", strtotime($row['date_time_stamp']))
						);
					}
			} else { $data = "No reimbursment records found."; }
			// Return the result
			return $data;
		}


  }
