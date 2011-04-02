<?php
/**
 *  @file Form.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-29
 *  Created: mar 2011-03-29, 03:45.59 CEST
 *  Last modified: sab 2011-04-02, 13:52.05 CEST
**/

//  @todo[~immeëmosol, mar 2011-03-29, 03:54.36 CEST]
//    decide on placeholder-support for certain input-types
//  @todo[~immeëmosol, ven 2011-04-01, 10:55.44 CEST]
//    fixen dat de id`s op de formulierenvelden wel uniek zijn,
//      wellicht door een id voor het overkoepelende fieldset mee te nemen
class Form implements Viewable
{
	private static $DEFAULT_METHOD  =  'POST';

	private $action   =  NULL;
	private $method   =  NULL;
	private $enctype  =  NULL;

	private $fo  =  NULL;

	public           function __construct ( $do = NULL )
	{
		if ( NULL !== $do )
			if ( $do instanceof DataObject )
			{
				if ( $action = $do->controller() )
					$this->action( $action );
				$this->fo  =  new FormAdapter( $do );
			}
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

		
		if ( $fo_fs = $this->fo->fieldsets() )
			$form .=  $this->parseFieldsets( $fo_fs );
		elseif ( $fo_fs = $this->fo->fields() )
			$form .=  $this->parseFields( $fo_fs );
		else
			$form .=  'empty';

		$form .=  '<input type="submit" />';
		$form .=  "\n";
		$form .=  '<input type="reset" />';
		$form .=  "\n";

		$form .=  '</form>';
		$form .=  "\n";
		return $form;
	}


	private function parseFieldsets ( $fieldsets )
	{
		$return  =  '';
		foreach ( $fieldsets as $fieldset )
		{
			$return .=  '<fieldset>';
			$return .=  "\n";
			$return .=  '<legend>' . $fieldset[ 'legend' ] . '</legend>';
			$return .=  "\n";
			$return .=  $this->parseFields( $fieldset[ 'fields' ] );
			$return .=  "\n";
			$return .=  '</fieldset>';
			$return .=  "\n";
		}
		return $return;
	}
	private function parseFields ( $fields )
	{
		$return  =  '';
		$return .=  '<dl>';
		$return .=  "\n";
		foreach  ( $fields  as $field )
		{
			if ( 'hidden' === $field[ 'type' ] )
				continue;

			$return .=  ''
				. '<dt>'
				. '<label for="">' . $field[ 'desc' ] . '</label>'
				. '</dt>'
			;
			$return .=  "\n";
			if ( 'textarea' === $field[ 'type' ] )
			{
				$return .=  ''
					. '<dd>'
					. $this->parseTextarea( $field )
					. '</dd>'
				;
				$return .=  "\n";
				continue;
			}

			$return .=  ''
				. '<dd>'
				. $this->parseInput( $field )
				. '</dd>'
			;
			$return .=  "\n";
		}
		$return .=  '</dl>';
		$return .=  "\n";
		return $return;
	}

	private function parseTextarea ( $field )
	{
		return ''
			. '<'
			. $field[ 'type' ]
			. ' id="' . $field[ 'name' ] . '"'
			. ' name="' . $field[ 'name' ] . '"'
			. '>'
			. '</' . $field[ 'type' ] . '>'
		;
	}
	private function parseInput ( $field )
	{
		return ''
			. '<input'
			. ' type="' . $field[ 'type' ] . '"'
			. ' id="' . $field[ 'name' ] . '"'
			. ' name="' . $field[ 'name' ] . '"'
			. ' />'
		;
	}


	public function action ( $action = NULL )
	{
		if ( NULL === $action )
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
				) . '"'
			;
		
		$this->action  =  $action;
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


