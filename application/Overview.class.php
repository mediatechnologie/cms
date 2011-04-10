<?php
/**
 *  @file Overview.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-04-01
 *  Created: ven 2011-04-01, 11:32.28 CEST
 *  Last modified: dim 2011-04-10, 19:14.11 CEST
**/

//  @todo[~immeëmosol, sab 2011-04-02, 17:16.13 CEST]
//    implement/create OverviewAdapter
class Overview implements Viewable
{
	private $do;
	public           function __construct ( $do = NULL )
	{
		if ( NULL !== $do )
			if ( $do instanceof DataObject )
			{
				$this->do  =  $do;
			}
	}
	private function contents ()
	{
		$db  =  Databases::get( __CLASS__ , __FUNCTION__ );
		$sql  =  'SELECT * FROM page';
		$resource  =  $db->query( $sql );
		if ( !$resource )
			throw new Exception( 'db empty¿' );

		$results  =  array();
		while ( $r  =  $resource->fetch_assoc() )
			$results[]  =  $r;

		return $results;
	}
	public function show ()
	{
		$contents  =  $this->contents();

		$return  =  '';
		$return .=  ''
			. ''
		;
		$cs  =  $this->do->columns() ;
		$p  =  $this->do->primary();
		$p  =  $p[0];#$this->do->getColumnValue( $p[0] );
		foreach ( $contents as $c )
		{
			$return .=  ''
				. '<form action="' .$this->do->controller(). '" method="POST">'
				. '<dl>'
				. "\n"
			;
			foreach ( $cs as $cc )
			{
				if ( 'hidden' === $cc[ 'type' ] )
				{
					$return .=  ''
						. '<input'
						. ' type="' . $cc[ 'type' ] . '"'
						. ' value="' . htmlspecialchars( $c[ $cc['title'] ] ) . '"'
						. ' name="' . $cc[ 'title' ] . '"'
						. ' />'
						. "\n"
					;
					continue;
				}

				$id  =  $cc[ 'title' ];

				$return .=  ''
					. ''
					. '<dt>'
					. '<label for="' . $id . '" title="'
					. $cc[ 'desc' ]
					. '">'
					. $cc[ 'title' ]
					. '</label>'
					. '</dt>'
					. "\n"
				;
				if ( 'textarea' === $cc[ 'type' ] )
				{
					$return .= ''
						. '<dd>'
						. '<textarea'
						. ' value="' . htmlspecialchars( $c[ $cc['title'] ] ) . '"'
						. ' name="' . $cc[ 'title' ] . '"'
						. ' id="' . $id . '"'
						. '>'
						. htmlspecialchars( $c[ $cc[ 'title' ] ] )
						. '</textarea>'
						. '</dd>'
						. "\n"
					;
					continue;
				}

				$return .=  ''
					. '<dd>'
					. '<input'
					. ' type="' . $cc[ 'type' ] . '"'
					. ' value="' . htmlspecialchars( $c[ $cc['title'] ] ) . '"'
					. ' name="' . $cc[ 'title' ] . '"'
					. ' id="' . $id . '"'
					. ' />'
					. '</dd>'
					. "\n"
				;
			}
			$return .=  ''
				. '</dl>'
				. "\n"
				. '<input type="hidden" name="method" value="PUT" />'
				. "\n"
				. '<input type="submit" value="Bewerken" />'
				. "\n"
				. '</form>'
				. "\n"
			;
			$return .=  ''
				. '<form action="' . $this->do->controller() . '" method="POST">'
				. "\n"
				. '<input type="hidden" name="method" value="DELETE" />'
				. "\n"
				. '<input type="hidden" name="' .$p. '" value="' .$c[$p]. '" />'
				. "\n"
				. '<input type="submit" value="Verwijderen" />'
				. "\n"
				. '</form>'
				. "\n"
				. ''
				. '<hr />'
			;
		}
		$return .=  ''
			. ''
		;
		return $return;
	}
}


