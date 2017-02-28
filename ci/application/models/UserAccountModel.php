<?php
class UserAccountModel extends CI_Model {
    
  
    
    function get_user_id() {
    	$this->load->database();
        echo "no here i am";
        $return_arr = array();

		//$fetch = mysql_query("SELECT * FROM table");
		 $query = $this->db->query('SELECT * from UserAccount');
		 
		 foreach ($query->result_array() as $row)
		{
        	echo $row['user_id'];
        	echo $row['email'];
        	echo $row['first_name'];
        	//$row['user_id'] = $return_arr['user_id'];
        	//$row['email'] = $return_arr['email'];
        	//$row['first_name'] = $return_arr['first_name'];
        	
        	$data[] = array(
				'user_id' => $row['user_id'];
				
				) 
        	
        	
        	
        	
		}
		 
		 //$row = $query->row();
		 //return $row->user_id;
    		return $data;
    
    
    }
    
}
?>