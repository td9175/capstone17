<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

/*
	public function __construct()
	{

  }
*/

	public function index()
	{
		$this->load->view('registration');
	}

}
