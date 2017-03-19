<?php
/*

		@Author: Robert Fink
		12bit - UMB Bank Health Spending App

*/

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Yelp Fusion API code.
 *
 * This program demonstrates the capability of the Yelp Fusion API
 * by using the Business Search API to query for businesses by a
 * search term, location, and radius. Then using the Yelp Business and Review API's to query additional
 * information about the results from the search query.
 *
 * Please refer to http://www.yelp.com/developers/v3/documentation
 * for the API documentation.
 */

class YelpHealthServiceRequest extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->config->load('yelpFusion');
  }


  /**
   * Send a GET request to the Yelp API
   *
   * @return   OAuth bearer token, obtained using clientId and clientSecret.
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


  /**
   * Makes a request to the Yelp API and returns the response
   *
   * @param    $bearer_token   API bearer token from obtain_bearer_token
   * @param    $host    The domain host of the API
   * @param    $path    The path of the API after the domain.
   * @param    $url_params    Array of query-string parameters.
   * @return   The JSON response from the request
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
          $url = $host . $path . "?" . http_build_query($url_params);

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


  /**
   * Query the Search API by a search term and location
   *
   * @param    $bearer_token   API bearer token from obtain_bearer_token
   * @param    $term        The search term passed to the API
   * @param    $location    The search location passed to the API
	 * @param    $categories  The category to filter by
	 * @param    $radius      The radius to search within the location
	 * @param    $limit 			The number to limit search results by
   * @return   The JSON response from the request
   */
   function search($bearer_token, $term, $location, $latitude, $longitude, $categories, $radius, $limit) {

     // Yelp Fusion API constants
     $apiHost = $this->config->item('apiHost');
     $searchPath = $this->config->item('searchPath');

     // Build the paramater array
     $url_params = array();
    	$url_params['term'] = $term;
      $url_params['location'] = $location;
			$url_params['latitude'] = $latitude;
			$url_params['longitude'] = $longitude;
			$url_params['categories'] = $categories;
			$url_params['radius'] = $radius;
			$url_params['limit'] = $limit;

      // Call the API request method
      $response = $this->request($bearer_token, $apiHost, $searchPath, $url_params);
      return $response;
  }


  /**
   * Queries the API by the input values from the user
   *
   * @param    $term        The search term to query
   * @param    $location    The location of the business to query
	 * @param    $categories  The category to filter by (constant HEALTH)
	 * @param    $radius      The radius to search within the location
	 * @param    $limit 			The number to limit search results by
   */
   function query_api() {

     // Constant
     $categories = $this->config->item('categories');

     // Get user input
     $term = $this->input->post('term');
     $location = $this->input->post('location');
		 $latitude = $this->input->post('latitude');
		 $longitude = $this->input->post('longitude');
		 $radius = $this->input->post('radius');
		 $limit = $this->input->post('limit');

     // Get the bearer token
     $bearer_token = $this->obtain_bearer_token();

     // Send a request to the search method
     $response = json_decode($this->search($bearer_token, $term, $location, $latitude, $longitude, $categories, $radius, $limit));

     var_dump($response);
  }
}

// /**
//  * Query the Business API by business_id
//  *
//  * @param    $bearer_token   API bearer token from obtain_bearer_token
//  * @param    $business_id    The ID of the business to query
//  * @return   The JSON response from the request
//  */
// function get_business($bearer_token, $business_id) {
//     $businessPath = $businessPath . urlencode($business_id);
//
//     return request($bearer_token, $GLOBALS['apiHost'], $businessPath);
// }
//  print "$response\n";
// $business_id = $response->businesses[0]->id;
//
// print sprintf(
//     "%d businesses found, querying business info for the top result \"%s\"\n\n",
//     count($response->businesses),
//     $business_id
// );
//
// $response = get_business($bearer_token, $business_id);
//
// print sprintf("Result for business \"%s\" found:\n", $business_id);
// $pretty_response = json_encode(json_decode($response), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
// print "$pretty_response\n";

?>
