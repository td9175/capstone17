<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

	class AccountTransactionModel extends CI_Model {


		function get_hsa_account_num($email) {
			$this->load->database();

			$query = "SELECT * FROM account_number WHERE email = ? AND account_type = 'HSA' LIMIT 1";

			$result = $this->db->query($query, $email);
			if ($result->num_rows() > 0) {
				foreach ($result->result_array() as $row) {
						$data = $row['account_number'];
					}
			} else {
				$data = "No HSA account exists.";
			}
			return $data;
		}

		function get_fsa_account_num($email) {
			$this->load->database();

			$query = "SELECT * FROM account_number WHERE email = ? AND account_type = 'FSA' LIMIT 1";

			$result = $this->db->query($query, $email);
			if ($result->num_rows() > 0) {
				foreach ($result->result_array() as $row) {
						$data = $row['account_number'];
					}
			} else {
				$data = "No FSA account exists.";
			}
			return $data;
		}

		// Get a user's HSA transaction history
		// Make requests to https://capstone.td9175.com/ci/index.php/AccountTransaction/
    function get_hsa_transaction_history($email) {
			// Load the database
    	$this->load->database();
			// Build the query string
    	$query = "SELECT H.account_number, H.account_type, A.amount, A.date_time_stamp FROM AccountTransaction AS A JOIN HealthAccount AS H USING (account_number) WHERE H.email = ? AND H.account_type = 'HSA' ";
			// Execute the query
			$result = $this->db->query($query, $email);
			// Check if any rows were returned
			if ($result->num_rows() > 0) {
				foreach ($result->result_array() as $row) {
					$data[] = array(
						'account_number' => $row['account_number'],
						'account_type' => $row['account_type'],
						'amount' => $row['amount'],
						'date_time_stamp' => $row['date_time_stamp']
					);
				}
			} else {
				$data = "No HSA transaction history exists.";
			}
			// Pass back the data
			return $data;
    }

		function post_transaction($amount, $account_number) {
			// Load the database
    	$this->load->database();
			// Build the query string
    	$query = "INSERT INTO AccountTransaction (amount, account_number) VALUES (?,?)";
			// Build param array
			$params = array($amount, $account_number);
			// Execute the query
			$result = $this->db->query($query, $params);
			// Check if any rows were returned
			if ($this->db->affected_rows() == 1) {
				$data = "HSA transaction inserted.";
			} else {
				$data = "Error: could not insert transaction.";
			}
			// Pass back the data
			return $data;
    }

		// Get a user's FSA transaction history
		// Make requests to https://capstone.td9175.com/ci/index.php/AccountTransaction/
		function get_fsa_transaction_history($email) {
			// Load the database
			$this->load->database();
			// Build the query string
			$query = "SELECT H.account_number, H.account_type, A.amount, A.date_time_stamp FROM AccountTransaction AS A JOIN HealthAccount AS H USING (account_number) WHERE H.email = ? AND H.account_type = 'FSA' ";
			// Execute the query
			$result = $this->db->query($query, $email);
			// Check if any rows were returned
			if ($result->num_rows() > 0) {
				foreach ($result->result_array() as $row) {
					$data[] = array(
						'account_number' => $row['account_number'],
						'account_type' => $row['account_type'],
						'amount' => $row['amount'],
						'date_time_stamp' => $row['date_time_stamp']
					);
				}
			} else {
				$data = "No FSA transaction history exists.";
			}
			// Pass back the data
			return $data;
		}

		// Get a user's balance for an HSA account
		function hsa_balance($email) {
			// Load the database
			$this->load->database();
			// Build the query string
			$query = "SELECT sum(A.amount) AS balance FROM AccountTransaction AS A JOIN HealthAccount AS H USING (account_number) WHERE H.email = ? AND H.account_type = 'HSA' ";
			// Execute the query
			$result = $this->db->query($query, $email);
			// Check if any rows were returned
			if ($result->num_rows() > 0) {
				foreach ($result->result_array() as $row) {
					$data = $row['balance'];
				}
			} else {
				// Error
				$data = "Error: could not calculate HSA account balance.";
			}
			// Pass back the data
			return $data;
		}

		// Get a user's balance for an FSA account
		function fsa_balance($email) {
			// Load the database
			$this->load->database();
			// Build the query string
			$query = "SELECT sum(A.amount) AS balance FROM AccountTransaction AS A JOIN HealthAccount AS H USING (account_number) WHERE H.email = ? AND H.account_type = 'FSA' ";
			// Execute the query
			$result = $this->db->query($query, $email);
			// Check if any rows were returned
			// var_dump($result);
			$num_rows = $result->num_rows();
			echo "$num_rows \n";
			if (!empty($num_rows)) {
				foreach ($result->result_array() as $row) {
					echo "checkpoint \n";
					$data = $row['balance'];
				}
			} else {
				// Error
				$data = "Error: could not calculate FSA account balance.";
			}
			// Pass back the data
			return $data;
		}


}


?>
