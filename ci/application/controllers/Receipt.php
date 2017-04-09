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
				$path = 'hello@world.com';
				$path .= $date;
				$ocrResponse = ocr_request($path);


			}

			// load the view/upload.php
		$this->load->view('upload_form', $data);

	}
	
	
	
	function ocr_request($imagePath) {
	
			//imagePath should be the email/name of the file 
			
			$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/vision/v1.0/ocr');
			$url = $request->getUrl();
			$path = 'http://capstone.td9178.com/ci/application/receipts/';
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

			
			// Request body
			$newurl = "{'url': '";
			$newurl .= $path;
			$newurl = "'}";
			echo "url: "  . $newurl;
			echo "<br><Br>";
			$request->setBody($newurl);

			try {
				$response = $request->send();
				//echo $response->getBody();
				$newanswer = $response->getBody();
				echo "<br><Br>";
				json_encode($newanswer);
				echo "New: " . $newanswer;
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
		
				}
			catch (HttpException $ex) {
				echo $ex;
			}

		}
	

	}

?>
