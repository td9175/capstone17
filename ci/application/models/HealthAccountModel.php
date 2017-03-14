<?php
	class HealthAccountModel extends CI_Model {

	
	
	
	function get_hsa_info($id) {
    	$this->load->database();

		 $query = "SELECT * FROM HealthAccount WHERE user_id = ?";


		 foreach ($query->result_array() as $row) {

        	$data[] = array(
				'user_id' => $row['user_id'],
				'account_number' => $row['email'],
				'account_type' => $row['first_name'],
				'balance' => $row['balance']
				);

			}


    		return $data;

	}


	function get_fsa_info($id) {
	
		$this->load->database();

		 $query = "SELECT * FROM HealthAccount WHERE user_id = ? AND account_type ='FSA'";


		 foreach ($query->result_array() as $row) {

        	$data[] = array(
				'user_id' => $row['user_id'],
				'account_number' => $row['email'],
				'account_type' => $row['first_name'],
				'balance' => $row['balance']
				);

			}


    		return $data;
	
	
	}


}


?>