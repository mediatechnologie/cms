<?php
/**
 *  @file Form.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-29
 *  Created: mar 2011-03-29, 03:45.59 CEST
 *  Last modified: mar 2011-03-29, 03:54.53 CEST
**/

//  @todo[~immeëmosol, mar 2011-03-29, 03:54.36 CEST]
//    decide on placeholder-support for certain input-types
class Form implements Viewable
{
	public           function __construct ()
	{
	}
	public           function show ()
	{
		$form  =  '';
		$form .=  '<form enctype method action>';
		$form .=  '<input type="text" name="title" value="De titel" />';
		$form .=  '<textarea name="content">value</textarea>';
		$form .=  '<input type="submit" />';
		$form .=  '<input type="reset" />';
		$form .=  '</form>';
		return $form;
	}
}


