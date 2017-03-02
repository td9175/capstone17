<?php
require('application/libraries/REST_Controller.php');
 
	class UserAccount extends REST_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model('UserAccountModel');
			echo "ello"; 
		
		}
		
		
		public function index_get() {
		
			
		
		}
	
 
	}
	
	
?>