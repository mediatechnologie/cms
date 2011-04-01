<?php
/**
 *  @file FormAdapter.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-31
 *  Created: ĵaŭ 2011-03-31, 22:37.25 CEST
 *  Last modified: ven 2011-04-01, 10:41.51 CEST
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
	//  @note[~immeëmosol, ven 2011-04-01, 10:36.28 CEST]
	//    methode verwerkt data-object voor gebruik in form-klasse
	private function adaptDataObject ( DataObject $do )
	{
		$columns  =  $do->columns();
		foreach ( $columns as $column )
		{
			$this->fields[]  =  $column;
		}
	}


	public function fieldsets ()
	{
	}
	public function fields ()
	{
		return $this->fields;
	}
}


