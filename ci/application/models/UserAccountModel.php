<?php
class UserAccountModel extends CI_Model {
    
    function getUserAccounts(){
        
      
        $this->load->database();
        
        $return_arr = array();

		 $query = $this->db->query('SELECT * from UserAccount');

		while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
			$row_array['user_id'] = $row['user_id'];
			$row_array['col1'] = $row['col1'];
			$row_array['col2'] = $row['col2'];

			array_push($return_arr,$row_array);
		}

		echo json_encode($return_arr);
        echo "<br> TEST </br>";
        
        

        
        
		//$row = $query->row();
		
		//return $row->user_id;
        
       
    }
    
}
?>