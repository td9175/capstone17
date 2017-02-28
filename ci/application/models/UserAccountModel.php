<?php
class UserAccountModel extends CI_Model {
    
  
    
    function get_user_id() {
    	$this->load->database();
        $return_arr = array();

		 $query = $this->db->query('SELECT * from UserAccount');
		 
		 foreach ($query->result_array() as $row)
		{
        	//echo $row['user_id'];
        	//echo $row['email'];
        	//echo $row['first_name'];
        	
        	
        	$data[] = array(
				'user_id' => $row['user_id'],
				'email' => $row['email'],
				'first_name' => $row['first_name']
				);
        		
		}
		 
		
    		return $data;
    
    
    }
    
}
?>