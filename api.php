<?php
	// This is the server-side script
	require_once 'model/model.php';

	// init
	session_start(); // :)
	ob_start(); // do not send headers, wait till buffer is full
	header('Content-Type: text/plain'); // Set the content type

	// dispatch
	$headers = getallheaders();
	$method = $headers["Method"]; // TODO handle by uri not header
	if( $method === "login"){
		$pass = $headers["Authorization"];
		$return = userLogin( $pass);

	}else if( $method === "metadata"){
		// get info about dropbox folder / file
		$path = $headers["Path"];
		$return = getDropboxDirectoryInfo( trim($path));

	}else if( $method === "requestThumb"){
		// get thumbnail data
		$path = $headers["Path"];
		$return = requestDropboxImageThumb( trim($path));

	}else{
		$return = "{ \"status\":\"failure\", \"cause\":\"method '" . $method . "' not found\" }";
	}

	echo $return;
?>