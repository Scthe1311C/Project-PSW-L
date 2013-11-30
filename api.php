<?php
// This is the server-side script
require_once 'model/model.php';


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
	//print_r($headers);
	$method = $headers["Method"];
	if( $method === "login"){
		// check if login and password are valid and then write user to the session
		$valid = validUserAuthenticationData( $headers["Authorization"]);
		if($valid)
			$_SESSION["user_name"] = "a";
		return $valid ? 'true' : 'false';
	
	}else if( $method === "metadata"){
		// get info about dropbox folder / file
		$path = $headers["Path"];
		return getDropboxDirectoryInfo( trim($path));
	
	}else if( $method === "requestThumb"){
		// get thumbnail data
		$path = $headers["Path"];
		return requestDropboxImageThumb( trim($path));
	
	}else{
		return "method not found";
	}
}

function validUserAuthenticationData( $hashStr){
	// check user login and password
	if( strcmp($hashStr, "Basic YTph")==0){ // "a:a"
		$_SESSION["user_name"] = "a";
		return true;
	}
	return false;
}

?>