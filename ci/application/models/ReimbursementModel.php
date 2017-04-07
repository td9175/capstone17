<?php
	class AccountTransactionModel extends CI_Model {
    
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

  }
