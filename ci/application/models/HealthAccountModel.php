<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

	class HealthAccountModel extends CI_Model {

	// RESTful api to get the HSA accounts for a user by the email address
	function get_hsa_info($email) {
		$this->load->database();

		$query = "SELECT * FROM HealthAccount WHERE email = ? AND account_type = 'HSA' LIMIT 1";

		$result = $this->db->query($query, $email);
		if ($result->num_rows() > 0) {
			foreach ($result->result_array() as $row) {
					$data[] = array(
						'account_number' => $row['account_number'],
						'account_type' => $row['account_type'],
						'email' => $row['email']
					);
				}
		} else {
			$data = "No HSA account exists.";
		}

		return $data;
	}

	// RESTful api to post an HSA account for a user into the database
	function post_hsa_info($params) {

		$this->load->database();

		$query = "SELECT * FROM HealthAccount WHERE email = ? AND account_type = 'HSA'";

		$result = $this->db->query($query, $params[1]);
		if ($result->num_rows() >= 1) {
			$data = "Error: You can only add 1 HSA account";
		} else {
			$query = "INSERT INTO HealthAccount (account_number, account_type, email) VALUES (?, 'HSA' ,?)";

			$result = $this->db->query($query, $params);

			if ($this->db->affected_rows() == 1) {
				$data = "Success: added HSA account";
			} else {
				$data = "Error: could not add HSA account.";
			}
		}

		 return $data;
	}

	// RESTful api to get the FSA accounts for a user by the email address
	function get_fsa_info($email) {
		$this->load->database();

		$query = "SELECT * FROM HealthAccount WHERE email = ? AND account_type = 'FSA' LIMIT 1";

		$result = $this->db->query($query, $email);

		if ($result->num_rows() > 0) {
			foreach ($result->result_array() as $row) {
					$data[] = array(
						'account_number' => $row['account_number'],
						'account_type' => $row['account_type'],
						'email' => $row['email']
					);
				}
		} else {
			$data = "No FSA account exists.";
		}

		return $data;
	}

	// RESTful api to post an FSA account for a user into the database
	function post_fsa_info($params) {
		$this->load->database();

		$query = "SELECT * FROM HealthAccount WHERE email = ? AND account_type = 'FSA'";

		$result = $this->db->query($query, $params[1]);

		if ($result->num_rows() >= 1) {
			$data = "Error: You can only add 1 FSA account";
		} else {
			$query = "INSERT INTO HealthAccount (account_number, account_type, email) VALUES (?, 'FSA',?)";

			$result = $this->db->query($query, $params);

			if ($this->db->affected_rows() == 1) {
				$data = "Success: added FSA account";
			} else {
				$data = "Error: could not add FSA account.";
			}
		}

		return $data;
	}

}


?>
