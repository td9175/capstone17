<?php
class UserAccountModel extends CI_Model {
    
  
    
    function get_users() {
    	$this->load->database();
        //$return_arr = array();

		 $query = $this->db->query('SELECT * from UserAccount');
		
		 
		 foreach ($query->result_array() as $row) {

        	$data[] = array(
				'user_id' => $row['user_id'],
				'email' => $row['email'],
				'first_name' => $row['first_name']
				);
        		
			}
		 
		
    		return $data;
    
    
    }
    
    function get_user_id($id) {
    	$this->load->database();
    	echo "in get_user_id()";
    	
    	$query = "SELECT * FROM UserAccount WHERE id = ?";
    	echo "Query: " . $query;
		//$this->db->query($query, $id);
    	
    	$data = 'yes';
    	return $data;
    
    
    
    
    }
    
    
    
}
?>