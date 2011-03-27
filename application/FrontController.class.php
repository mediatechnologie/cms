<?php
/**
 *  @file FrontController.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-25
 *  Created: ven 2011-03-25, 09:56.15 CET
 *  Last modified: dim 2011-03-27, 15:29.40 CEST
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
		$client_target->$action();

	}
}


