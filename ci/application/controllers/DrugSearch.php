<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DrugSearch extends CI_Controller {
    
	/**
	 * Index Page for this controller.
	 *
	 */

	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('form');        
		$this->load->view('drug_search');
	}
	
	public function base64url_encode($data) 
	{ 
    	return strtr(base64_encode($data), '+/', '__'); 
	} 

	public function search_for_drug()
	{
      $searchQuery = $this->input->post("searchQuery");
      $myApiKey = "e6f0409f1e";
      $secretKey = "7MsNWulBajxleiqMWO64TQ==";
      
      echo "$searchQuery";
      
      // Report all errors
      //error_reporting(E_ALL);
      
      // Initialize the CURL package. This is the thing that sends HTTP requests
      //$ch = curl_init();
      
      // Create the URL and the hash
      //$url = "https://api.goodrx.com/drug-search?";
      
      //$queryString="query=" . $searchQuery . "&api_key=" . $myApiKey;
      
      //$tempSig = hash_hmac('sha256', $queryString, $secretKey, true);
      
      //$sig = base64url_encode($tempSig);
      
      //$url = $url . $queryString . "&sig=" . $sig;
      
      // set some curl options
      //curl_setopt($ch, CURLOPT_URL, $url);
      //curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      //curl_setopt($ch, CURLOPT_HEADER, FALSE);
      //curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
      
      // run the query
      //$response = curl_exec($ch);
      
      //echo($response);
    }
}

