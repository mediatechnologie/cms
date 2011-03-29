<?php
/**
 *  @file Pages.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-25
 *  Created: ven 2011-03-25, 10:23.59 CET
 *  Last modified: dim 2011-03-27, 23:24.32 CEST
**/

class Pages extends Handler
{
	public           function __construct ()
	{
	}
	public function post ()
	{
		Users::get();
	}
	public function put ()
	{
		Users::get();
	}
	public function delete ()
	{
		Users::get();
	}
}


