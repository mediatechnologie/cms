<?php
/**
 *  @file Form.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-29
 *  Created: mar 2011-03-29, 03:45.59 CEST
 *  Last modified: mer 2011-04-06, 01:37.43 CEST
**/

//  @todo[~immeëmosol, mar 2011-03-29, 03:54.36 CEST]
//    decide on placeholder-support for certain input-types
//  @todo[~immeëmosol, ven 2011-04-01, 10:55.44 CEST]
//    fixen dat de id`s op de formulierenvelden wel uniek zijn,
//      wellicht door een id voor het overkoepelende fieldset mee te nemen
//  @todo[~immeëmosol, dim 2011-04-03, 14:52.29 CEST]
//    fixeren van het enctype-attribuut op de form-tag
class Form implements Viewable
{
	const FILE_ENCTYPE  =  'multipart/form-data';

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
		if ( $fo_fs = $this->fo->fieldsets() )
			$content  =  $this->parseFieldsets( $fo_fs );
		elseif ( $fo_fs = $this->fo->fields() )
			$content  =  $this->parseFields( $fo_fs );

		$form  =  '';
		$form  =  '<form'
			. $this->action()
			. $this->method()
			. $this->enctype()
			. '>'
		;
		$form .=  "\n";
		$form .=  isset( $content ) ? $content : 'empty' ;

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
			if ( 'file' === $field[ 'type' ] )
				$this->enctype( self::FILE_ENCTYPE , TRUE );

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
			. $this->fieldId( $field )
			. $this->fieldName( $field )
			. '>'
			. '</' . $field[ 'type' ] . '>'
		;
	}
	private function parseInput ( $field )
	{
		return ''
			. '<input'
			. ' type="' . $field[ 'type' ] . '"'
			. $this->fieldId( $field )
			. $this->fieldName( $field )
			. ' name="' . $this->fo->name() . '_' . $field[ 'name' ] . '"'
			. ' />'
		;
	}
	private function fieldId ( $field )
	{
		$id  =  ' id="' . $this->fo->name() . '_' . $field[ 'name' ] . '"';
		return $id;
	}
	private function fieldName ( $field )
	{
		$name  =  ' name="' . $this->fo->name() . '_' . $field[ 'name' ] . '"';
		return $name;
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
	public function enctype ( $enctype = NULL , $fixed = FALSE )
	{
		if ( NULL === $enctype )
			return $this->enctype
				? ' enctype="' . $this->enctype . '"'
				: NULL
			;
		if ( self::FILE_ENCTYPE === $enctype )
			$this->enctype  =  self::FILE_ENCTYPE;#'multipart/form-data';
		if ( FALSE !== $fixed /*TRUE === $fixed*/)
//doe iets van dat andere data-sets niet meer de enctype kunnen veranderen...
			$fixed;
	}
}


