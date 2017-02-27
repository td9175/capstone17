<?php
require(APPPATH'.libraries/REST_Controller.php');
 
class Example_api extends REST_Controller {


 	function user_get()
    {
        
        
        
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
 		//not sure if this is right? not sure how to get to the model function to get ID 
        $user = $this->UserAccountModel->get_user_id();
         
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
            $this->load->view('welcome_message.php', $user);
            echo "success";
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
     
    function users_get()
    {
        // respond with information about several users
    }
 
 
	}
	
	
?>