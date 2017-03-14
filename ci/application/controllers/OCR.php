<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Ocr extends CI_Controller {
	    
	    
        // Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.ocr.space/Parse/Image',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        apikey => '26be4c08a388957',
        language => 'eng',
        url => 'https://c1.staticflickr.com/6/5309/5639277711_aac21b0e02_b.jpg'
    )
));
// Send the request & save response to $resp
$resp = curl_exec($curl);

echo "response: " . json_encode($resp);
// Close request to clear up some resources

curl_close($curl);
public function index() {
$this->load->view('ocr.php');

}
}

?>