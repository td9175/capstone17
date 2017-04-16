<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

$response = "Please log in.";
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
  $email = $_SESSION['email'];
  $response = "$email logged in.";
}
// Send back a response
$this->response($response);

?>
