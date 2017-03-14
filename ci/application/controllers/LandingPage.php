<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LandingPage extends CI_Controller {

	public function index(){

		if (!isset($_SESSION['email'])){
		  $this->load->view('login');
		} else {
			$this->load->view('landing_page');
		}
		
	}

}
