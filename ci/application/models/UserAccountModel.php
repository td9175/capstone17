<?php
class UserAccountModel extends CI_Model {
    
    function getUserAccounts(){
        
        #$this->db = 
        $this->load->database();
		
		
        
        
        $query = $this->db->query('SELECT user_id FROM UserAccount LIMIT 1');
		$row = $query->row();
		echo $row->name;
		return $row->name;
        
        
        #$this->db->select("user_id, email, first_name, last_name, enabled");
        #$this->db->from('UserAccount');
        #$query = $this->db->get();
        #return $query->result();
    }
    
}
?>