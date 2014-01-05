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

	}else if( $method === "createGallery"){
		// create new gallery
		$name = isset( $headers["GalleryName"]) ? $headers["GalleryName"] : "";
		$return = createGallery( $name);

	}else if( $method === "removeGallery"){
		$GalleryId = isset( $headers["GalleryId"]) ? $headers["GalleryId"] : -1;
		$return = removeGallery( $GalleryId);

	}else if( $method === "renameGallery"){
		// rename gallery
		$name = isset( $headers["GalleryName"]) ? $headers["GalleryName"] : "";
		$id = isset( $headers["GalleryId"]) ? $headers["GalleryId"] : -1;
		$return = renameGallery( $id, $name);

	}else if( $method === "addToFavorite"){
		// add photo to favorite photos collection
		$photoId = isset( $headers["photoId"]) ? $headers["photoId"] : "";
		$return = addToFavorite( $photoId);
	
	}else if( $method === "addToGallery"){
		// add photo to favorite photos collection
		$imgs = json_decode($_GET["Images"]);
		$return = addToGallery( $_GET["GalleryId"], $imgs);
			
	}else{
		$return = "{ \"status\":\"failure\", \"cause\":\"method '" . $method . "' not found\" }";
	}

	echo $return;
?>