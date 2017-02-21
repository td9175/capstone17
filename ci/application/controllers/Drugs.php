<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drugs extends CI_Controller {
     
	public function __construct() 
	{
        parent::__construct();
        $this->config->load('goodRx');
        $this->load->helper('url');
		$this->load->helper('form'); 
    }


	public function index()
	{
		$this->load->view('drugs');
	}
	
	
	public function base64url_encode($data) 
	{ 
    	return strtr(base64_encode($data), '+/', '__'); 
	} 


	public function search_for_drug()
	{
	
      // Get user input from the form on drugs.php
      // Load GoodRx API key and secret key
      $searchQuery = $this->input->post("searchQuery");
      $apiKey = $this->config->item('apiKey');
      $secretKey = $this->config->item('secretKey');
            
      // Report all errors
      error_reporting(E_ALL);
      
      // Initialize the CURL package. This is the thing that sends HTTP requests
      $ch = curl_init();
      
      // Create the URL
      $url = "https://api.goodrx.com/drug-search?";
      
      // Build the query string
      $queryString = "query=" . $searchQuery . "&api_key=" . $apiKey;      
      
      // Generate a keyed hash signature using HMAC / SHA256 on the query string and the GoodRx secret API key
      $sig = self::base64url_encode(hash_hmac('sha256', $queryString, $secretKey, true));
      
      //Build the URL string with the query string and keyed hash signature
      $url = $url . $queryString . "&sig=" . $sig;
      
      // Set some curl options
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
      
      // Execute a curl request on the GoodRx API and get a JSON response
      $response = curl_exec($ch);
      
      // Decode the JSON string into a PHP object of stdClass
      $response = json_decode($response);

      // Insert the response object into the data array    
      $data['searchData'] = $response;
      
      // Load the drugs view and pass the data array along with it
      $this->load->view('drugs', $data);
    }
    
    
    public function price_comparison($name)
	{
      //$searchQuery = $this->input->post("searchQuery");
      $apiKey = $this->config->item('apiKey');
      $secretKey = $this->config->item('secretKey');
      
      // Report all errors
      error_reporting(E_ALL);
      
      // Initialize the CURL package. This is the thing that sends HTTP requests
      $ch = curl_init();
      
      // Create the URL
      $url = "https://api.goodrx.com/compare-price?";
      
      // Build the query string
      $queryString = "name=" . $name . "&api_key=" . $apiKey;
      
      //$tempSig = hash_hmac('sha256', $queryString, $secretKey, true);
      //$sig = self::base64url_encode($tempSig);
      
      // Generate a keyed hash signature using HMAC / SHA256 on the query string and the GoodRx secret API key
      $sig = self::base64url_encode(hash_hmac('sha256', $queryString, $secretKey, true));
      
      //Build the URL string with the query string and keyed hash signature
      $url = $url . $queryString . "&sig=" . $sig;
      
      // Set some curl options
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
      
      // Execute a curl request on the GoodRx API and get a JSON response
      $response = curl_exec($ch);
      
      // Decode the JSON string into a PHP object of stdClass
      //$response = json_decode($response);
      
      // Insert the response object into the data array 
      //$data['priceData'] = $response;
      
      // Load the drugs view and pass the data array along with it
      //$this->load->view('drugs', $data);
      return $response;
    }
}

