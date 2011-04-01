<?php
/**
 *  @file Handler.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-25
 *  Created: ven 2011-03-25, 09:53.21 CET
 *  Last modified: ven 2011-04-01, 11:03.47 CEST
**/

/**
 *  abstracte wijze van afhandelen van requests/aanvragen van de client
 van,van,van
**/
abstract class Handler
{
	public           function __construct ()
	{
	}

	public function get ()
	{
		header( 'HTTP/1.0 405 Method Not Allowed' );
		echo __METHOD__;
		exit;
	}
	public function post ()
	{
		header( 'HTTP/1.0 405 Method Not Allowed' );
		echo __METHOD__;
		exit;
	}
	public function put ()
	{
		header( 'HTTP/1.0 405 Method Not Allowed' );
		echo __METHOD__;
		exit;
	}
	public function delete ()
	{
		header( 'HTTP/1.0 405 Method Not Allowed' );
		echo __METHOD__;
		exit;
	}
}


