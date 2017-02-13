<?php
class UserAccountModel extends Model {
  
    function UserAccountModel(){
        parent::Model();
    }
    
    function getUserAccounts(){
        $this->db->select("user_id, email, first_name, last_name, enabled");
        $this->db->from('UserAccount');
        $query = $this->db->get();
        return $query->result();
    }
    
}
?>