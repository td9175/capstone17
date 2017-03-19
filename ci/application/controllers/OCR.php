<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'HTTP_Request2-2.3.0/HTTP/Request2.php');

class Ocr extends CI_Controller {
	    
	    //needs to read in an image file
	    //upload that image file to server
	    //pull that image file from server and send to API
	    //send back JSON data to front end
function upload_post() {
		$target_dir = "uploads/";
		
		
		$image = $this->post('image');
		
		echo "in upload_image";
		//fileToUpload is post variable from form
		
		$target_file = $target_dir . basename($_FILES[$image]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES[$image]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES[$image]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES[$image]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES[$image]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}


}
	    
function ocr_request($image) {
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

			// Request body
			$newurl = "{'url': '";
			$newurl .= $image;
			$newurl = "'}";
			echo "url: "  . $newurl;
			echo "<br><Br>";
			$request->setBody($image);

			try {
				$response = $request->send();
				//echo $response->getBody();
				$newanswer = $response->getBody();
				echo "<br><Br>";
		
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