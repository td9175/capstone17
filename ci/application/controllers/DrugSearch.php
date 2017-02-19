<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DrugSearch extends CI_Controller {
     
	public function __construct() 
	{
        parent::__construct();
        $this->config->load('goodRx');
        $this->load->helper('url');
		$this->load->helper('form'); 
    }

	public function index()
	{
		$this->load->view('drug_search');
	}
	
	public function base64url_encode($data) 
	{ 
    	return strtr(base64_encode($data), '+/', '__'); 
	} 

	public function search_for_drug()
	{
      $searchQuery = $this->input->post("searchQuery");
      $apiKey = $this->config->item('apiKey');
      $secretKey = $this->config->item('secretKey');
      
            
      // Report all errors
      error_reporting(E_ALL);
      
      // Initialize the CURL package. This is the thing that sends HTTP requests
      $ch = curl_init();
      
      // Create the URL and the hash
      $url = "https://api.goodrx.com/drug-search?";
      
      $queryString="query=" . $searchQuery . "&api_key=" . $apiKey;
      
      $tempSig = hash_hmac('sha256', $queryString, $secretKey, true);
      
      $sig = self::base64url_encode($tempSig);
      
      $url = $url . $queryString . "&sig=" . $sig;
      
      // set some curl options
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
      
      //Run the query
      $jsonResponse = curl_exec($ch);

      //Encode JSON response to UTF-8and decode the JSON response
      $response = json_decode($jsonResponse);
      
      //$response = $jsonResponse;
      //  {"errors": [], "data": {"candidates": ["ibuprofen", "ibuprofen non-prescription", "ibuprofen junior strength", "ibudone", "ibuprofen lysine", "dibucaine", "imbruvica", "rifabutin"]}, "success": true} 

      //Insert the response variable into the data array and pass it to the view    
      $data['response'] = $response;
      
      $this->load->view('drug_search', $data);
    }
}

