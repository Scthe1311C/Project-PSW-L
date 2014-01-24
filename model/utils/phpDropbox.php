<?php 

require 'dropboxKeys.php';

class phpDropbox{
	// https://www.dropbox.com/developers/core/docs

	private static $access_type = "dropbox";
	private static $authorize_endpoint = "https://www.dropbox.com/1/oauth2/authorize";
	private static $token_endpoint = "https://api.dropbox.com/1/oauth2/token";
	
	private $_token;
	private $_app_root;
	
	public function __construct( $callbackUrl, $debug=false) {
		$this->_app_root = $callbackUrl;
		
		// try to retrieve token
		$tokenStorage = new TokenStorage();
		$this->_token = $tokenStorage->retrieveAccessToken();
		//echo "token?: '" . ( $this->_token->getAccessToken()."'");
		
		$tokenIsInvalid = !$this->_token || ($this->_token =="NULL");
		//echo $tokenIsInvalid;
		if( $tokenIsInvalid){
			//echo "token-null";
			// could not retrieve token
			global $dropbox_key, $dropbox_secret;
			
			// get new token
			$oAuth = new oAuth2( $dropbox_key, $dropbox_secret, $this->_app_root, self::$authorize_endpoint, self::$token_endpoint);
			if (!isset($_GET['code'])) {
				// authorization phase 1
				$oAuth->authorize();
			}else{
				// authorization phase 2
				// retrieve access token from endpoint
				$this->_token = $oAuth->read_access_token();
				$tokenStorage->storeAccessToken( $this->_token);
			}
		}
	}
	
	private function execute( $method, $data=NULL, $type="GET", $debug=false){
		$tokenStorage = new TokenStorage();
		$token = $tokenStorage->retrieveAccessToken();

		$curl = curl_init($method);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($curl, CURLOPT_LOW_SPEED_LIMIT, 1024);
		curl_setopt($curl, CURLOPT_LOW_SPEED_TIME, 10);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_VERBOSE, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			"User-Agent: ".$token->getUserId()." Dropbox-PHP-SDK",
			"Authorization: Bearer ". $token->getAccessToken()
		));
		
		if( $type != "GET"){
			curl_setopt($curl, CURLOPT_POST, true);
			if($data !== NULL)
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data) );
		}else{
			curl_setopt($curl, CURLOPT_HTTPGET, true);
			if($data !== NULL){
				curl_setopt($curl, CURLOPT_URL, $method."?".http_build_query($data) );
			}
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	
	///
	/// dropbox api mapping
	///
	
	/**
		Retrieves information about the user's account
	*/
	public function account_info(){
		$url = "https://api.dropbox.com/1/account/info";
		$response = $this->execute( $url);
		return json_decode($response, true);
	}
	
	/**
		Retrieves file and folder metadata
	*/
	public function metadata( $root, $path){
		$url = "https://api.dropbox.com/1/metadata/";
		if( $root !== "sandbox" && $root !== "dropbox" )
			 throw new Exception("Valid values for 'root' are sandbox and dropbox.");
		$url .= $root."/".$path;
		$response = $this->execute( $url);
		return json_decode($response, true);
	}
	
	/**
		Creates and returns a Dropbox link to files or folders users can use to view a preview of the file in a web browser
	*/
	public function shares( $root, $path){
		$url = "https://api.dropbox.com/1/shares/";
		if( $root !== "sandbox" && $root !== "dropbox" )
			 throw new Exception("Valid values for 'root' are sandbox and dropbox.");
		$url .= $root."/".$path;
		$response = $this->execute( $url, array("short_url"=>"false"), "POST");
		return json_decode($response, true);
	}
	
	/**
		Gets a thumbnail in God-only-knows-what format
		@param size one of the following values :
			xs(32);
			s (64);
			m (128);
			l (640x480);
			xl (1024x768)
	*/
	public function thumbnails( $root, $path, $size="s"){
		$url = "https://api-content.dropbox.com/1/thumbnails/"; // removed ending '/' !
		if( $root !== "sandbox" && $root !== "dropbox" )
			 throw new Exception("Valid values for 'root' are sandbox and dropbox.");
		$url .= $root.$path;
		$response = $this->execute( $url, array("format"=>"jpeg", "size"=>$size));
		return $response;
	}
	
	/**
		Returns image to download
	*/
	public function files_get( $root, $path){
		$url = "https://api-content.dropbox.com/1/files/";
		if( $root !== "sandbox" && $root !== "dropbox" )
			 throw new Exception("Valid values for 'root' are sandbox and dropbox.");
		$url .= $root."/".$path;
		$response = $this->execute( $url);
		return $response;
	}
	
}	


class TokenStorage{

	public function retrieveAccessToken() {
		$user = getActiveUser();
		
		// first try - session cache
		if( isset( $_SESSION['oauth2_token']) &&
			isset( $_SESSION['oauth2_token_user_id'])&& $user->id == $_SESSION['oauth2_token_user_id']){
			
			return unserialize($_SESSION['oauth2_token']);
		}
		
		// second try - renew based on the database token
		$dbToken = $user->dropbox_token;
		//echo "db token search :".( $dbToken )."\n";
		if( isset( $dbToken) && $dbToken != NULL){
			$token_refresh = $user->dropbox_token;
			$token = new Token( $token_refresh,
				$token_refresh,
				0,
				NULL);
			
			// save to the session cache
			$user = getActiveUser();
			$_SESSION['oauth2_token'] = serialize($token);
			$_SESSION['oauth2_token_user_id'] = $user->id;
			return $token;
		}
		
		// no token found in the database
		return NULL;
	}

	public function storeAccessToken(Token $token) {
		// save to the session cache
		$user = getActiveUser();
		$_SESSION['oauth2_token'] = serialize($token);
		$_SESSION['oauth2_token_user_id'] = $user->id;
		
		// save renew token to the database
		$user = getActiveUser();
		$token_refresh = $token->getRefreshToken();
		if( isset( $token_refresh) || strlen( $token_refresh) == 0 )
			$token_refresh = $token->getAccessToken();
		updateObjectById("User", array( "dropbox_token" => $token_refresh), $user->id);
	}
}

 ?>

