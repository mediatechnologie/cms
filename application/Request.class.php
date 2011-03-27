<?php
/**
 *  @file Request.class.php
 *  @author immeëmosol (programmer dot willfris at nl)
 *  @date 2011-03-05
 *  Created: sab 2011-03-05, 16:07.40 CET
 *  Last modified: dim 2011-03-27, 15:30.28 CEST
**/

/**
 *  @todo[~immeëmosol, dim 2011-03-20, 18:25.59 CET]
 *    determine_app_base should not have a static mapping,
 *      but determine it according to the request_uri.
**/
class Request
{
	private $resource;
	private $modifiers;
	private $verb;
	private $app_base;
	private static $FORMFIELDNAME_METHOD  =  'method';
	private static $ALLOWED_VERBS  =  array(
		'GET' ,
		'POST' ,
		'PUT' ,
		'DELETE' ,
	);
	final private function __clone (){}
	final private function __construct ()
	{
		$this->determineResource();
		$this->determineVerb();
#return self::$instance;// unnecesary, default behaviour
	}
	public function determineAppBase ()
	{
		$app_base  =  '';

		$script_in_request  =  strpos( $_SERVER['REQUEST_URI'] , $_SERVER['SCRIPT_NAME'] );
		$request_in_script  =  strpos( $_SERVER['SCRIPT_NAME'] , $_SERVER['REQUEST_URI'] );

		if ( 0 === $script_in_request )
			if (
				$_SERVER[ 'REQUEST_URI' ] === $_SERVER[ 'SCRIPT_NAME' ]
				||
				'/' === $_SERVER[ 'REQUEST_URI' ]{
					strlen( $_SERVER[ 'SCRIPT_NAME' ] )
				}
			)
				$app_base  =  $_SERVER[ 'SCRIPT_NAME' ];
			else
				$app_base  =  dirname( $_SERVER[ 'SCRIPT_NAME' ] );
		elseif ( FALSE === $script_in_request && 0 === $request_in_script )
			$app_base  =  dirname( $_SERVER[ 'SCRIPT_NAME' ] );

		$this->app_base  =  $app_base;
	}
	private function determineResource ()
	{
		if ( isset( $_SERVER[ 'PATH_INFO' ] ) )
		{
			$this->resource  =  $_SERVER[ 'PATH_INFO' ];
			return;
		}
		$this->determineAppBase();

		$modifiers  =  NULL;
		$resource   =  $_SERVER[ 'REQUEST_URI' ];
		if ( $pos = strpos( $resource , '?' ) )
		{
			$modifiers  =  explode( '&' , substr( $resource , $pos + 1 ) );
			$resource   =  substr( $resource , 0 , $pos );
		}

		if ( $this->app_base && 0 === strpos( $resource , $this->app_base ) )
			$resource  =  substr( $resource , strlen( $this->app_base ) );

		if ( FALSE === $resource )
			$resource  =  '/';

		$this->modifiers  =  $modifiers;
		$this->resource   =  $resource;
	}
	private function determineVerb ()
	{
		$verb  =  $_SERVER[ 'REQUEST_METHOD' ];
		if ( isset( $_POST[ self::$FORMFIELDNAME_METHOD ] ) )
			$verb  =  $_POST[ self::$FORMFIELDNAME_METHOD ];

		if ( !in_array( $verb , self::$ALLOWED_VERBS ) )
			throw new Exception( 'unallowed method/verb' );

		$this->verb  =  $verb;
	}

	public function method ()
	{
		$method  =  $this->verb;
		$method  =  strtolower( $method );
		return $method;
	}
	public function resource ()
	{
		$arr  =  explode( '/' , $this->resource );
		array_shift( $arr );
		return $arr;
	}
	public function uri ()
	{
		$uri  =  $this->resource .
			(
				$this->modifiers
				? '?' .
					implode(
						$this->modifiers , '&'
					)
				: ''
			)
		;
		return $uri;
	}

