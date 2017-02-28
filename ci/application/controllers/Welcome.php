<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require('application/libraries/REST_Controller.php');

class Welcome extends Rest_Controller {

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
	public function index() {
		$this->load->view('welcome_message');
	}
	
	public function index_get() {
    	//call would be = index.php/Welcome/user?id=1
    	//load the model
        $this->load->model('UserAccountModel');
        
        if(!$this->get('id')) {
            $this->response(NULL, 400);
        }
 		echo "here i am in the Welcome.php controller function index_get()<br><Br>"; 
 		//go to right function
        $result = $this->UserAccountModel->get_user_id();
         
        if($result){
        	//somehow this is printing the result
            $this->response($result, 200); // 200 being the HTTP response code
        }
 
        else {
            $this->response(NULL, 404);
        }
        
    }
    
    public function index_post() {
    
    	echo "in index_post()";
    
    }
    
    public function ci_curl() {
    	//need to add arguments for image 
		
	 
		$this->load->library('curl');
	 
		$this->curl->create('https://westus.api.cognitive.microsoft.com/vision/v1.0/ocr?language=en&detectOrientation =true');
	 
 
		$this->curl->post(array(
			'url' => 'receipts/test.png'
			//'email' => $new_email
		));
	 
		$result = json_decode($this->curl->execute());
 
		if(isset($result->status) && $result->status == 'success')
		{
			echo 'User has been updated.';
		}
	 
		else
		{
			echo 'Something has gone wrong';
		}
	}
	
	
}


?>