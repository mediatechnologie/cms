<?php
/**
 *  @file DataObject.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-31
 *  Created: ĵaŭ 2011-03-31, 22:42.33 CEST
 *  Last modified: ven 2011-04-01, 10:38.50 CEST
**/

class DataObject
{
	protected $controller  =  NULL;

	public           function __construct ( $data = NULL )
	{
	}

	public function columns ()
	{
		return $this->columns;
	}

	public function controller ( $controller = NULL )
	{
		if ( NULL === $controller )
			return $this->controller;
	}
}


