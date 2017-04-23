<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

class RegexOCR extends REST_Controller {

  // Gets the qualified items and amounts from the Microsoft OCR results
  // Make POST requests too https://capstone.td9175.com/ci/index.php/RegexOCR/qualified_receipt_regex
  // POST variable to send: receiptString
  function qualified_receipt_regex_post() {

    if ($this->post('receiptString') == NULL ) {
      $this->response("OCR result string required.");
    }

    $string = $this->post('receiptString');

    // Get the Y cordinate for everything
    preg_match_all('/\d+,(\d+),\d+,\d+/i', $string, $matches);

    // Put the matches array into a named variable
    $yPositions = $matches[1];

    // Initialize an empty array to hold the positions
    $positions = array();

    // Cast the array of strings to Int
    foreach ($yPositions as $position) {
      $integerPosition = (Int) $position;
      array_push($positions, $integerPosition);
    }

    // Remove duplicate Y values
    $positions = array_unique($positions);

    // Sort ascending
    array_multisort($positions, SORT_ASC);

    $wordString = "";

    // Loop through the Y positions
    foreach ($positions as $position) {
      // Build regular expression
      $regex = '/\d{1,3},'.$position.',\d{1,3},\d{1,3}.*\n.*text":\s"(.*)"/';

      // Match for the words
      preg_match_all($regex, $string, $matches);
        $words = $matches[1];

        // Turn the array into a string
        foreach ($words as $word) {
          $wordString .= $word . " ";
        }
    }

    // Match for qualified items, capture the amount
    $regex = '/([^nxhdjt]\w+\s?\w+)\s?\d{12}H\s(\d+\.\d+)[^\d]/';
    preg_match_all($regex, $wordString, $matches);
    $qualifiedItems = $matches[1];
    $qualifiedAmounts = $matches[2];

    if (count($qualifiedItems) > 0) {
      for ($i=0; $i < count($qualifiedItems); $i++) {
        $response[$i] = array($qualifiedItems[$i] => $qualifiedAmounts[$i]);
      }

      // Add up the amounts for the total qualified amount
      // $total = 0;
      // foreach ($qualifiedAmounts as $qualifiedAmount) {
      //   $total += $qualifiedAmount;
      // }
      //
      // array_push($response, $total);

    } else {
      $response = "No reimbursement qualified items.";
    }

    $this->response($response, 200);
  }

}
