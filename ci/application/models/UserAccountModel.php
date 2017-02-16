<?php
class UserAccountModel extends CI_Model {
    
    function getUserAccounts(){
        
      
        $this->load->database();

        $query = $this->db->query('SELECT user_id FROM UserAccount LIMIT 1');
		$row = $query->row();
		echo $row->user_id;
		return $row->user_id;
        
       
    }
    
}
?>