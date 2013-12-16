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
       
	if( $page_name=="/" || $page_name=="/home"){
		/* home page */
		$content = home();
	
	}else if( $page_name=="/index.php"){
		$content = home();

	}else if( $page_name=="/login"){
		/* login as user providing login and password or register new user*/
		$register = isset($_GET["register"])? $_GET["register"] : false;
		$content = login( $register);

	}else if( $page_name=="/logout"){
		unset($_SESSION["user_name"]);
		unset($_SESSION["user_id"]);
		header("Location: home");
		
	}else if( $page_name=="/about"){
		/* about the website */
		$content = about();

	}else if( $page_name=="/popular"){
		/* photos with biggest number of views */
		/* TODO : popular this week/month/..*/
		$content =  popular();

	}else if( $page_name=="/galleries"){
		/* galleries ( photo sets) created by users f.e. flowers */
		$content = galleries();

	}else if( $page_name=="/upload"){
		/* view my photos and select ones to upload for public viewership */
		$content = upload();

	}else if( $page_name=="/gallery"){
		/* view of the choosen gallery */
		$content = gallery($_GET["galleryId"]);
		
	}else if( $page_name=="/photo"){            
		$content = single_photo($_GET["galleryId"], $_GET["photoId"]);
	
	}else if( $page_name=="/profile"){
		/* public profile */
		$content = person_info($_GET["userId"]);
    
	}else if( $page_name=="/user-profile"){
		/* user profile page - settings, friends, */
		$page = isset($_GET["page"])? $_GET["page"] : NULL;
		//Static user_id input 
		$_SESSION["user_id"] = 1;
		//
		$content = user_profile( $page, $_SESSION["user_id"]);
	
	}else if( $page_name=="/dropboxAuthorize"){
		if(isset($_GET["source"]))
			$_SESSION["afterAuthorizeRedirect"]=urldecode($_GET["source"]);
		
		if(dropboxAuthorize())
			header("Location: ".$_SESSION["afterAuthorizeRedirect"]);
	
    }else {
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
