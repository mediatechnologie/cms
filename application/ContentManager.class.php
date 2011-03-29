<?php
/**
 *  @file ContentManager.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-25
 *  Created: ven 2011-03-25, 10:07.26 CET
 *  Last modified: mar 2011-03-29, 03:45.53 CEST
**/

//  @todo[~immeëmosol, mar 2011-03-29, 03:51.44 CEST]
//    DataObject aanmaken dat gegevens klaarzet
//      die gegevens kunnen op weer verwerkt worden door de Form-klasse
class ContentManager extends Handler
{
	public           function __construct ()
	{
		//  Because all methods need authentication
		Users::get();
	}
	public function get ()
	{
		//$paginas  =  new DataObject( 'paginas' );
		$paginas  =  NULL;
		$contents  =  array();
		$contents[]  =  new Form( $paginas );
		$contents[]  =  'AAAAHHHH!!!';
		return $contents;
	}
}


