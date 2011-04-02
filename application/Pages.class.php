<?php
/**
 *  @file Pages.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-25
 *  Created: ven 2011-03-25, 10:23.59 CET
 *  Last modified: sab 2011-04-02, 17:02.31 CEST
**/

class Pages extends Handler
{
	public           function __construct ()
	{
	}
	public function get ( $page_id = NULL )
	{
		$db  =  Databases::get( __CLASS__ , __FUNCTION__ );
		$result  =  NULL;
		if ( is_int( $page_id ) || is_numeric( $page_id ) )
			$resource  =  $db->query(
				'SELECT * FROM page WHERE page.page_id = '
				. $db->real_escape_string( $page_id )
			);
		elseif ( is_string( $page_id ) )
			$resource  =  $db->query(
				'SELECT * FROM page WHERE page.title = \''
				. $db->real_escape_string( $page_id )
				. '\' '
			);
		if ( NULL === $resource )
			return;

		if ( 0 === $resource->num_rows )
			return;

		$results  =  array();
		while ( $result = $resource->fetch_array() )
			$results[]  =  $result;
		if ( NULL !== $page_id && 1 === count( $results ) )
		{
			if ( isset( $results[0][ 'title' ] , $results[0][ 'content' ] ) )
				return new Window(
					$results[0][ 'title' ] ,
					$results[0][ 'content' ]
				);
		}

		return;
	}
	public function post ()
	{
		$this->user  =  Users::get();
		$db  =  Databases::get( __CLASS__ , __FUNCTION__ );
		$resource  =  $db->query(
			'INSERT INTO'
			. ' page ( title , content )'
			. ' VALUES ( '
			. ' \'' . $db->real_escape_string( $_POST['page_title'] ) . '\' '
			. ' , '
			. ' \'' . $db->real_escape_string( $_POST['page_content'] ) . '\' '
			. ')'
		);
		ChromePhp::log( $resource );
		if ( TRUE === $resource )
			return Response::OK();

		$errors  =  array();
		ChromePhp::warn( $db->error );
		return Response::FAIL( $errors );
	}
	public function put ()
	{
		$this->user  =  Users::get();
	}
	public function delete ()
	{
		$this->user  =  Users::get();
	}
}


