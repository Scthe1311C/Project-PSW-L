<?php
// This is the server-side script

session_start(); // :)
ob_start(); // do not send headers, wait till buffer is full
			
// Set the content type
header('Content-Type: text/plain');

$return = dispatchApiCall();
echo $return;


//
// utils
function dispatchApiCall(){
	$headers = getallheaders();
	$method = $headers["Method"];
	if( $method === "login"){
		$valid = validUserAuthenticationData( $headers["Authorization"]);
		return $valid ? 'true' : 'false';
	}else{
		return "method not found";
	}
}

function validUserAuthenticationData( $hashStr){
	// check user login and password
	return strcmp($hashStr, "Basic YTph")==0; // "a:a"
}

?>