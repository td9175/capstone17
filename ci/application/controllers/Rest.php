<?php
require('application/libraries/REST_Controller.php');
 
	class Rest extends REST_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model('UserAccountModel');
			echo "ello"; 
		
		}
		
		
		public function index() {
			echo "index_get()";
			
		
		}
	
		
 
	}
	
	
?>