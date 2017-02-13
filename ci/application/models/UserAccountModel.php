<?php
class UserAccountModel extends CI_Model {
  
    public function __construct(){
        $CI =& get_instance();
    }
    
    function getUserAccounts(){
        $this->db->select("user_id, email, first_name, last_name, enabled");
        $this->db->from('UserAccount');
        $query = $this->db->get();
        return $query->result();
    }
    
}
?>