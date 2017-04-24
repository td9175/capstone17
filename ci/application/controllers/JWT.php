<?php
//use Lcobucci\JWT\Builder;
if(isset($_POST['jwtSubject'])) //if the form has been submitted
		{

            function base64url_encode($data) { 
                return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
            } 
            $tokenHeader = "{\"alg\": \"HS256\",\"typ\": \"JWT\"}";
            $tokenPayload = "{\"sub\": \"" . $_POST['jwtSubject'] . "\"}";
            $tokenSecret = "superdupersecret2017";
            $tokenForHash = base64url_encode($tokenHeader) . "." . base64url_encode($tokenPayload);
            $token = hash_hmac('sha256',$tokenForHash,$tokenSecret);
            $tokenFinal = $tokenForHash . "." . $token;
            
            echo $tokenHeader . "\n";
            echo $_POST['jwtSubject'] . "\n";
            echo $tokenPayload . "\n";
            echo $tokenSecret . "\n";
            echo $tokenForHash . "\n";
            echo $token . "\n";
            echo $tokenFinal;
		}
?>