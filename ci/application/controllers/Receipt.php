<?php
/*
		@Author: Sami Holder
		12bit - UMB Bank Health Spending App
*/

defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');
require_once(APPPATH.'HTTP_Request2-2.3.0/HTTP/Request2.php');


	class Receipt extends REST_Controller {

		public function __construct(){
	        parent::__construct();
					$this->load->model('ReceiptModel');
		}
function indent($json) {

    $result      = '';
    $pos         = 0;
    $strLen      = strlen($json);
    $indentStr   = '  ';
    $newLine     = "\n";
    $prevChar    = '';
    $outOfQuotes = true;

    for ($i=0; $i<=$strLen; $i++) {

        // Grab the next character in the string.
        $char = substr($json, $i, 1);

        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
            $outOfQuotes = !$outOfQuotes;

        // If this character is the end of an element,
        // output a new line and indent the next line.
        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
            $result .= $newLine;
            $pos --;
            for ($j=0; $j<$pos; $j++) {
                $result .= $indentStr;
            }
        }

        // Add the character to the result string.
        $result .= $char;

        // If the last character was the beginning of an element,
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char == '{' || $char == '[') {
                $pos ++;
            }

            for ($j = 0; $j < $pos; $j++) {
                $result .= $indentStr;
            }
        }

        $prevChar = $char;
    }

    return $result;
}
  function qualified_receipt_regex_post($results) {
    // Check if a user is logged in
    is_logged_in();

  	$string = $results;
  	echo $string;
    // Get the Y cordinate for everything
    preg_match_all('/\d+,(\d+),\d+,\d+/i', $string, $matches);

    // Put the matches array into a named variable
    $yPositions = $matches[1];

    // Initialize an empty array to hold the positions
    $positions = array();

    // Cast the array of strings to Int
    foreach ($yPositions as $position) {
      $integerPosition = (Int) $position;
      array_push($positions, $integerPosition);
    }

    // Remove duplicate Y values
    $positions = array_unique($positions);

    // Sort ascending
    array_multisort($positions, SORT_ASC);

    $wordString = "";

    // Loop through the Y positions
    foreach ($positions as $position) {
      // Build regular expression
      $regex = '/\d{1,3},'.$position.',\d{1,3},\d{1,3}.*\n.*text":\s"(.*)"/';

      // Match for the words
      preg_match_all($regex, $string, $matches);
        $words = $matches[1];

        // Turn the array into a string
        foreach ($words as $word) {
          $wordString .= $word . " ";
        }
    }

    // Match for qualified items, capture the amount
    $regex = '/([^nxhdjt]\w+\s?\w+)\s?\d{12}H\s(\d+\.\d+)[^\d]/';
    preg_match_all($regex, $wordString, $matches);
    $qualifiedItems = $matches[1];
    $qualifiedAmounts = $matches[2];

    if (count($qualifiedItems) > 0) {
      for ($i=0; $i < count($qualifiedItems); $i++) {
        $response[$i] = array($qualifiedItems[$i] => $qualifiedAmounts[$i]);
      }

      // Add up the amounts for the total qualified amount
      // $total = 0;
      // foreach ($qualifiedAmounts as $qualifiedAmount) {
      //   $total += $qualifiedAmount;
      // }
      //
      // array_push($response, $total);

    } else {
      $response = "No reimbursement qualified items.";
    }

    $this->response($response, 200);
  }

		public function ocr_request() {
			echo "In OCR request\n";
			//imagePath should be the email/name of the file
			$imagePath = $_SESSION['path'];
			echo "session path = " . $imagePath;
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
				$answer = $response->getBody();
				//$newanswer = $response->getBody();
				$json_string = $this->indent($answer);
				//echo "<br><Br>";
				return $json_string;

				}//end try
			catch (HttpException $ex) {
				echo $ex;
			}

		}

		function upload_it_post() {
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


				$path = urlencode($email);
				//$path = 'umbcapstone17%40gmail.com/';
				$path .= '/';
				$path .= $f_name;
				$path .= '.jpg';
				$_SESSION['path'] = $path;
				echo "<Br>Path: " . $path;

				//redirect('OCR/ocr_request');
				$parsed = $this->ocr_request();
				echo "<BR>Parsed data: " . $parsed;
				if($parsed) {
					echo "Success\n";
					$results = $this->qualified_receipt_regex_post($parsed);
					echo "Parsed results: " . $results;
				} else {
					echo "No results\n";
				}
			}

			// load the view/upload.php

		$this->load->view('upload_form', $data);

	}

	function user_receipts_get() {
		// Check if a user is logged in
		// is_logged_in();
		if ($this->get('email') == NULL) {
			$this->response("Email is required.", 400);
    	} else {
			// URL decode
			$decodedEmail = urldecode($this->get('email'));
			// Call the model
			$response = $this->ReceiptModel->user_receipts_get($decodedEmail);
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
