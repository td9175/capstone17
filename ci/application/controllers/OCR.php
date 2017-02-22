<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocr extends CI_Controller {
  
	public function index()
	{
		$this->load->view('ocr');
	}
	
	
	public function getImage($img){
	
	
			//extract data from the post
		//set POST variables
		$url = 'https://westus.api.cognitive.microsoft.com/vision/v1.0/ocr?language=en&detectOrientation =true';
		$body = array(
			'lname' => urlencode($_POST['last_name']),
			'fname' => urlencode($_POST['first_name']),
			'title' => urlencode($_POST['title']),
			'company' => urlencode($_POST['institution']),
			'age' => urlencode($_POST['age']),
			'email' => urlencode($_POST['email']),
			'phone' => urlencode($_POST['phone'])
		);

		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
	
	}
	
	

?>