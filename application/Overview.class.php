<?php
/**
 *  @file Overview.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-04-01
 *  Created: ven 2011-04-01, 11:32.28 CEST
 *  Last modified: ven 2011-04-01, 11:38.31 CEST
**/

class Overview
{
	public           function __construct ( $do = NULL )
	{
		if ( NULL !== $do )
			if ( $do instanceof DataObject )
			{
				//if ( $action = $do->controller() )
					//$this->action( $action );
				$this->fo  =  new FormAdapter( $do );
			}
	}
}


