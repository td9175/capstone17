<?php
require '/var/www/html/vendor/autoload.php';
use Lcobucci\JWT\Builder;
// if(isset($_POST['jwtSubject'])) //if the form has been submitted
// 		{

            $builttoken = (new Builder())->setIssuer('http://example.com') // Configures the issuer (iss claim)
                        ->setAudience('http://example.org') // Configures the audience (aud claim)
                        ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                        ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
                        ->setExpiration(time() + 3600) // Configures the expiration time of the token (nbf claim)
                        ->set('sub', 'test') // Configures a new claim, called "uid"
                        ->getToken(); // Retrieves the generated token




            // $tokenHeader = "{\"alg\": \"HS256\",\"typ\": \"JWT\"}";
            // $tokenPayload = "{\"sub\": \"" . $_POST['jwtSubject'] . "\"}";
            // $tokenSecret = "superdupersecret2017";
            // $tokenForHash = base64_encode($tokenHeader) . "." . base64_encode($tokenPayload);
            // $token = hash_hmac('sha256',$tokenForHash,$tokenSecret);
            // $tokenFinal = $tokenForHash . "." . $token;

            // echo $tokenHeader . "\n";
            // echo $tokenPayload . "\n";
            // echo $tokenSecret . "\n";
            // echo $tokenForHash . "\n";
            // echo $token . "\n";
            // echo $tokenFinal . "\n";
            // echo "Dale";
            echo $builttoken;
		// }
?>