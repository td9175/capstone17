<?php
/*
		@Author: Sami Holder
		12bit - UMB Bank Health Spending App
*/

defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
require_once(APPPATH.'HTTP_Request2-2.3.0/HTTP/Request2.php');


	class Receipt extends REST_Controller {

		public function __construct(){
	        parent::__construct();
					$this->load->model('ReceiptModel');
	  }


		function upload_it() {
			// Check if a user is logged in
			is_logged_in();

			//$logged_in = is_logged_in();
			$this->load->helper('form');

			$this->load->helper('url');
			$this->load->helper('string');


			$email = $_SESSION['email'];

			//$email = "umbcapstone17@gmail.com";
			echo "Email: ". $email;


			//create the unique file name
			$date = date('d-m-y');
			$rand = random_string('alnum', 3);
			echo "<br>Date:" . $date;
			$f_name = $date;
			$f_name .= $rand;
			//set file name
			$config['file_name'] = $f_name;

			//set upload path to unique email
			$config['upload_path'] = '/var/www/html/ci/application/receipts/';
			$config['upload_path'] .= $email;

			echo "Upload path: " . $config['upload_path'];
			echo "<br><br>";
			echo "File name: " . $config['file_name'];

		// set the filter image types
			$config['allowed_types'] = 'jpg';


			//load the upload library
			$this->load->library('upload', $config);

			$this->upload->initialize($config);
			$this->upload->set_allowed_types('*');

			$data['upload_data'] = '';
			$path = '';

			//if not successful, set the error message
			if (!$this->upload->do_upload('userfile')) {
				$data = array('msg' => $this->upload->display_errors());

			} else { //else, set the success message
				$data = array('msg' => "Upload success!");

				$data['upload_data'] = $this->upload->data('full_path');

				//insert into DB
				//$path = $this->ReceiptModel->receiptData_post($data['upload_data'], $email);


				$path = urlencode(email);
				//$path = 'umbcapstone17%40gmail.com/';
				$path .= $f_name;
				$path .= '.jpg';
				$_SESSION['path'] = $path;
				echo "<Br>Path: " . $path;
				redirect('OCR/ocr_request');
			}

			// load the view/upload.php

		$this->load->view('upload_form', $data);

	}

	function user_receipts_get() {
		// Check if a user is logged in
		// is_logged_in();
		if ($this->post('email') == NULL) {
      $this->response("Email is required.", 400);
    } else {
			// Call the model
			$response = $this->ReceiptModel->user_receipts_get($this->post('email'));
			// Respond
			$this->response($response, 200);
		}
	}

	function receipt_post() {
		// Check if a user is logged in
		// is_logged_in();
		if ($this->post('email') == NULL || $this->post('receipt_path') == NULL) {
			$this->response("Email and receipt_path are required.", 200);
    } else {
			// Call the model
			$response = $this->ReceiptModel->receipt_post($this->post('receipt_path'), $this->post('email'));
			// Respond
			$this->response($response, 200);
		}
	}



}

?>
