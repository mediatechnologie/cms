<?php
/**
 *  @file PageDataObject.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-31
 *  Created: ĵaŭ 2011-03-31, 22:50.03 CEST
 *  Last modified: ven 2011-04-01, 00:01.35 CEST
**/

class PageDataObject extends DataObject
{
	private $title  =  'page';
	private $plural_title  =  'pages';
	private $columns  =  array(
		array(
			'title' => 'id' ,
		) ,
		array(
			'title' => 'title' ,
			'desc'  => 'title for page' ,
		) ,
		array(
			'title' => 'content' ,
			'desc'  => 'content of page' ,
		) ,
	);
	public           function __construct ()
	{
	}
}


