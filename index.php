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

	if( $page_name=="/"){
		/* home page */
		$content = home();
	
	}else if( $page_name=="/login"){
		/* login as user providing login and password */
		$content = login();

	}else if( $page_name=="/register"){
		/* register new user */
		$content = register();

	}else if( $page_name=="/settings"){
		/* change user's settings */
		$content = settings();

	}else if( $page_name=="/about"){
		/* about the website */
		$content = '<html><body><h1>About</h1></body></html>';

	}else if( $page_name=="/popular"){
		/* photos with biggest number of views */
		/* TODO : popular this week/month/..*/
		$content = '<html><body><h1>Popular</h1></body></html>';

	}else if( $page_name=="/galleries"){
		/* galleries ( photo sets) created by users f.e. flowers */
		$content = '<html><body><h1>Galleries</h1></body></html>';

	}else if( $page_name=="/upload"){
		/* view my photos and select ones to upload for public viewership */
		$content = '<html><body><h1>Upload</h1></body></html>';

	}else if( $page_name=="/profile_photos"){
		/* view my photos */
		$content = '<html><body><h1>Profile photos</h1></body></html>';
	
	}else if( $page_name=="/profile_galleries"){
		/* view my galleries */
		$content = '<html><body><h1>Profile galleries</h1></body></html>';
		
	}else if( $page_name=="/photo"){
		/* single photo view */
		$content = single_photo();
	
	} else if( $page_name=="/person"){
            		$content = person_info();
        }
        else {
		$content =  '<html><body><h1>Page Not Found</h1></body></html>';
		header('Status: 404 Not Found');
	}
        
	
	/*
	TODO:
		search
		new photos
		explore ( show random images ?)
		favourite ( most likes )
		world map ( based on dropbox profile country/user's profile)
		groups
		friends ( last activity/messages/timeline etc.)
		send message etc.
	*/
	
	// render content
	echo $content;
?>