<?php
/**
 *  @file FrontController.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-25
 *  Created: ven 2011-03-25, 09:56.15 CET
 *  Last modified: ven 2011-04-01, 12:37.06 CEST
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
		$action         =  Request::_method();
		$response       =  NULL;

		if ( method_exists( $client_target , 'pre_action' ) )
			$response  =  $client_target->pre_action();

		if ( NULL === $response )
			$response  =  call_user_func_array(
				array(
					$client_target ,
					$action
				) ,
				$request
			);

		if ( method_exists( $client_target , 'post_action' ) )
			$post_action  =  $client_target->post_action();
		if ( isset( $post_action ) && NULL !== $post_action )
			$response  =  $post_action;

		$head_title  =  '';
		$body_title  =  '';
		$content  =  $this->parseResponse( $response );
		if ( is_array( $content ) )
		{
			$head_title  =
				isset( $content[ 'head_title' ] )
				?  $content['head_title']
				: $head_title
			;
			$body_title  =
				isset( $content[ 'body_title' ] )
				?  $content['body_title']
				: $body_title
			;
			$content  =
				isset( $content[ 'content' ] )
				?  $content['content']
				: $content
			;
		}
		if ( isset( $content{0} ) && "\n" !== $content{0} )
			$content  =  "\n\t\t$content";

		$page  =  <<<HTM
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8" />
		<title>{$head_title}</title>
HTM;
		$page .=  '		<link rel="stylesheet" href="css/main.css" />' . "\n";
		$rage  =  '		<style>html{background-color:black;color:silver;font-family:sans-serif;}</style>' . "\n";
		$page .=  <<<HTM
	</head>
	<body>
		<h1>{$body_title}</h1>{$content}
	</body>
</html>
HTM;
		echo $page;
	}
	private function parseResponse ( $response )
	{
		$return  =  NULL;
		if ( $response instanceof Viewable )
			$return  =  $response->show();
		elseif ( $response instanceof Window )
			$return  =  array(
				  'head_title' => $response->title()
				, 'body_title' => $response->title()
				, 'content' => $response->content()
			)
		;
		elseif ( is_string( $response ) )
			$return .=  $response;
		elseif ( is_array( $response ) )
			foreach ( $response as $r )
				$return .=  $this->parseResponse( $r );

		if (
			  !is_string( $return )
			&& !is_null( $return )
			&& !is_array( $return )
		)
			throw new Exception(
				'wrong return... (probably show-method)'
				. ( defined( 'DEV' ) ? ' ' . rvd( $return ) : '' )
			);

		return $return;
	}
}


