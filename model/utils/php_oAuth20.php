<?php 
class oAuth2{
	private $_clientKey;
	private $_clientSecret;
	private $_callbackUrl;
	private $_authorize_endpoint;
	private $_token_endpoint;
	
	public function __construct($clientKey, $clientSecret, $callbackUrl, $authorize_endpoint, $token_endpoint) {
		$this->_clientKey = $clientKey;
		$this->_clientSecret = $clientSecret;
		$this->_callbackUrl = $callbackUrl;
		$this->_authorize_endpoint = $authorize_endpoint;
		$this->_token_endpoint = $token_endpoint;
	}
	
	/**
	 * 1st oAuth step - get user permission to access his account data
	 */
	public function authorize( array $userParameters = array()) {
		$parameters = array_merge($userParameters, array(
			'client_id' => $this->_clientKey,
			'redirect_uri' => $this->_callbackUrl,
			'response_type' => 'code'
		));
		// some additional parameters
		//if ($this->_scope) $parameters['scope'] = $this->_scope;

		$url = $this->_authorize_endpoint;
		$url .= (strpos($url, '?') !== false ? '&' : '?') . http_build_query($parameters);

		// go to the location to authorize
		header('Location: ' . $url);
		die();
	}
	
	/**
	 * 2nd oAuth step - process response from step 1 to get the unique code that can be used to get the user access token
	 */
	public function read_access_token(){
		if (! isset($_GET['code'])) {
			throw new Exception('could not retrieve \'code\' parameter out of callback request');
		}
		$code = $_GET['code'];
		
		$data = array(
			'client_id' => $this->_clientKey,
			'client_secret' => $this->_clientSecret,
			'code' => $code,
			'grant_type' => 'authorization_code',
			'redirect_uri' => $this->_callbackUrl
		);
		
		$curl = curl_init($this->_token_endpoint);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// certificate problems fix:
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		
		// make call
		$response = curl_exec($curl);
		$info = curl_getinfo($curl);
		curl_close($curl);
		
		$response = substr($response, $info['header_size'], strlen($response));
		//echo $response;
		if ($response === false) {
			$response = '';
		}
		
		$token = $this->_parseAccessTokenResponse( $response);
		// TODO $this->_dataStore->storeAccessToken($token);
		return $token;
	}
	
	private function _parseAccessTokenResponse( $response, $oldRefreshToken = null) {
		$json = json_decode($response, true);
		//echo "<br/>response: '".$response."'<br/>";
		
		if (isset($json['error'])) {
			throw new Exception("got error while requesting access token: '" . $json['error'] . "' (".$json['error_description'].")");
		}
		if (! isset($json['access_token'])) {
			throw new Exception('no access_token found');
		}

		$token = new Token($json['access_token'],
				isset($json['refresh_token']) ? $json['refresh_token'] : $oldRefreshToken,
				isset($json['expires_in']) ? $json['expires_in'] : null,
				isset($json['uid']) ? $json['uid'] : null);
		return $token;
	}
}

/***
 * oAuth user token
 */ 
class Token{
	private $_accessToken;
	private $_refreshToken;
	private $_lifeTime;
	private $_userId;

	public function __construct($accessToken = null, $refreshToken = null, $lifeTime = null, $userId = null) {
		$this->_accessToken = $accessToken;
		$this->_refreshToken = $refreshToken;
		if ($lifeTime) {
			$this->_lifeTime = ((int)$lifeTime) + time();
		}
		$this->_userId = $userId;
	}

	public function getAccessToken() {
		return $this->_accessToken;
	}

	public function getRefreshToken() {
		return !isset($refToken) || (strlen( $refToken)===0)? $this->getAccessToken() : $this->_refreshToken;
		//return $this->_refreshToken;
	}
	
	public function setRefreshToken( $newToken) {
		$this->_refreshToken = $newToken;
	}

	public function getLifeTime() {
		return $this->_lifeTime;
	}
	
	public function getUserId() {
		return $this->_userId;
	}
}
	
?>

