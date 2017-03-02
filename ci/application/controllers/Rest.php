<?php
require('application/libraries/REST_Controller.php');
 
	class Rest extends REST_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model('UserAccountModel');
			echo "ello"; 
		
		}
		
		
		public function iget() {
			echo "index_get()";
			
		
		}
	
		public function index_post() {
		
			echo "index_post()";
		
		}
 
	}
	
	
?>