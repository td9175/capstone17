<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH'.libraries/REST_Controller.php');

class Welcome extends CI_Controller {
    
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
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
	}
}
