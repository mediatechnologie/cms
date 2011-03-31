<?php
/**
 *  @file HttpDigest.class.php
 *  @author immeëmosol (programmer dot willfris at nl)
 *  @date 2011-03-08
 *  Created: mar 2011-03-08, 15:08.45 CET
 *  Last modified: ĵaŭ 2011-03-31, 22:41.42 CEST
**/

/*
http://peej.co.uk/articles/http-auth-with-html-forms
http://peej.co.uk/projects/phphttpdigest
*/
/** HTTP Digest authentication class */
class HTTPDigest
{

	/** The Digest opaque value (any string will do, never sent in plain text over the wire).
	 * @var str
	 */
	var $opaque = 'opaque';

	/** The authentication realm name.
	 * @var str
	 */    
	var $realm = 'Realm';

	/** The base URL of the application, auth data will be used for all resources under this URL.
	 * @var str
	 */
	var $baseURL = '/';

	/** Are passwords stored as an a1 hash (username:realm:password) rather than plain text.
	 * @var str
	 */
	var $passwordsHashed = TRUE;

	/** The private key.
	 * @var str
	 */
	var $privateKey = 'privatekey';

	/** The life of the nonce value in seconds
	 * @var int
	 */
	//var $nonceLife = 300;
	var $nonceLife = 600000;

	/** Send HTTP Auth header */
	function send()
	{
		header('WWW-Authenticate: Digest '.
				'realm="'.$this->realm.'", '.
				'domain="'.$this->baseURL.'", '.
				'qop=auth, '.
				'algorithm=MD5, '.
				'nonce="'.$this->getNonce().'", '.
				'opaque="'.$this->getOpaque().'"'
				);
		header('HTTP/1.0 401 Unauthorized');
	}

	/** Get the HTTP Auth header
	 * @return str
	 */
	function getAuthHeader()
	{
		if (isset($_SERVER['Authorization'])) {
			return $_SERVER['Authorization'];
		} elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
			return $_SERVER['PHP_AUTH_DIGEST'];
		} elseif (function_exists('apache_request_headers')) {
			$headers = apache_request_headers();
			if (isset($headers['Authorization'])) {
				return $headers['Authorization'];
			}
		}
		return NULL;
	}

	/** Authenticate the user and return username on success.
	 * @param str[] users Array of username/password pairs
	 * @return str
	 */
	function authenticate($users)
	{
		$authorization = $this->getAuthHeader();
		if ( !$authorization)
		{
			trigger_error(
				'HTTP Digest headers not being passed to PHP by the server, '.
				'unable to authenticate user'
			);
			exit;
		}

		if (substr($authorization, 0, 5) == 'Basic')
		{
			trigger_error('You are trying to use HTTP Basic authentication but I am expecting HTTP Digest');
			exit;
		}
		
		if (
				!(
				preg_match('/username="([^"]+)"/', $authorization, $username) &&
				preg_match('/nonce="([^"]+)"/', $authorization, $nonce) &&
				preg_match('/response="([^"]+)"/', $authorization, $response) &&
				preg_match('/opaque="([^"]+)"/', $authorization, $opaque) &&
				preg_match('/uri="([^"]+)"/', $authorization, $uri)
				)
			)
		{
			if ( defined('DEV') )
				ChromePhp::log( 'auth-header does not meet expectations' );
			return NULL;
		}

		$username = $username[1];
		$requestURI = $_SERVER['REQUEST_URI'];
		if (strpos($requestURI, '?') !== FALSE) {
			// hack for IE which does not pass querystring
			//  in URI element of Digest string or in response hash
			$requestURI = substr($requestURI, 0, strlen($uri[1]));
		}

		if (
				!(
				isset($users[$username]) &&
				$opaque[1] == $this->getOpaque() &&
				$uri[1] == $requestURI &&
				$nonce[1] == $this->getNonce()
				)
			) {
			if ( defined('DEV') )
				ChromePhp::warn(
					'opaque, uri or nonce not as expected.'
				);
			return NULL;
		}

		$passphrase = $users[$username];
		if ($this->passwordsHashed) {
			$a1 = $passphrase;
		} else {
			$a1 = md5($username.':'.$this->getRealm().':'.$passphrase);
		}

		$a2 = md5($_SERVER['REQUEST_METHOD'].':'.$requestURI);
		if (
				preg_match('/qop="?([^,\s"]+)/', $authorization, $qop) &&
			preg_match('/nc=([^,\s"]+)/', $authorization, $nc) &&
				preg_match('/cnonce="([^"]+)"/', $authorization, $cnonce)
		) {
			$expectedResponse = md5(
				$a1.':'.$nonce[1].':'.$nc[1].':'.$cnonce[1].':'.$qop[1].':'.$a2
			);
		} else {
			$expectedResponse = md5($a1.':'.$nonce[1].':'.$a2);
		}

		if ($response[1] == $expectedResponse) {
			return $username;
		}

		return NULL;
	}

	/** Get nonce value for HTTP Digest.
	 * @return str
	 */
	function getNonce() {
		$time = ceil(time() / $this->nonceLife) * $this->nonceLife;
		return md5(date('Y-m-d H:i', $time).':'.$_SERVER['REMOTE_ADDR'].':'.$this->privateKey);
	}

	/** Get opaque value for HTTP Digest.
	 * @return str
	 */
	function getOpaque()
	{
		return md5($this->opaque);
	}

	/** Get realm for HTTP Digest taking PHP safe mode into account.
	 * @return str
	 */
	function getRealm()
	{
		if (ini_get('safe_mode')) {
			return $this->realm.'-'.getmyuid();
		} else {
			return $this->realm;
		}
	}

}

