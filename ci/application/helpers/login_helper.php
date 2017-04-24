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
      // $data->setIssuer('http://example.com');
      // $data->setAudience('http://example.org');
      // $data->setId('4f1g23a12aa');

      var_dump($token->validate($data)); // false, because we created a token that cannot be used before of `time() + 60`

      // $data->setCurrentTime(time() + 60); // changing the validation time to future
      //
      // var_dump($token->validate($data)); // true, because validation information is equals to data contained on the token
      //
      // $data->setCurrentTime(time() + 4000); // changing the validation time to future
      //
      // var_dump($token->validate($data)); // false, because token is expired since current time is greater than exp
    } else {
      die("Valid token is required.");
      // $this->response("Valid token is required.", 400);
    }

  }

  // function verifyJWT_post() {
  //
  //   if ($this->post('token') !== NULL) {
  //     $token = $this->post('token');
  //
  //     $token = (new Parser())->parse((string) $token); // Parses from a string
  //     $token->getHeaders(); // Retrieves the token header
  //     $token->getClaims(); // Retrieves the token claims
  //
  //
  //     $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
  //     $data->setIssuer('https://capstone.td9175.com');
  //     // $data->setIssuer('http://example.com');
  //     // $data->setAudience('http://example.org');
  //     // $data->setId('4f1g23a12aa');
  //
  //     var_dump($token->validate($data)); // false, because we created a token that cannot be used before of `time() + 60`
  //
  //     // $data->setCurrentTime(time() + 60); // changing the validation time to future
  //     //
  //     // var_dump($token->validate($data)); // true, because validation information is equals to data contained on the token
  //     //
  //     // $data->setCurrentTime(time() + 4000); // changing the validation time to future
  //     //
  //     // var_dump($token->validate($data)); // false, because token is expired since current time is greater than exp
  //   } else {
  //     $this->response("Valid token is required.", 400);
  //   }
  //
  // }


 ?>
