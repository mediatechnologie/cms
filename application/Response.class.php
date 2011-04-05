<?php
/**
 *  @file Response.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-04-01
 *  Created: ven 2011-04-01, 11:11.24 CEST
 *  Last modified: mar 2011-04-05, 22:16.00 CEST
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
		$location  =  $_SERVER[ 'HTTP_REFERER' ];
		header( '201 Created' );
		header( 'Location: ' . $location );
		ChromePhp::log( 'location' , $location );
		echo '<a href="' . $location . '">return</a>';
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


