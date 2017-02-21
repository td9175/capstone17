<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocr extends CI_Controller {
     
	public function __construct() 
	{
        parent::__construct();
        $this->config->load('ocr_api');
        $this->load->helper('url');
		$this->load->helper('form'); 
    }


	public function index()
	{
		$this->load->view('ocr');
	}
	
	
	public function base64url_encode($data) 
	{ 
    	return strtr(base64_encode($data), '+/', '__'); 
	} 


	public function call_service($image)
	{
	
   
// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
require_once 'HTTP/Request2.php';

$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/vision/v1.0/ocr');
$url = $request->getUrl();

	$headers = array(
    	// Request headers
    	'Content-Type' => 'application/json',
    	'Ocp-Apim-Subscription-Key' => '16eb25ebbaeb430695f63f2b23f22606',
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
	$request->setBody({"url:http://example.com/images/test.jpg"});

	try
	{
    	$response = $request->send();
    	echo $response->getBody();
	}
	catch (HttpException $ex)
	{
    	echo $ex;
	}


    }
    
    
   
}