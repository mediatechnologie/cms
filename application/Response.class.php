<?php
/**
 *  @file Response.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-04-01
 *  Created: ven 2011-04-01, 11:11.24 CEST
 *  Last modified: dim 2011-04-10, 18:49.00 CEST
**/

//  @todo[~immeëmosol, dim 2011-04-03, 23:44.30 CEST]
//    circumvent the http_referer , as it cannot be fully trusted
class Response
{
	public           function __construct ()
	{
	}
	public static function OK ( $location = NULL )
	{
		$location  =  self::redirectLocation();
		header( '201 Created' );
		header( 'Location: ' . $location );
		ChromePhp::log( 'location' , $location );
		echo '<a href="' . $location . '">return</a>';
		return TRUE;
	}
	public static function FAIL ()
	{
		$location  =  self::redirectLocation();
		header( '400 Bad Request' );
		header( 'Location: ' . $location );
		return TRUE;
	}
	private static function redirectLocation ()
	{
		if ( isset( $_SERVER[ 'HTTP_REFERER' ] ) )
			$location  =  $_SERVER[ 'HTTP_REFERER' ];
		else
			$location  =  '';
		return $location;
	}
}


