<?php
/**
 *  @file ContentManager.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-25
 *  Created: ven 2011-03-25, 10:07.26 CET
 *  Last modified: dim 2011-04-03, 14:04.20 CEST
**/

//  @todo[~immeëmosol, mar 2011-03-29, 03:51.44 CEST]
//    DataObject aanmaken dat gegevens klaarzet
//      die gegevens kunnen op weer verwerkt worden door de Form-klasse
class ContentManager extends Handler
{
	public           function __construct ()
	{
		// Because most methods need to know which type of user is active
		$this->user  =  Users::get();
	}
	public function pre_action ()
	{
		$return  =  NULL;
		//  Because all this object's methods need authentication
		if ( !$this->user->known() )
			$return  =  new Window(
					'unauthorized' ,
					''
						. '<p>You shall not pass!</p>'
						. '<p><a href="'
						. Uri::alterCurrent(
							array(
								'get' => array(
									'retry' ,
								) ,
							)
						)
						. '">retry</a>( timed-out)</p>'
				)
			;
		return $return;
	}
	/**
	 *  Shows an overview of management-tasks.
	**/
	public function get ()
	{
		$paginas_form  =  new Form( new DataObject( 'page' ) );
		$paginas_overzicht  =  new Overview( new DataObject( 'page' ) );

		$contents      =  array();

		$contents[]    =  $paginas_overzicht;
		$contents[]    =  $paginas_form;
		//$contents[]    =  'AAAAHHHH!!!';

		return $contents;
	}
	public function post ()
	{
		// post is misgegaan ??? :p
		// wickT cewL; http-rest_gedoe...
		vd(func_get_args());
		vd($_POST);
		vd($_FILES);
		return $this->get();
	}
}


