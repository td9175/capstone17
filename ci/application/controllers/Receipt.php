<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Receipt extends CI_Controller {

		//function to insert receipt into DB
		//function to insert OCR info into DB
		function upload_it() {
		//load the helper
		$this->load->helper('form');
		$this->load->model('ReceiptModel');

		//need to create folder for each user, path will be unique to the user
		$config['upload_path'] = '/var/www/html/ci/application/receipts/';

		//need to change filename to be unique to the user
		//$config['filename'] =

		echo "Upload path: " . $config['upload_path'];

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
      		$path = $this->ReceiptModel->receiptData_post($data['upload_data'], $this->get('id'));


		}

		// load the view/upload.php
		$this->load->view('upload_form', $data);

	}

	}

?>
