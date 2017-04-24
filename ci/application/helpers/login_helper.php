<?php
require '/var/www/html/vendor/autoload.php';
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

function is_logged_in() {
  if (isset($_SESSION['logged_in'])) {
    return TRUE;
  } else {
    die("Please log in.");

  }
}

  function verifyJWT($token) {

    if ($token !== NULL) {

      $token = (new Parser())->parse((string) $token); // Parses from a string
      $token->getHeaders(); // Retrieves the token header
      $token->getClaims(); // Retrieves the token claims

      $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
      $data->setIssuer('https://capstone.td9175.com');

      if ($token->validate($data) !== TRUE) {
        die("Valid token is required.");
      }

    } else {
      die("Valid token is required.");
    }

  }

 ?>
