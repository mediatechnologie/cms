<?php
/**
 *  @file FormAdapter.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-31
 *  Created: ĵaŭ 2011-03-31, 22:37.25 CEST
 *  Last modified: ven 2011-04-01, 00:34.19 CEST
**/

class FormAdapter
{
	private $fields   =  array();

	public           function __construct ( $adaptee )
	{
		if ( $adaptee instanceof DataObject )
			$this->adaptDataObject( $adaptee );
		else
			throw new Exception( 'unable to adapt adaptee for usage in Form' );
	}
	private function adaptDataObject ( DataObject $do )
	{
		vd( $do );
		$form  =  '<input type="text" name="title" value="De titel" />';
		$form .=  "\n";
		$form .=  '<textarea name="content">value</textarea>';
		$form .=  "\n";
		$form .=  '<input type="submit" />';
		$form .=  "\n";
		$form .=  '<input type="reset" />';
		$form .=  "\n";
	}


	public function fieldsets ()
	{
	}
	public function fields ()
	{
		return $this->fields;
	}
}


