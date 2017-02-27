<?php
class UserAccountModel extends CI_Model {
    
  
    
    function get_user_id() {
    	$this->load->database();
        
        $return_arr = array();

		//$fetch = mysql_query("SELECT * FROM table");
		 $query = $this->db->query('SELECT * from UserAccount');
		 $row = $query->row();
		 return $row->user_id;
    
    
    
    }
    
}
?>