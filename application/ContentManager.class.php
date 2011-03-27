<?php
/**
 *  @file ContentManager.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-25
 *  Created: ven 2011-03-25, 10:07.26 CET
 *  Last modified: dim 2011-03-27, 16:05.14 CEST
**/

class ContentManager extends Handler
{
	public           function __construct ()
	{

$HTTPDigest = new HttpDigest();
$users = array(
	'user' => md5( 'user:' . $HTTPDigest->getRealm() . ':password' ) ,
	'will' => md5( 'will:' . $HTTPDigest->getRealm() . ':fris' ) ,
);

if (!$HTTPDigest->getAuthHeader())
{
	$HTTPDigest->send();
	header( 'HTTP/1.0 401 Unauthorized' );
	echo '<p>You hit cancel, good on you.</p>';
	exit;
}
elseif ( $username = $HTTPDigest->authenticate($users) )
{
	echo '<p>Hello ' . $username . '.</p>';
	echo '<p>This resource is protected by HTTP digest.</p>';
	exit;
}
else
{
	header( 'HTTP/1.0 401 Unauthorized' );
	echo '<p>You shall not pass!</p>';
	echo '<p><a href="' . Uri::alterCurrent(
		array(
			'get' => array(
				'retry' ,
			) ,
		)
	) .  '">retry</a></p>';
	exit;
}

	}
	public function get ()
	{
		$contents  =  array();
		//$contents[]  =  new Form();
		return $contents;
	}
}


