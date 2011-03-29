<?php
/**
 *  @file Uri.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-25
 *  Created: ven 2011-03-25, 10:26.33 CET
 *  Last modified: dim 2011-03-27, 22:16.00 CEST
**/

class Uri
{
	private          function __clone ()
	{
	}
	private          function __construct ()
	{
	}

	public static function alterCurrent ( $alternations )
	{
		$new  =  Request::_uri();
		foreach ( $alternations as $type => $type_alternations )
		{
			foreach ( $type_alternations as $k => $v )
			{
				$function  =  'alter' . ucfirst( $type );
				$new  =  self::$function( $new , $k , $v );
			}
		}
		return $new;
	}
	private static function alterGet ( $uri , $k , $v )
	{
		if ( $pos = strpos( $uri , '?' ) )
		{
			$req  =  substr( $uri , $pos + 1 );
			$req  =  explode( '&' , $req );
			$uri  =  substr( $uri , 0 , $pos );
		}

		if ( !isset( $req ) )
			return $uri . '?' . ( is_int( $k ) ? $v : $k . '=' . $v );

		if ( is_int( $k ) )
		{
			$k  =  $v;
			$v  =  NULL;
		}

		$new_req  =  array();
		foreach ( $req as $request )
		{
			$r  = explode( '=' , $request );
			$key  =  isset( $r[0] ) ? $r[0] : NULL;
			$val  =  isset( $r[1] ) ? $r[1] : NULL;

			if ( $k === $key )
				$new_req[]  =  is_null( $v ) ? $k : $k . '=' . $v;
			else
				$new_req[]  =  is_null( $val ) ? $key : $key . '=' . $val;
		}

		if ( !empty( $new_req ) )
			return $uri . '?' . implode( $new_req , '&amp;' );

		return $uri;
	}
}


