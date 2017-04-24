<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

/*
 * Yelp Fusion API code.
 * This program demonstrates the capability of the Yelp Fusion API
 * by using the Business Search API to query for businesses by a
 * search term, location, and radius. Then using the Yelp Business and Review API's to query additional
 * information about the results from the search query.

 * Please refer to http://www.yelp.com/developers/v3/documentation
 * for the API documentation.
 */

class YelpHealthServiceRequest extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->config->load('yelpFusion');
  }


  /*
   Send a GET request to the Yelp API for the authentication token
   @return   OAuth bearer token, obtained using clientId and clientSecret.
  */
   function obtain_bearer_token() {
     // Yelp Fusion API secret stuff
     $clientId = $this->config->item("clientId");
     $clientSecret = $this->config->item('clientSecret');
     $grantType = $this->config->item('grantType');

     // Yelp Fusion API constants
     $apiHost = $this->config->item('apiHost');
     $tokenPath = $this->config->item('tokenPath');

      try {
					// Initialize curl and make sure it worked
          $curl = curl_init();
          if (FALSE === $curl){
            throw new Exception('Failed to initialize');
          }

          // Build the post fields string for authentication
          $postfields = "client_id=" . $clientId . "&client_secret=" . $clientSecret . "&grant_type=" . $grantType;

					// Set an array of curl options
          curl_setopt_array($curl, array(
            CURLOPT_URL => $apiHost . $tokenPath,
            CURLOPT_RETURNTRANSFER => true,  // Capture response.
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
            ),
          ));

					// Execute a curl request and make sure curl did not fail
          $response = curl_exec($curl);
          if (FALSE === $response){
            throw new Exception(curl_error($curl), curl_errno($curl));
          }

					// Make sure status is 200 Success
          $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
          if (200 != $http_status){
            throw new Exception($response, $http_status);
          }

					// Close curl
          curl_close($curl);

      } catch(Exception $e) {
          trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
      }

      // Extract the bearer token from the response
      $body = json_decode($response);
      $bearer_token = $body->access_token;
      return $bearer_token;
  }


  /*
    Makes a request to one of the Yelp API's and returns a response

   @param    $bearer_token   API bearer token from obtain_bearer_token
   @param    $host    The domain host of the API
   @param    $path    The path of the API after the domain.
   @param    $url_params    Array of query-string parameters.
   @return   The JSON response from the request
  */
   function request($bearer_token, $host, $path, $url_params = array()) {
      // Try to send a Yelp API Call
      try {

					// Initialize curl and make sure it worked
          $curl = curl_init();
          if (FALSE === $curl){
            throw new Exception('Failed to initialize');
          }

					// Generate URL-encoded query string
					if (strcmp($path, "/v3/businesses/") == 0){ // The strings are a match, request for business info
						$url = $host . $path . $url_params;
					}
					elseif (strcmp($path, "/v3/businesses/{id}/reviews") == 0){ // The strings are a match, request for business reviews
						$url = $host . "/v3/businesses/" . $url_params . "/reviews";
					}
					else {
						$url = $host . $path . "?" . http_build_query($url_params);
					}

					// Set an array of curl options
          curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,  // Capture response.
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                  "authorization: Bearer " . $bearer_token,
                  "cache-control: no-cache",
              ),
          ));

					// Execute a curl request and make sure curl did not fail
          $response = curl_exec($curl);
          if (FALSE === $response){
            throw new Exception(curl_error($curl), curl_errno($curl));
          }

					// Make sure status is 200 Success
          $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
          if (200 != $http_status){
            throw new Exception($response, $http_status);
          }

					// Close curl
          curl_close($curl);

      } catch(Exception $e) {
          trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
      }
      return $response;
  }

	/*
   Queries the Yelp autocomplete API with the input values from the user
   @param    $text        The search term to query
	 @param    $latitude    The location of the business to query (Required)
	 @param    $longitude   The location of the business to query (Required)
  */
	function auto_complete(){
		// Check for a valid JSON web token
		verifyJWT($this->input-post('token'));

		// Yelp Fusion API constants
		$apiHost = $this->config->item('apiHost');
		$autoCompletePath = $this->config->item('autoCompletePath');

		// Get user input
		$text = $this->input->post('text');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');

		// Build the paramater array
		$url_params = array();
		$url_params['text'] = $text;
		$url_params['latitude'] = $latitude;
		$url_params['longitude'] = $longitude;

		// Get the bearer token
		$bearer_token = $this->obtain_bearer_token();

		// Call the API request method
		$response = $this->request($bearer_token, $apiHost, $autoCompletePath, $url_params);

		// Print out the JSON response
		echo "$response";
	}


	/*
   Queries the Yelp search API with the input values from the user
   @param    $text        The search term to query (optional)
   @param    $location    The location of the business to query (Required if latitude and longitude are not provided.)
	 @param    $latitude    The location of the business to query (Required if location is not provided.)
	 @param    $longitude   The location of the business to query (Required if location is not provided.)
	 @param    $categories  The category to filter by (constant HEALTH)
	 @param    $radius      The radius to search within the location (optional, MAX=40000 (25 miles))
	 @param    $limit 			The number to limit search results by (optional, default=20 MAX=50)
   */
   function search_query() {
		 // Check for a valid JSON web token
 		verifyJWT($this->post('token'));

		 // Yelp Fusion API constants
     $apiHost = $this->config->item('apiHost');
     $searchPath = $this->config->item('searchPath');

     // Constant
     $categories = $this->config->item('categories');

     // Get user input
     $term = $this->input->post('term');
     $location = $this->input->post('location');
		 $latitude = $this->input->post('latitude');
		 $longitude = $this->input->post('longitude');
		 $radius = $this->input->post('radius');
		 $limit = $this->input->post('limit');

		 // Build the paramater array
     $url_params = array();
	  	$url_params['term'] = $term;
	    $url_params['location'] = $location;
			$url_params['latitude'] = $latitude;
			$url_params['longitude'] = $longitude;
			$url_params['categories'] = $categories;
			$url_params['radius'] = $radius;
			$url_params['limit'] = $limit;

     // Get the bearer token
     $bearer_token = $this->obtain_bearer_token();

		 // Call the API request method
		 $response = $this->request($bearer_token, $apiHost, $searchPath, $url_params);

     // Print out the JSON response
		 echo "$response";
  }


	/*
  	Queries the Yelp business API with the input values from the user
  	@param    $id        	The selected business id to query (Required)
   */
	function business_info(){
		// Check for a valid JSON web token
		verifyJWT($this->post('token'));

		// Yelp Fusion API constants
		$apiHost = $this->config->item('apiHost');
		$businessPath = $this->config->item('businessPath');

		// Get user input for the selected business id
		$id = $this->input->post('id');

		// Get the bearer token
		$bearer_token = $this->obtain_bearer_token();

		// Call the API request method
		$response = $this->request($bearer_token, $apiHost, $businessPath, $id);

		// Print out the JSON response
		echo "$response";
	}


	/*
	 Queries the Yelp reviews API for a business
	 @param    $id        	The selected business id to query (Required)
	 */
	function business_reviews(){
		// Check for a valid JSON web token
		verifyJWT($this->post('token'));

		// Yelp Fusion API constants
		$apiHost = $this->config->item('apiHost');
		$reviewsPath = $this->config->item('reviewsPath');

		// Get user input for the selected business id
		$id = $this->input->post('id');

		// Get the bearer token
		$bearer_token = $this->obtain_bearer_token();

		// Call the API request method
		$response = $this->request($bearer_token, $apiHost, $reviewsPath, $id);

		// Print out the JSON response
		echo "$response";
	}

}


?>
