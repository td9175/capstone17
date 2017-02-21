<?php
class UserAccountModel extends CI_Model {
    
    function getUserAccounts(){
        
      
        $this->load->database();

        $query = $this->db->query('SELECT * from UserAccount');
        
		$row = $query->row();
		
		return $row->user_id;
        
       
    }
    
}
?>