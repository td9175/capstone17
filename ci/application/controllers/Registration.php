<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function __construct()
	{
		    $this->load->helper('form');
  }


	public function index()
	{
		$this->load->view('registration');
	}

}
