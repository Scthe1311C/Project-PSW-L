<?php 

require_once 'utils/php_oAuth20.php';
require_once 'utils/phpDropbox.php';

function dropbox_authorize( $return_url){
	$dropbox = new phpDropbox( $return_url, true);
	return true;
}

function getDropboxDirectoryInfo( $path){
	$dropbox = new phpDropbox("dropboxAuthorize");
	$files_list = $dropbox->metadata( "dropbox", $path);
	return json_encode($files_list, true);
}

function requestDropboxImageThumb( $path){
	$dropbox = new phpDropbox("dropboxAuthorize");
	$acc = $dropbox->account_info();
	$file_name = basename($path);
	$file_name = substr($file_name, 0, strpos($file_name, '.'));
	$img_thumb_path = "media/" . $acc["uid"] . "_" . $file_name . ".jpeg";
	
	if( !file_exists( $img_thumb_path)){
		$img_data = $dropbox->thumbnails("dropbox", $path, "l"); 
		// write image
		$file = fopen( $img_thumb_path, "wb");
		fwrite($file, $img_data);
		fclose( $file);
	}
	$res = array("status" => "ok", "path" => $img_thumb_path);
	return json_encode($res, true);
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