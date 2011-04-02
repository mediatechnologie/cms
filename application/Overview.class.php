<?php
/**
 *  @file Overview.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-04-01
 *  Created: ven 2011-04-01, 11:32.28 CEST
 *  Last modified: sab 2011-04-02, 17:28.30 CEST
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
		$resource  =  $db->query(
			'SELECT * FROM page'
		);
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
		foreach ( $contents as $c )
		{
			foreach ( $cs as $cc )
			{
				if ( 'hidden' === $cc[ 'type' ] )
					continue;

				$return .=  ''
					. ''
					. '<em>'
					. $cc[ 'title' ]
					. ' ('
					. $cc[ 'desc' ]
					. ') : '
					. '</em>'
					. htmlspecialchars( $c[ $cc[ 'title' ] ] )
					. ''
					. '<br />'
				;
			}
			$return .=  ''
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


