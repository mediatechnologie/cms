<?php
/**
 *  @file PageDataObject.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-31
 *  Created: ĵaŭ 2011-03-31, 22:50.03 CEST
 *  Last modified: ven 2011-04-01, 10:58.13 CEST
**/

//  @todo[~immeëmosol, ven 2011-04-01, 10:57.45 CEST]
//    member: controller juister definiëren; vanuit een dynamischere context
class PageDataObject extends DataObject
{
	protected $controller  =  '/paginas';

	protected $title  =  'page';
	protected $plural_title  =  'pages';
	protected $columns  =  array(
		array(
			'title' => 'id' ,
			'type'  => 'hidden' ,
			'desc'  => 'unique id for page' ,
			'name'  => 'page_id' ,
		) ,
		array(
			'title' => 'title' ,
			'type'  => 'text' ,
			'desc'  => 'title for page' ,
			'name'  => 'page_title' ,
		) ,
		array(
			'title' => 'content' ,
			'type'  => 'textarea' ,
			'desc'  => 'content of page' ,
			'name'  => 'page_content' ,
		) ,
	);
}