	public           function __call ( $method , $parameters = array() )
	{
		if ( method_exists( $this , '_' . $method ) )
			return call_user_func_array(
				array( $this , '_' . $method ) ,
				$parameters
			);
		elseif (
			'_' === $method{0}
			&& method_exists( $this , substr( $method , 1 ) )
		)
			return call_user_func_array(
				array( $this , substr( $method , 1 ) ) ,
				$parameters
			);
		/* *
		elseif ( method_exists( $this , $method ) )
			return call_user_func_array(
				array( $this , $method ) ,
				$parameters
			);/* */

		static $getters=array('password','acceptType','verb','username','url',);
		static $setters=array('password','acceptType','verb','username','url',);
		if (
			'et' === $method[1] . $method[2]
			&& is_string( $property = substr( $method , 3 ) )
		)// get-/set-ters -- determine which, validity and perform action
			if ( 'g' === $method[0] && in_array( $property , $getters ) )
				return $this->{ $property };
			elseif ( 's' === $method[0] && in_array( $property , $setters ) )
				return (
					$parameters[0] === (
						$this->{ $property } = $parameters[0]
					)
				)
# add slash to first asterisk for bool-return, otherwise, it's object-chainable
					? /* * TRUE //*/ $this
					: FALSE
				;
			else
				throw new Exception(
					'wrong (g|s)etter' .
					(
						defined( 'DEV' )
						? ' ' . rvd( $method ) . ' : ' . rvd( $parameters )
						: ''
					)
				);
		elseif (
			NULL !== ( $parameters_count = count( $parameters ) )
		)// get-/set-ters -- determine which and validity and call
			if (
				1 === $parameters_count
				&& in_array( $method , $setters )
			)
				return $this->{ 'set' . $method }( $parameters[0] );
			elseif (
				0 === $parameters_count
				&& in_array( $method , $getters )
			)
				return $this->{ 'get' . $method }();

		throw new BadMethodCallException( $method );
	}
	public           function __get ( $property )
	{
		return $this->{ 'get' . $property }( $value );
	}
	public           function __set ( $property , $value )
	{
		return $this->{ 'set' . $property }( $value );
	}

	private   static $instance  =  NULL;
	public    static function _ ()
	{
		if ( !( self::$instance instanceof self ) )
			self::$instance  =  new self();
		return self::$instance;
	}
	public    static function __callStatic ( $method , $parameters = array() )
	{
		$return  =  call_user_func_array(
			array(
				self::_() ,
				$method
			) ,
			$parameters
		);
		return $return;
	}

	public function j_parseUrl($url)
	{
		$r  = "(?:([a-z0-9+-._]+)://)?";
		$r .= "(?:";
		$r .=   "(?:((?:[a-z0-9-._~!$&'()*+,;=:]|%[0-9a-f]{2})*)@)?";
		$r .=   "(?:\[((?:[a-z0-9:])*)\])?";
		$r .=   "((?:[a-z0-9-._~!$&'()*+,;=]|%[0-9a-f]{2})*)";
		$r .=   "(?::(\d*))?";
		$r .=   "(/(?:[a-z0-9-._~!$&'()*+,;=:@/]|%[0-9a-f]{2})*)?";
		$r .=   "|";
		$r .=   "(/?";
		$r .=     "(?:[a-z0-9-._~!$&'()*+,;=:@]|%[0-9a-f]{2})+";
		$r .=     "(?:[a-z0-9-._~!$&'()*+,;=:@\/]|%[0-9a-f]{2})*";
		$r .=    ")?";
		$r .= ")";
		$r .= "(?:\?((?:[a-z0-9-._~!$&'()*+,;=:\/?@]|%[0-9a-f]{2})*))?";
		$r .= "(?:#((?:[a-z0-9-._~!$&'()*+,;=:\/?@]|%[0-9a-f]{2})*))?";
		preg_match("`$r`i", $url, $match);
		$parts = array(
				"scheme"=>'',
				"userinfo"=>'',
				"authority"=>'',
				"host"=> '',
				"port"=>'',
				"path"=>'',
				"query"=>'',
				"fragment"=>'');
		switch (count ($match)) {
			case 10: $parts['fragment'] = $match[9];
			case 9: $parts['query'] = $match[8];
			case 8: $parts['path'] =  $match[7];
			case 7: $parts['path'] =  $match[6] . $parts['path'];
			case 6: $parts['port'] =  $match[5];
			case 5: $parts['host'] =  $match[3]?"[".$match[3]."]":$match[4];
			case 4: $parts['userinfo'] =  $match[2];
			case 3: $parts['scheme'] =  $match[1];
		}
		$parts['authority'] = ($parts['userinfo']?$parts['userinfo']."@":"").
			$parts['host'].
			($parts['port']?":".$parts['port']:"");
		return $parts;
	}
}


