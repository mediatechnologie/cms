<?php
/**
 *  @file NotFound.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-04-01
 *  Created: ven 2011-04-01, 10:14.41 CEST
 *  Last modified: ven 2011-04-01, 12:22.33 CEST
**/

class NotFound extends Handler
{
	public           function __construct ()
	{
	}
	public function get ( $page_id = NULL )
	{
		$p  =  new Pages();
		$args  =  func_get_args();
		if (
			$page  =  call_user_func_array(
				array(
					$p ,
					__FUNCTION__
				) ,
				$args
			)
		)
			return $page;
		return 'NotFound';
		return call_user_func( 'parent::' . __FUNCTION__ );
	}
}


