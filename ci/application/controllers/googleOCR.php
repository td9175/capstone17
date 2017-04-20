<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

/*
		@Author: Sami Holder
		12bit - UMB Bank Health Spending App
*/
header("Access-Control-Allow-Origin: *");
//require_once(APPPATH.'HTTP_Request2-2.3.0/HTTP/Request2.php');

class googleOCR extends CI_Controller {



	public function test_ocr() {
	
		use GoogleCloudVisionPHP\GoogleCloudVision;

$gcv = new GoogleCloudVision();

// Follow instruction from Google Cloud Vision Document
$gcv->setKey("AIzaSyBcjXyf318beGjL-Hx1hTr16BK30zKw20I");

$gcv->setImage("receipts/test.png");

// 1 is Max result
$gcv->addFeature("LABEL_DETECTION", 1);

$gcv->addFeatureUnspecified(1);
$gcv->addFeatureFaceDetection(1);
$gcv->addFeatureLandmarkDetection(1);
$gcv->addFeatureLogoDetection(1);
$gcv->addFeatureLabelDetection(1);
$gcv->addFeatureOCR(1);
$gcv->addFeatureSafeSeachDetection(1);
$gcv->addFeatureImageProperty(1);

//Optinal
$gcv->setImageContext(array("languageHints"=>array("th")));

$response = $gcv->request();
	
	
	}
	
	
	
	
}//end of class



?>
