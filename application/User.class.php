<?php
/**
 *  @file User.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-27
 *  Created: dim 2011-03-27, 23:23.34 CEST
 *  Last modified: sab 2011-04-02, 13:53.17 CEST
**/

class User
{
	private $known  =  FALSE;
	public           function __construct ()
	{
		$HTTPDigest = new HttpDigest();
		$users = array(
			'user' => md5( 'user:' . $HTTPDigest->getRealm() . ':password' ) ,
			'will' => md5( 'will:' . $HTTPDigest->getRealm() . ':fris' ) ,
		);

		if ( !$HTTPDigest->getAuthHeader() )
		{
			$HTTPDigest->send();
			header( 'HTTP/1.0 401 Unauthorized' );
			$this->known  =  FALSE;
			return;
		}
		elseif ( $username = $HTTPDigest->authenticate( $users ) )
		{
			//echo '<p>Hello ' . $username . '.</p>';
			//echo '<p>This resource is protected by HTTP digest.</p>';
			$this->known  = TRUE;
			return;
		}
		elseif ( isset( $_GET['retry'] ) ) //  nonce died -- timeout of noncelife
		{
			$HTTPDigest->send();
			header( 'HTTP/1.0 401 Unauthorized' );
			$this->known  = FALSE;
			return;
		}
		else
		{
			header( 'HTTP/1.0 401 Unauthorized' );
			//echo '<p>You shall not pass!</p>';
			//echo '<p><a href="' . Uri::alterCurrent(
				//array(
					//'get' => array(
						//'retry' ,
					//) ,
				//)
			//) .  '">retry</a></p>';
			$this->known  = FALSE;
			return;
		}
	}
	public function known ()
	{
		return $this->known;
	}
}


