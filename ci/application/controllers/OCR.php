<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

/*
		@Author: Sami Holder
		12bit - UMB Bank Health Spending App
*/
header("Access-Control-Allow-Origin: *");
require_once(APPPATH.'HTTP_Request2-2.3.0/HTTP/Request2.php');

class Ocr extends CI_Controller {



	public function ocr_request() {

			//imagePath should be the email/name of the file
			//$imagePath = $_SESSION['path'];
			$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/vision/v1.0/ocr');
			$url = $request->getUrl();
			$path = 'https://capstone.td9175.com/ci/application/receipts/walrmart1.jpg';
			//$path .= $imagePath;

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



				}//end try
			catch (HttpException $ex) {
				echo $ex;
			}

		}


	}



?>
