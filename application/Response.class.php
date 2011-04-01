<?php
/**
 *  @file Response.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-04-01
 *  Created: ven 2011-04-01, 11:11.24 CEST
 *  Last modified: ven 2011-04-01, 11:17.21 CEST
**/

class Response
{
	public           function __construct ()
	{
	}
	public static function OK ( $location = NULL )
	{
		$location  =  $_SERVER[ 'HTTP_REFERER' ];
		header( '201 Created' );
		header( 'Location: ' . $location );
		return TRUE;
	}
	public static function FAIL ()
	{
		$location  =  $_SERVER[ 'HTTP_REFERER' ];
		header( '400 Bad Request' );
		header( 'Location: ' . $location );
		return TRUE;
	}
}


