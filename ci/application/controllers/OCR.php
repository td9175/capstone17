<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'HTTP_Request2-2.3.0/HTTP/Request2.php');

class Ocr extends CI_Controller {
	    

	    
function ocr_request() {
			$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/vision/v1.0/ocr');
			$url = $request->getUrl();
	
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

			$image = 'http://i1008.photobucket.com/albums/af202/CompSyn/Walmart_QS_zpsw3uk1oeh.png';
			// Request body
			$newurl = "{'url': '";
			$newurl .= $image;
			$newurl = "'}";
			echo "url: "  . $newurl;
			echo "<br><Br>";
			$request->setBody("{'url':'http://i1008.photobucket.com/albums/af202/CompSyn/Walmart_QS_zpsw3uk1oeh.png'}");

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