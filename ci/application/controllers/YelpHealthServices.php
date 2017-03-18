<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Yelp Fusion API code.
 *
 * This program demonstrates the capability of the Yelp Fusion API
 * by using the Business Search API to query for businesses by a
 * search term and location, and the Business API to query additional
 * information about the top result from the search query.
 *
 * Please refer to http://www.yelp.com/developers/v3/documentation
 * for the API documentation.
 */
class YelpHealthServices extends CI_Controller {

  // API secret stuff
  private static $clientId;
  private static $clientSecret;
  private static $grantType;

	public function __construct()
	{
        parent::__construct();
        $this->config->load('yelpFusion');
        // self::$clientId = $this->config->item("clientId");
        // self::$clientSecret = $this->config->item('clientSecret');
        // self::$grantType = $this->config->item('grantType');

  }





  // API constants, you shouldn't have to change these.
  private static $apiHost = "https://api.yelp.com";
  private static $searchPath = "/v3/businesses/search";
  private static $businessPath = "/v3/businesses/";  // Business ID will come after slash.
  private static $tokenPath = "/oauth2/token";

  // Defaults for our simple example.
  private static $categories = "health";
  private static $defaultCategory = "health";
  private static $defaultTerm = "health";
  private static $defaultLocation = "65201";
  private static $searchLimit = 10;

  /**
   * Given a bearer token, send a GET request to the API.
   *
   * @return   OAuth bearer token, obtained using clientId and clientSecret.
   */
  static function obtain_bearer_token() {
    self::$clientId = $this->config->item("clientId");
    self::$clientSecret = $this->config->item('clientSecret');
    self::$grantType = $this->config->item('grantType');

      try {
          # Using the built-in cURL library for easiest installation.
          # Extension library HttpRequest would also work here.
          $curl = curl_init();
          if (FALSE === $curl)
              throw new Exception('Failed to initialize');
              $postfields = "clientId=" . self::clientId . "&clientSecret=" . self::clientSecret . "&grantType=" . self::grantType;
              curl_setopt_array($curl, array(
              CURLOPT_URL => $this->apiHost . $this->tokenPath,
              CURLOPT_RETURNTRANSFER => true,  // Capture response.
              CURLOPT_ENCODING => "",  // Accept gzip/deflate/whatever.
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
          $response = curl_exec($curl);
          if (FALSE === $response)
              throw new Exception(curl_error($curl), curl_errno($curl));
          $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
          if (200 != $http_status)
              throw new Exception($response, $http_status);
          curl_close($curl);
      } catch(Exception $e) {
          trigger_error(sprintf(
              'Curl failed with error #%d: %s',
              $e->getCode(), $e->getMessage()),
              E_USER_ERROR);
      }
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
  static function request($bearer_token, $host, $path, $url_params = array()) {
      // Send Yelp API Call
      try {
          $curl = curl_init();
          if (FALSE === $curl)
              throw new Exception('Failed to initialize');
          $url = $host . $path . "?" . http_build_query($url_params);
          curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,  // Capture response.
              CURLOPT_ENCODING => "",  // Accept gzip/deflate/whatever.
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                  "authorization: Bearer " . $bearer_token,
                  "cache-control: no-cache",
              ),
          ));
          $response = curl_exec($curl);
          if (FALSE === $response)
              throw new Exception(curl_error($curl), curl_errno($curl));
          $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
          if (200 != $http_status)
              throw new Exception($response, $http_status);
          curl_close($curl);
      } catch(Exception $e) {
          trigger_error(sprintf(
              'Curl failed with error #%d: %s',
              $e->getCode(), $e->getMessage()),
              E_USER_ERROR);
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
   * @return   The JSON response from the request
   */
  static function search($bearer_token, $term, $location, $categories) {
      $url_params = array();

      $url_params['term'] = $term;
      $url_params['location'] = $location;
      $url_params['limit'] = $searchLimit;
      $url_params['categories'] = $categories;

      // $response = YelpHealthServices->request($bearer_token, $this->apiHost, $this->searchPath, $url_params);
      $response = YelpHealthServices::request($bearer_token, $this->apiHost, $this->searchPath, $url_params);

      return $response;
      // return request($bearer_token, $this->apiHost, $this->searchPath, $url_params);
      // return YelpHealthServices->request($bearer_token, $this->apiHost, $this->searchPath, $url_params);
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





  /**
   * Queries the API by the input values from the user
   *
   * @param    $term        The search term to query
   * @param    $location    The location of the business to query
   * @param    $categories  The category to filter by
   */
  static function query_api() {
      $term = $this->input->post('term');
      $location = $this->input->post('location');
      // $radius = $this->input->post('radius');
      $bearer_token = YelpHealthServices::obtain_bearer_token();
      // $bearer_token = obtain_bearer_token();
      // $response = json_decode(search($bearer_token, $term, $location, $this->categories));
      $response = json_decode(YelpHealthServices::search($bearer_token, $term, $location, $this->categories));

      print "$response\n";
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
  }



  // /**
  //  * User input is handled here
  //  */
  // $longopts  = array(
  //     "term::",
  //     "location::",
  // );
  //
  // $options = getopt("", $longopts);
  // $term = $options['term'] ?: $GLOBALS['defaultTerm'];
  // $location = $options['location'] ?: $GLOBALS['defaultLocation'];
  // query_api($term, $location);


}






?>
