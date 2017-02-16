<?php
class UserAccountModel extends CI_Model {
    
    function getUserAccounts(){
        
      
        $this->load->database();

        $query = $this->db->query('SELECT * from UserAccount');
        
        
        foreach ($query->result_array() as $row){
        echo $row['user_id'];
        echo $row['email'];
        echo $row['hash_pass'];
        echo $row['first_name'];
        echo $row['last_name'];
        echo $row['enabled'];
		}
        
        
        
        
		$row = $query->row();
		echo $row->user_id;
		return $row->user_id;
        
       
    }
    
}
?>