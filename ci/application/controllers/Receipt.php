<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'HTTP_Request2-2.3.0/HTTP/Request2.php');


	class Receipt extends CI_Controller {

		//function to insert receipt into DB
		//function to insert OCR info into DB
		
		
		function parse_it() {
			echo "Parsing <br><Br>";
			$string = '{
				  "language": "en",
				  "textAngle": 0,
				  "orientation": "Up",
				  "regions": [

						{
						  "boundingBox": "72,797,274,16",
						  "words": [
							{
							  "boundingBox": "72,799,44,14",
							  "text": "THANK"
							},
							{
							  "boundingBox": "127,799,26,14",
							  "text": "you"
							},
							{
							  "boundingBox": "164,798,26,14",
							  "text": "FOR"
							},
							{
							  "boundingBox": "201,798,71,14",
							  "text": "SHOPPING"
							},
							{
							  "boundingBox": "283,798,36,14",
							  "text": "UITH"
							},
							{
							  "boundingBox": "330,797,16,15",
							  "text": "US"
							}
						  ]
						},
						{
						  "boundingBox": "110,816,70,16",
						  "words": [
							{
							  "boundingBox": "110,816,70,16",
							  "text": "10\/14\/10"
							}
						  ]
						},
						{
						  "boundingBox": "229,816,14,14",
						  "words": [
							{
							  "boundingBox": "229,816,14,14",
							  "text": "21"
							}
						  ]
						}
					  ]
					}
				  ]
				}';
		
		
		preg_match_all("/([0-9]{2})\/([0-9]{2})\/([0-9]{2})/", $string, $matches);
		echo "<br>";
		//echo "Matches: ". $matches;
		print_r($matches);
		
		
		}
		function upload_it() {
			session_start();
			//load the helper
			$this->load->helper('form');
			$this->load->helper('url');
			$this->load->helper('string');
			$this->load->model('ReceiptModel');

			//need to create folder for each user, path will be unique to the user
			$email = $_SESSION['email'];
			//$email = "hello@world.com";
			echo "Email: ". $email; 
			$date = date('d-m-y');
			$rand = random_string('alnum', 3);
			echo "<br>Date:" . $date;
			
			$f_name = $date;
			$f_name .= $rand;
		
			$config['upload_path'] = '/var/www/html/ci/application/receipts/';
			$config['upload_path'] .= $email;
		
			//need to change filename to be unique to the user
			$config['file_name'] = $f_name;
			

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
				$path = 'hello@world.com/';
				$path .= $f_name;
				$path .= '.jpg';
				$_SESSION['path'] = $path;
				echo "Path: " . $path;
				redirect('OCR/ocr_request');
			}

			// load the view/upload.php
			
		$this->load->view('upload_form', $data);

	}
	
	
	
	

	}

?>
