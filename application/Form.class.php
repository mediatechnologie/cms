<?php
/**
 *  @file Form.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-29
 *  Created: mar 2011-03-29, 03:45.59 CEST
 *  Last modified: ven 2011-04-01, 00:38.02 CEST
**/

//  @todo[~immeëmosol, mar 2011-03-29, 03:54.36 CEST]
//    decide on placeholder-support for certain input-types
class Form implements Viewable
{
	private static $DEFAULT_METHOD  =  'POST';

	private $action   =  NULL;
	private $method   =  NULL;
	private $enctype  =  NULL;

	private $do  =  NULL;

	public           function __construct ( $do = NULL )
	{
		if ( NULL !== $do )
			$this->newData( new FormAdapter( $do ) );
	}
	private function newData ( FormAdapter $do = NULL )
	{
		// fields danwel fieldsets implementeren
		$this->do  =  $do;
	}
	public           function show ()
	{
		$form  =  '';
		$form .=  '<form'
			. $this->action()
			. $this->method()
			. $this->enctype()
			. '>'
		;
		$form .=  "\n";

		
		if ( $do_fs = $this->do->fieldsets() )
			$form .=  $this->parseFieldsets( $do_f );
		elseif ( $do_fs = $this->do->fields() )
			$form .=  $this->parseFields( $do_f );
		else
			$form .=  'empty';

		$form .=  '</form>';
		$form .=  "\n";
		return $form;
	}


	public function action ()
	{
		return ' action="' . (
				NULL !== $this->action
				? $this->action
				: (
					(
						  class_exists( 'Uri' )
						&& method_exists( 'Uri' , 'current' )
					)
					? Uri::current()
					: $_SERVER[ 'REQUEST_URI' ]
				)
			) . '"';
	}
	public function method ()
	{
		return ' method="' . (
				NULL !== $this->method
				? $this->method
				: self::$DEFAULT_METHOD
			) . '"';
	}
	public function enctype ()
	{
		if ( $this->enctype )
			return ' enctype="' . $this->enctype . '"';
	}
}


