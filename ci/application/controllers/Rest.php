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
        $user = $this->UserAccountModel->get( $this->get('id') );
         
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
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