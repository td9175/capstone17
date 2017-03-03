<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocr extends CI_Controller {
  
  
  
  
  	public function __construct() 
	{
        parent::__construct();
        //$this->config->load('goodRx');
        //$this->load->helper('url');
		$this->load->helper('form'); 
    }
	public function index() {
		$this->load->view('ocr');
	}
	
	
	public function getImage(){
	
		echo "here i am";
			//extract data from the post
		//set POST variables
		$url = 'https://westus.api.cognitive.microsoft.com/vision/v1.0/ocr?language=en&detectOrientation =true';
		$this->headers[] = 'Content-type: application/json';
		$this->headers[] = 'Ocp-Apim-Subscription-Key: 16eb25ebbaeb430695f63f2b23f22606'; 
		$this->headers[] = 'Host: westus.api.cognitive.microsoft.com'; 
		 
		
		$body = '{"url":"http://example.com/images/test.jpg"}';

		

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers); 
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $body);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
	
		}
		
		
	
	}

?>