<?php
/*
		@Author: Sami Holder
		12bit - UMB Bank Health Spending App
*/

defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
require_once(APPPATH.'HTTP_Request2-2.3.0/HTTP/Request2.php');


	class Receipt extends CI_Controller {


	
		public function ocr_request() {
			echo "In OCR request\n";
			//imagePath should be the email/name of the file
			$imagePath = $_SESSION['path'];
			$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/vision/v1.0/ocr');
			$url = $request->getUrl();
			$path = 'https://capstone.td9175.com/ci/application/receipts/';
			$path .= $imagePath;

			$request->setConfig(array(
				'ssl_verify_peer'   => FALSE,
				'ssl_verify_host'   => FALSE
			));

			$headers = array(
			// Request headers
				'Content-Type' => 'application/json',
				'Ocp-Apim-Subscription-Key' => '16eb25ebbaeb430695f63f2b23f22606 ',
			);

			$request->setHeader($headers);

			$parameters = array(
			// Request parameters
				'language' => 'en',
				'detectOrientation ' => 'true',
			);

			$url->setQueryVariables($parameters);

			$request->setMethod(HTTP_Request2::METHOD_POST);


			$newurl = "{'url': '";
			$newurl .= $path;
			$newurl .= "'}";
			echo "url: "  . $newurl;
			echo "<br><Br>";
		
			
			
			
			$request->setBody($newurl);
			

			try {
				$response = $request->send();
				echo $response->getBody();
				$newanswer = $response->getBody();
				echo "<br><Br>";
				return $newanswer;
		

			   $jsonIterator = new RecursiveIteratorIterator(
			new RecursiveArrayIterator(json_decode($newanswer, TRUE)),
			RecursiveIteratorIterator::SELF_FIRST);

			foreach ($jsonIterator as $key => $val) {
					if(is_array($val)) {
						echo "$key:";
						echo "<br>";
					} else {
						echo "$key => $val";
						echo "<br>";
					}
			}
			



				}//end try
			catch (HttpException $ex) {
				echo $ex;
			}

		}

		function upload_it() {
			// Check if a user is logged in
			//is_logged_in();

			//$logged_in = is_logged_in();
			$this->load->helper('form');

			$this->load->helper('url');
			$this->load->helper('string');
			$this->load->model('ReceiptModel');


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


				$path = urlencode($email);
				$path .= $f_name;
				$path .= '.jpg';
				$_SESSION['path'] = $path;
				echo "<Br>Path: " . $path;
				//redirect('OCR/ocr_request');
				$parsed = ocr_request();
				if($parsed) {
					echo "Success\n";
				} else {
					echo "No results\n";
				}
				
				
			}

			// load the view/upload.php

		$this->load->view('upload_form', $data);

	}





}

?>
