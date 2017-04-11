<?php
	class HealthAccountModel extends CI_Model {

	function get_hsa_info($email) {
		$this->load->database();

		$query = "SELECT * FROM HealthAccount WHERE email = ? AND account_type = 'HSA'";

		$result = $this->db->query($query, $email);

		foreach ($result->result_array() as $row) {
				$data[] = array(
					'account_number' => $row['account_number'],
					'account_type' => $row['account_type'],
					'email' => $row['email']
				);
			}
		return $data;
	}

	function post_hsa_info($params) {
		$this->load->database();

		$query = "INSERT INTO HealthAccount (account_number, account_type, email) VALUES (?, 'HSA' ,?)";

		$result = $this->db->query($query, $params);

		if ($this->db->affected_rows() == 1) {
			foreach ($result->result_array() as $row) {
					$data[] = array(
						'account_number' => $row['account_number'],
						'account_type' => $row['account_type'],
						'email' => $row['email']
					);
				}
		} else {
			$data = "Error: could not add HSA account.";
		}
		 return $data;
	}

	function get_fsa_info($email) {
		$this->load->database();

		$query = "SELECT * FROM HealthAccount WHERE email = ? AND account_type = 'FSA'";

		$result = $this->db->query($query, $email);

		$data = array();

		foreach ($result->result_array() as $row) {
				$data[] = array(
					'account_number' => $row['account_number'],
					'account_type' => $row['account_type'],
					'email' => $row['email']
				);
			}
		return $data;
	}

	function post_fsa_info($params) {
		$this->load->database();

		$query = "INSERT INTO HealthAccount (account_number, account_type, email) VALUES (?, 'FSA',?)";

		$result = $this->db->query($query, $params);

		if ($this->db->affected_rows() == 1) {
			foreach ($result->result_array() as $row) {
					$data[] = array(
						'account_number' => $row['account_number'],
						'account_type' => $row['account_type'],
						'email' => $row['email']
					);
				}
		} else {
			$data = "Error: could not add FSA account.";
		}
		return $data;
	}

}


?>
