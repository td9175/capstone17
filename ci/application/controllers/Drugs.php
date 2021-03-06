<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Drugs extends REST_Controller {

	public function __construct(){
        parent::__construct();
        $this->config->load('goodRx');
        $this->load->helper('url');
				$this->load->helper('form');
  }

	public function base64url_encode($data){
    	return strtr(base64_encode($data), '+/', '__');
	}

	public function search_for_drug_get(){

		$searchQuery = $this->get('searchQuery');
		$token = $this->get('token');

		// Check for a valid JSON web token
		verifyJWT($token);

      // Load GoodRx API key and secret key
      $apiKey = $this->config->item('apiKey');
      $secretKey = $this->config->item('secretKey');

      // Report all errors
      error_reporting(E_ALL);

      // Initialize the CURL package. This is the thing that sends HTTP requests
      $ch = curl_init();

      // Create the URL
      $url = "https://api.goodrx.com/drug-search?";

      // Build the query string
      $queryString = "query=" . urldecode($searchQuery) . "&api_key=" . $apiKey;

      // Generate a keyed hash signature using HMAC / SHA256 on the query string and the GoodRx secret API key
      $sig = self::base64url_encode(hash_hmac('sha256', $queryString, $secretKey, true));
			// echo "$sig \n";

      //Build the URL string with the query string and keyed hash signature
      $url = $url . $queryString . "&sig=" . $sig;
			// echo "$url \n";

      // Set some curl options
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_VERBOSE, TRUE);

      // Execute a curl request on the GoodRx API and get a JSON response
      $response = curl_exec($ch);

      // Echo the response for RESTful API calls
      echo $response;
    }


    public function price_comparison_get(){

			$name = $this->get('name');
			$token = $this->get('token');

			// Check for a valid JSON web token
			verifyJWT($token);

      // Load GoodRx API key and secret key
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

      // Generate a keyed hash signature using HMAC / SHA256 on the query string and the GoodRx secret API key
      $sig = self::base64url_encode(hash_hmac('sha256', $queryString, $secretKey, true));
			// echo "$sig \n";

      //Build the URL string with the query string and keyed hash signature
      $url = $url . "name=" . $name . "&api_key=" . $apiKey . "&sig=" . $sig;
			// echo "$url \n";

      // Set some curl options
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_VERBOSE, TRUE);

      // Execute a curl request on the GoodRx API and get a JSON response
      $response = curl_exec($ch);

      // Echo the response for RESTful API calls
      echo $response;
    }

}
