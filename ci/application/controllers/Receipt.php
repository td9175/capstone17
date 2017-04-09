<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'HTTP_Request2-2.3.0/HTTP/Request2.php');


	class Receipt extends CI_Controller {

		//function to insert receipt into DB
		//function to insert OCR info into DB
		function upload_it() {
			
			//load the helper
			$this->load->helper('form');
			$this->load->helper('url');
			$this->load->model('ReceiptModel');

			//need to create folder for each user, path will be unique to the user
			//$email = $_SESSION['email'];
			$email = "hello@world.com";
			echo "Email: ". $email; 
			$date = date('d-m-y');
			echo "<br>Date:" . $date;
			

		
			$config['upload_path'] = '/var/www/html/ci/application/receipts/';
			$config['upload_path'] .= $email;
		
			//need to change filename to be unique to the user
			$config['file_name'] = $date;

			echo "Upload path: " . $config['upload_path'];
			echo "<br><br>";
			echo "File name: " . $config['file_name'];

		// set the filter image types
			$config['allowed_types'] = 'gif|jpg|png';

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
				$path = 'hello@world.com/';
				$path .= $date;
				$path .= '.jpg';
				$_SESSION['path'] = $path;
				redirect('OCR/ocr_request');

			}

			// load the view/upload.php
		$this->load->view('upload_form', $data);

	}
	
	
	
	

	}

?>
