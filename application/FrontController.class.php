<?php
/**
 *  @file FrontController.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-25
 *  Created: ven 2011-03-25, 09:56.15 CET
 *  Last modified: mar 2011-03-29, 02:01.55 CEST
**/

class FrontController
{
	private $mappings  =  array();

	public           function __construct ( $mappings = array() )
	{
		$this->mappings  =  $mappings;

		$class  =  'NotFound';

		//echo '<style>html,body{background-color:#111;color:#EEE;}</style>';
		$request  =  Request::_resource();
		if (
			isset( $request[0] )
			&& array_key_exists( $request[0] , $this->mappings )
		)
			$class  =  $this->mappings[ $request[0] ][0];

		if ( !class_exists( $class ) )
			throw new Exception(
				'class '.(defined('DEV')?'`'.$class.'` ':'').'does not exist'
			);
		$client_target  =  new $class();
		$action  =  Request::_method();
		$response  =  $client_target->$action();

		$content  =  $this->parseResponse( $response );

		$head_title  =  '';
		$body_title  =  '';
		echo <<<HTM
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8" />
		<title>{$head_title}</title>
		<style>html{background-color:black;color:silver;font-family:sans-serif;}</style>
	</head>
	<body>
		<h1>{$body_title}</h1>{$content}
	</body>
</html>
HTM;
	}
	private function parseResponse ( $response )
	{
		$return  =  NULL;
		if ( $response instanceof Viewable )
			$return .=  "\n\t\t" . $response->show();
		elseif ( is_string( $response ) )
			$return .=  $response;
		elseif ( is_array( $response ) )
			foreach ( $response as $r )
				$return .=  $this->parseResponse( $r );

		if ( !is_string( $return ) && !is_null( $return ) )
			throw new Exception(
				'wrong return... (probably show-method)'
				. ( defined( 'DEV' ) ? ' ' . rvd( $return ) : '' )
			);

		return $return;
	}
}


