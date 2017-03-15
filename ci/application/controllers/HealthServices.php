<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HealthServices extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->config->load('yelpFusion');

  }

	// public function index()
	// {
	//
	// }

  public function health_services_search(){

		// Authentication stuff for Yelp Fusion API
		$clientId = $this->config->item('clientId');
		$clientSecret = $this->config->item('clientSecret');
		$grantType = $this->config->item('grantType');
    $accessToken = "ToZm1nA2LZMMGwV08Qxk259VBFwoFxYHuCKiZY5Qekf8DNKOLpCW_cKS1j73skD82HVh_E0-qKcXue1HZT8muKfa4WATpBvxLJ6XvcKhAvuemwOf1drck1vlszTIWHYx";
		$tokenType = "Bearer";

		// Constant CATEGORIES. All searches must be contained within the health category
		define("CATEGORIES", "health");

		// Parameters for the business search API
		$endpoint = "https://api.yelp.com/v3/businesses/search";
		$searchTerm = $this->input->post('term'); // Optional
    $location = $this->input->post('location'); // Required if either latitude or longitude is not provided. Specifies the combination of "address, neighborhood, city, state or zip, optional country" to be used when searching for businesses.
		$radius = $this->input->post('radius'); // Optional search radius in meters, max value is 40000 meters (25 miles)
    // $latitude;
    // $longitude;
    // $locale;
    // $limit;
    // $offset;
    // $sort_by;
    // $price;
    // $open_now;
    // $open_at;
    // $attributes;

		// Initialize curl and set options
    $curl = curl_init($endpoint);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_HEADER,'Content-Type: application/x-www-form-urlencoded');
		curl_setopt($curl, CURLOPT_HEADER,'Authorization: Bearer ' . $accessToken);

		// Build the post string and sanitize the user input
		$postData = "term=" . urlencode($searchTerm) . "&location=" . urlencode($location) . "&radius=" . urlencode($radius);

		// Set the post fields option for curl
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);

		// Execute the curl request on Yelp Fusion API
    $json_response = curl_exec($curl);

		// What is the status of the response?
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    // Evaluate for success response
    if ($status != 200) {
      throw new Exception("Error: call to URL $endpoint failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) . "\n");
    }

		// Close curl
    curl_close($curl);

		// Send back the JSON response
    return $json_response;
  }



}
