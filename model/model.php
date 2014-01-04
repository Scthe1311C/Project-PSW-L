<?php 

require_once 'utils/php_oAuth20.php';
require_once 'utils/phpDropbox.php';
require_once 'databaseManager.php';

// TODO separate database scripts: schema, values, testValues


/*
Active user utils
*/
function getActiveUser(){
	// TODO create some short term cache
	if ( isset($_SESSION["active_user"]) ){
		$user_id = $_SESSION["active_user"];
		return getObjectById("User", $user_id);
	}
	return NULL;
}

function getActiveUserId(){
	return $_SESSION["active_user"];
}

function checkUserAutorization( $userIdToTest){
	return getActiveUserId() == $userIdToTest;
}

/*
Dropbox
*/
function dropbox_authorize( $return_url){
	$dropbox = new phpDropbox( $return_url, true);
	return true;
}

function getDropboxDirectoryInfo( $path){
	$dropbox = new phpDropbox("dropboxAuthorize");
	$files_list = $dropbox->metadata( "dropbox", $path);
	$files_list["status"] = "ok";
	//$files_list["debug"] = trim(ob_get_clean());
	return json_encode($files_list, true);
}

function requestDropboxImageThumb( $path){
	$file_name = basename($path);
	$file_name = substr($file_name, 0, strpos($file_name, '.'));
	$user_id = getActiveUserId();
	$img_thumb_path = "media/" . $user_id . "_" . $file_name . ".jpeg";
	
	if( !file_exists( $img_thumb_path)){
		$dropbox = new phpDropbox("dropboxAuthorize");
		$img_data = $dropbox->thumbnails("dropbox", $path, "l"); 
		// write image
		$file = fopen( $img_thumb_path, "wb");
		fwrite($file, $img_data);
		fclose( $file);
	}
	$res = array("status" => "ok", "path" => $img_thumb_path);
	return json_encode($res, true);
}

/*
Galleries CRUD
*/
function createGallery( $name){
	$res = array("status" => "failure", "cause" => "Name '".$name."' is not valid", );
	$name = trim($name);
	if( preg_match( "/^[A-Za-z0-9_ ]+$/", $name)){
		$gallery = array(
			"name" => $name,
			"user_id" => getActiveUserId(),
			"tumbnail_href" => "src/img/img2.jpg" // TODO hardcoded 'tumbnail_href'
		);
		// TODO 'tumbnail' in database ?! tHumbnail !
		
		insertObject( "Gallery", $gallery); // TODO check if already exists before !
		$res = array("status" => "ok", "create" => $name);
	}
	return json_encode($res, true);
}

function removeGallery( $id){
	$res = array("status" => "failure", "cause" => "Gallery (id=".$id.") could not be removed. Don't ask why, I don't know.." );
	$gallery = getObjectById("Gallery", $id);
	if( !isset( $gallery) || !$gallery){
		$res = array("status" => "failure", "cause" => "Gallery (id=".$id.") does not exist" );
	}else if( !checkUserAutorization($gallery->user_id)){
		$res = array("status" => "failure", "cause" => "User does not have authority to remove gallery ( id=".$id.")" );
	}else{
		//$a = DAO::remove( "Gallery", [new Condition("id", "=", $id)] );
		//$res = array("status" => "ok", "sql" => $a );
		removeObject( "Gallery", $id);
		$res = array("status" => "ok", "removedGallery" => $id );
	}
	
	return json_encode($res, true);
}

function renameGallery( $id, $name){
	$res = array("status" => "failure", "cause" => "Name '".$name."' is not valid" );
	$name = trim($name);
	if( preg_match( "/^[A-Za-z0-9_ ]+$/", $name)){
		$gallery = getObjectById("Gallery", $id);
		if( !isset( $gallery) || !$gallery){
			$res = array("status" => "failure", "cause" => "Could not find gallery ( id=".$id.")" );
		}else if( !checkUserAutorization($gallery->id)){
			$res = array("status" => "failure", "cause" => "User does not have authority to update gallery ( id=".$id.")" );
		}else{
			updateObjectById("Gallery", array( "name" => $name), $id);
			$res = array("status" => "ok");
		}
	}
	return json_encode($res, true);
}

function addToFavorite( $photoId){
	$attr = array(
			"photo_id" => $photoId,
			"user_id" => getActiveUserId()
		);
	insertObject( "FavoritePhotos", $attr);
	$res = array("status" => "ok", "favorite" => getActiveUserId()." => ".$photoId);
	return json_encode($res, true);
}


/*
Login
*/
function userLogin( $password){
	// check if login and password are valid and then write user to the session
	if( strpos($password, "Basic ") === 0){
		$pass = '"'.substr($password, 6).'"'; // password to check excluding the 'Basic ' part
		$user = getObjectsByConditions("User", new Condition("password","=",$pass)); // TODO is this array 'keyed' by id ?!
		if( count($user) == 1){
			foreach( $user as $user) // once !
				$_SESSION["active_user"] = $user->id;
			return "{ \"status\":\"ok\" }";
			//return "{ \"status\":\"ok\",\"data\":\"".implode( array_keys($user))."\" }"; // TODO client side can view the password :)
		}
	}
	return "{ \"status\":\"failure\", \"cause\":\"user not found\" }";
	//return "{ \"status\":\"failure\", \"cause\":\"user not found\", \"data\":\"".implode( array_keys($user))."\" }";
}

function userLogout(){
	unset($_SESSION["active_user"]);
}

/*
Utils
*/
function getPopularGallery(){
	// TODO just sort galleries by views..
	return getObjectById("Gallery", POPULAR_GALLARY_ID);
}

function getUser( $id){
	return getObjectById("User", $id);
}

function getGalleriesByUser( $userId){
	return getAllUserCreatedGalleries($userId);
}

function getAllGalleries(){
	return getAllObjects("Gallery");
}

function getGalleryById( $id){
	return getObjectById("Gallery", $id);
}



///
/// utils functions
///
function get( $url, $data=array()){
	if($data !== NULL && !empty( $data)){
		$params = http_build_query( $data);
		$url .= "?" . $params;
	}
	//echo $url;
	$curl = curl_init( $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}

function post( $url, $data){
	/*
	debug
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	$verbose = fopen('log_post.txt', 'w+');
	curl_setopt($ch, CURLOPT_STDERR, $verbose);
	!rewind($verbose);
	$verboseLog = stream_get_contents($verbose);
	echo "Verbose information:\n<pre>!", htmlspecialchars($verboseLog), "!</pre>\n";
	echo "error: '".curl_error($ch)."'";
	*/
	
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	// certificate problems:
	// set CURLOPT_SSL_VERIFYPEER to false to disable SSL certification
	// note: this a hack around providing correct certificate authorities list to check against
	// http://stackoverflow.com/questions/17478283/paypal-access-ssl-certificate-unable-to-get-local-issuer-certificate
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}
?>