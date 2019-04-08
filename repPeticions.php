<?php
require_once('controlTokens.php');
//Comprova si s’ha rebut un header “authorization” amb un token válid
function checkAuthToken(){
 $headers = apache_request_headers();
 if(isset($headers["authorization"]) && $headers["authorization"] !=""){
 $token_recibido=$headers["authorization"];
 //SI TE UN TOKEN
 if(jwtCheckCodeJSON($token_recibido)) { // echo json_encode(["ok"=>"token correcte:". $token_recibido]);
 return true;
 }else{ // echo json_encode(["err"=>"token incorrecte?:". $token_recibido]);
 return false;
 }
 }
}