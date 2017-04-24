<?php
require '/var/www/html/vendor/autoload.php';
use Lcobucci\JWT\Builder;
 if(isset($_POST['jwtSubject'])) //if the form has been submitted
 		{
            $builttoken = (new Builder())->set('sub', $_POST['jwtSubject']) // Configures a new claim, called "uid"
                        ->getToken(); // Retrieves the generated token
            $tokenSecret = "superdupersecret2017";
            $token = hash_hmac('sha256',$builttoken,$tokenSecret);
            $tokenFinal = $tokenForHash . $token;
            echo $tokenFinal;
        }
?>