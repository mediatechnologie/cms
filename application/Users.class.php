<?php
/**
 *  @file Users.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-27
 *  Created: dim 2011-03-27, 23:25.25 CEST
 *  Last modified: dim 2011-03-27, 23:26.03 CEST
**/

class Users
{
	public    static function get()
	{
		$user  =  new User();
		return $user;
	}
}


