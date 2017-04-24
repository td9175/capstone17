<?php
//use Lcobucci\JWT\Builder;
if(isset($_POST['jwtSubject'])) //if the form has been submitted
		{
            $tokenHeader = "{\"alg\": \"HS256\",\"typ\": \"JWT\"}";
            $tokenPayload = "{\"sub\": \"" . $_POST['jwtSubject'] . "\"}";
            $tokenSecret = "SuperDuperSecret2017";
            $tokenForHash = base64_encode($tokenHeader) . "." . base64_encode($tokenPayload) . "," . $tokenSecret;
            $token = hash_hmac("sha256",$tokenForHash,$tokenSecret);

            echo $tokenHeader . "\n";
            echo $tokenPayload . "\n";
            echo $tokenSecret . "\n";
            echo $tokenForHash . "\n";
            echo $token;
		}
?>