<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LandingPage extends CI_Controller {

	public function index()
	{
		require 'EmailSessionCheck.php';
		$this->load->view('landing_page');
	}

}
