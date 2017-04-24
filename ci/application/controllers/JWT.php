<?php
require '/var/www/html/vendor/autoload.php';
require('application/libraries/REST_Controller.php');
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

// RESTful API for User Account functions
class JWT extends REST_Controller {

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

  function jwt_parse_post($token) {
    $token = (new Parser())->parse((string) $token); // Parses from a string
    $token->getHeaders(); // Retrieves the token header
    $token->getClaims(); // Retrieves the token claims

    echo $token->getHeader('jti'); // will print "4f1g23a12aa"
    echo $token->getClaim('iss'); // will print "https://capstone.td9175.com"
    echo $token->getClaim('uid'); // will print "1"

  }

  function verifyJWT_post() {

    if ($this->post('token') !== NULL) {
      $token = $this->post('token');

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
      $this->response("Valid token is required.", 400);
    }

  }


}
?>
