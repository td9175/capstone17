<?php
require('application/libraries/REST_Controller.php');
 
	class Rest extends REST_Controller {
		
		function user_get() {
		//index.php/rest/user/id/1/format/json
		//"id/1" is the parameter 
        // respond with information about a user
        
    	//this could be used for login?
    	
    	
    	$this->load->model('UserAccountModel');
		
			if(!$this->get('id'))
			{
				$this->response(NULL, 400);
			}
 			
			$user = $this->UserAccountModel->get_user_id($this->'id');
		 
			if($user)
			{
				$this->response($user, 200); // 200 being the HTTP response code
			}
 
			else
			{
				$this->response(NULL, 404);
			}
    	
    	
    	
    	}
     
    	function users_get() {
        // respond with information about several users
        
        //index.php/rest/users
        
        $this->load->model('UserAccountModel');
		
			if(!$this->get('id'))
			{
				$this->response(NULL, 400);
			}
 			
			$users = $this->UserAccountModel->get_users();
		 
			if($users)
			{
				$this->response($users, 200); // 200 being the HTTP response code
			}
 
			else
			{
				$this->response(NULL, 404);
			}
        
        
        
        
    	}
		
 
	}
	
	
?>