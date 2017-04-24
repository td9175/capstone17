<?php
require '/var/www/html/vendor/autoload.php';
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\ValidationData;

// RESTful API for User Account functions
class UserAccount2 extends REST_Controller {

  function buildJWT_get() {
    if(isset($_GET['jwtSubject'])) //if the form has been submitted
       {
               $builttoken = (new Builder())->set('sub', $_GET['jwtSubject']) // Configures a new claim, called "uid"
                           ->getToken(); // Retrieves the generated token
               $tokenSecret = "superdupersecret2017";
               $token = hash_hmac('sha256',$builttoken,$tokenSecret);
               $tokenFinal = $builttoken . $token;
               echo $tokenFinal;
       }
  }

  function verifyJWT_get() {

    if (isset($this->get('token'))) {
      $token = $this->get('token');
      $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
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
