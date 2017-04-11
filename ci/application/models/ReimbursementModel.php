<?php
	class ReimbursementModel extends CI_Model {

    // Gets data (amount to reimburse) from receipt OCR and handles the database transaction for reimbusement
    function reimburse_account($acct_num, $amount) {
      // Load the database
      $this->load->database();
      // Build the query
      $query = "INSERT INTO AccountTransaction (account_number, amount) VALUES (?,?)";
      // Build the parameter array
      $params = array($acct_num, $amount);
      // Execute the query
      $result = $this->db->query($query, $params);
      // Check if the insert was successful
      if ($result != 1) {
        $result = "Error: account reimbursement failed.";
      } else {
        $result = "Reimbursement successfully processed!";
      }
      // Return the result
      return $result;
    }

		// Get all reimbursment records and tie to a receipt and account number
		function all_reimbursements(){
			// Load the database
      $this->load->database();
      // Build the query
      $query = "SELECT X.email, X.image, X.date_time_stamp, Y.amount, Y.account_number FROM Receipt AS X JOIN Reimbursement AS Y USING (receipt_id)";
			// Execute the query
			$result = $this->db->query($query);
			// Check if any results were returned
			if ($result->num_rows() > 0) {
				$data = $result;
			} else {
				$data = "Error: no reimbursment records.";
			}
			// Return the result
			return $data;
		}

		// Get all reimbursment records for a user and tie to a receipt and account number
		function get_user_reimbursements($email){
			// Load the database
      $this->load->database();
      // Build the query
      $query = "SELECT X.email, X.image, X.date_time_stamp, Y.amount, Y.account_number FROM Receipt AS X JOIN Reimbursement AS Y USING (receipt_id) WHERE X.email = ?";
			// Execute the query passing the email into the query parameter
			$result = $this->db->query($query, $email);
			// Check if any results were returned
			if ($result->num_rows() > 0) {
				$data = $result;
			} else {
				$data = "Error: no reimbursment records.";
			}
			// Return the result
			return $data;
		}

  }
