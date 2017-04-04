<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drugs extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->config->load('goodRx');
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('upload');
  }


	public function index()
	{
		$this->load->view('drugs');
	}


	public function base64url_encode($data)
	{
    	return strtr(base64_encode($data), '+/', '__');
	}


	public function search_for_drug($searchQuery)
	{
      // Get user input from the form on drugs.php
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

      // Echo the response for RESTful API calls
      echo $response;
    }


    public function price_comparison($name)
	{
      // Get user input from the form on drugs.php
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

      //Build the URL string with the query string and keyed hash signature
      $url = $url . $queryString . "&sig=" . $sig;

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
    
public function do_upload() { 
         $config['upload_path']   = '/var/www/html/ci/uploads/'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $config['max_size']      = 100; 
         $config['max_width']     = 1500; 
         $config['max_height']    = 1500;  
         $this->load->library('upload');
         $this->upload->initialize($config);
         
         echo "Uplaod path: ";
         echo $config['upload_path']; 
         echo "<br>Here i am";
			
         if ( ! $this->upload->do_upload('userfile')) {
         	echo "!this->upload->do_upload<br><Br>";
         	$this->upload->data('file_name');  
            $error = array('error' => $this->upload->display_errors()); 
            echo "Error message:" . $error;
            //$this->load->view('upload_form', $error); 
         }
			
         else { 
         	echo "in else";
            $data = array('upload_data' => $this->upload->data()); 
            $this->load->view('upload_success', $data); 
         } 
      } 

}
