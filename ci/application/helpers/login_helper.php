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

function buildJWT_post() {
  if($this->post('jwtSubject') !== NULL) //if the form has been submitted
     {
             $builttoken = (new Builder())
                          ->setIssuer('https://capstone.td9175.com') // Configures the issuer (iss claim)
                          ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                          ->setExpiration(time() + 3600) // Configures the expiration time of the token (nbf claim)
                          ->set('sub', $this->post('jwtSubject')) // Configures a new claim, called "uid"
                         ->getToken(); // Retrieves the generated token
             $tokenSecret = "superdupersecret2017";
             $token = hash_hmac('sha256',$builttoken,$tokenSecret);
             $tokenFinal = $builttoken . $token;
             echo $tokenFinal;
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
