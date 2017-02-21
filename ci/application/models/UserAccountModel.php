<?php
class UserAccountModel extends CI_Model {
    
    function getUserAccounts(){
        
      
        $this->load->database();

        $query = $this->db->query('SELECT * from UserAccount');
        
        $results = array();
        foreach ($query->result_array() as $row){
        $results['user_id'] = $row['user_id'];
        $results['email'] = $row['email'];
        $results['hash_pass'] = $row['hash_pass'];
        $results['first_name'] = $row['first_name'];
        $results['last_name'] = $row['last_name'];
        //echo $row['email'];
        //echo $row['hash_pass'];
        //echo $row['first_name'];
        //echo $row['last_name'];
        //echo $row['enabled'];
		}

		return $results;
        
       
    }
    
}
?>