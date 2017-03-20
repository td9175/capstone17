<?php
	class HealthAccountModel extends CI_Model {

	
	
	
	function get_hsa_info($id) {
    	$this->load->database();

		 $query = "SELECT * FROM HealthAccount WHERE user_id = ? AND account_type = 'HSA'";

		 $result = $this->db->query($query, $id);

		echo"updated";
		 //foreach ($result->result_array() as $row) {

        	/*$data[] = array(
				'user_id' => $row['user_id'],
				'account_number' => $row['account_number'],
				'account_type' => $row['account_type'],
				'balance' => $row['balance']
				);

			}*/


    		return $result;

	}


	function get_fsa_info($id) {
	
		$this->load->database();

		 $query = "SELECT * FROM HealthAccount WHERE user_id = ? AND account_type = 'FSA'";

		 $result = $this->db->query($query, $id);


		 foreach ($result->result_array() as $row) {

        	$data[] = array(
				'user_id' => $row['user_id'],
				'account_number' => $row['account_number'],
				'account_type' => $row['account_type'],
				'balance' => $row['balance']
				);

			}


    		return $data;
	
	
	}


}


?>