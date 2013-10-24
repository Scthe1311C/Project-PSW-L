<?php 
	
	///////////////////////////////////////////////////////////////////////////
	// TODO move to Env. & config files (?)
	///////////////////////////////////////////////////////////////////////////

	// turn on error reporting ?
	error_reporting(E_ALL|E_STRICT);
	ini_set("display_errors", true);

	session_start();
	ob_start(); // do not send headers, wait till the buffer is full
	//session_unset();

///////////////////////////////////////////////////////////////////////////


	require_once 'model/model.php';
	require_once 'controllers.php';

	$request_uri = $_SERVER["REQUEST_URI"];
	$page_name = substr( $request_uri, 0, strrpos( $request_uri, "?")===FALSE ? strlen($request_uri): strrpos( $request_uri, "?")); // remove GET params
	$page_name = substr( $page_name, strrpos( $page_name, "/")); // get all after last '/'

	if( $page_name=="/login"){
		$content = login();

	}else if( $page_name=="/"){
		$content = welcome();

	} else {
		$content =  '<html><body><h1>Page Not Found</h1></body></html>';
		header('Status: 404 Not Found');
	}
	
	// render content
	echo $content;
?>