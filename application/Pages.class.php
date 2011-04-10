<?php
/**
 *  @file Pages.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-25
 *  Created: ven 2011-03-25, 10:23.59 CET
 *  Last modified: dim 2011-04-10, 19:16.17 CEST
**/

//  @todo[~immeëmosol, mer 2011-04-06, 01:40.34 CEST]
//    check if input is empty
//    check if input for uri already exists(has to be unique, could be in db?)
//  @todo[~immeëmosol, mer 2011-04-06, 01:53.37 CEST]
//    restricties opleggen aan image
//  @todo[~immeëmosol, mer 2011-04-06, 01:53.47 CEST]
//    image-upload `abstraheren` naar een eigen klasse
//      klasse is te configureren via parameters op
//        toegestane type's/bestandsformaten
//        toegestane breedte,hoogte,verhoudingen
//      klasse controleert ook op evt. exif-gegevens?
//  @todo[~immeëmosol, mer 2011-04-06, 01:56.44 CEST]
//    kijken of het opslaan van het absolute (server)padnaam handig uitpakt
//    het uitlezen en meegeven van de banner aan de weergegeven pagina;
//      de get()-methode en Window-klasse beter onder de loep nemen
//  @todo[~immeëmosol, ven 2011-04-08, 15:28.17 CEST]
//    find appropriate http-header for 'no updates'-exception
class Pages extends Handler
{
	private $default_page_id  =  'home';
	public           function __construct ()
	{
	}
	public function get ( $page_id = NULL )
	{
		if ( '' === $page_id )
			$page_id  =  $this->default_page_id;

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
		$errors  =  array();

		$this->user  =  Users::get();
		$db  =  Databases::get( __CLASS__ , __FUNCTION__ );
		$banner  =  ' NULL ';

		if ( isset( $_POST[ 'page_title' ] ) )
			$page_title  =  $db->real_escape_string( $_POST['page_title'] );
		else
			ChromePhp::warn( 'page_title not set' );

		if ( isset( $_POST[ 'page_content' ] ) )
			$page_content  =  $db->real_escape_string( $_POST['page_content'] );
		else
			ChromePhp::warn( 'page_content not set' );

		if ( isset( $_FILES[ 'page_banner' ] ) )
			$banner  =  $db->real_escape_string(
				$this->saveBanner( $_FILES[ 'page_banner' ] )
			);
		else
			ChromePhp::warn( 'banner not set' );

		if (
			isset( $page_title , $page_content , $banner )
			&& FALSE !== $banner
		)
		{
			$resource  =  $db->query(
				'INSERT INTO'
				. ' page ( title , content , banner )'
				. ' VALUES ( '
				. ' \'' . $page_title . '\' '
				. ' , '
				. ' \'' . $page_content . '\' '
				. ' , '
				. ' \'' . $banner . '\' '
				. ')'
			);
			ChromePhp::log( $resource );
			if ( $db->error )
			{
				ChromePhp::warn( $db->error );
				ChromePhp::log($db);
			}
			if ( TRUE === $resource )
				return Response::OK();
		}

		return Response::FAIL( $errors );
	}
	public function put ()
	{
		if ( !isset( $_POST[ 'page_id' ] ) )
			throw new Exception( 'page-identifier not set' );

		$this->user  =  Users::get();

		$page_id  =  1 * $_POST['page_id'];

		$db  =  Databases::get( __CLASS__ , __FUNCTION__ );

		$updates  =  array();
		if ( isset( $_POST[ 'title' ] ) && !empty( $_POST[ 'title' ] ) )
		{
			$title    =  $_POST[ 'title' ];
			$title    =  $db->real_escape_string( $title   );
			$updates[]  =  ' title   = \'' . $title   . '\' ';
		}
		if ( isset( $_POST[ 'content' ] ) && !empty( $_POST[ 'content' ] ) )
		{
			$content  =  $_POST[ 'content' ];
			$content  =  $db->real_escape_string( $content );
			$updates[]  =  ' content = \'' . $content . '\' ';
		}
		if ( isset( $_POST[ 'banner' ] ) && !empty( $_POST[ 'banner' ] ) )
		{
			$banner   =  $_POST[ 'banner' ];
			$banner   =  $db->real_escape_string( $banner  );
			$updates[]  =  ' banner  = \'' . $banner  . '\'  ';
		}
		if ( empty( $updates ) )
			throw new Exception( 'no updates' );

		$result  =  NULL;
		$resource  =  $db->query(
			'UPDATE page SET '
			. implode( $updates , ',' )
			. ' WHERE page.page_id = '
			. $db->real_escape_string( $page_id )
		);

		if ( NULL === $resource )
			return;

		if ( TRUE !== $resource )
			return Response::FAIL();

	return Response::OK();
	}
	public function delete ()
	{
		if ( !isset( $_POST[ 'page_id' ] ) )
			throw new Exception( 'page-identifier not set' );

		$this->user  =  Users::get();

		$page_id  =  1 * $_POST['page_id'];

		$db  =  Databases::get( __CLASS__ , __FUNCTION__ );
		$result  =  NULL;
		$resource  =  $db->query(
			'DELETE FROM page WHERE page.page_id = '
			. $db->real_escape_string( $page_id )
		);

		if ( NULL === $resource )
			return;

		if ( TRUE !== $resource )
			return Response::FAIL();

	return Response::OK();
	}

	private function saveBanner ( $banner )
	{
		$saved_location  =  FALSE;
		if ( UPLOAD_ERR_OK !== $banner[ 'error' ] )
			return $banner[ 'error' ];
		if ( !is_uploaded_file( $banner[ 'tmp_name' ] ) )
			return FALSE;
		$destination  =  ''
			. dirname( APP_DIR ) . DIRECTORY_SEPARATOR
			. 'uploads' . DIRECTORY_SEPARATOR
			. $banner[ 'name' ]
		;
		if ( !move_uploaded_file( $banner[ 'tmp_name' ] , $destination ) )
			return FALSE;
		$saved_location  =  $destination;

		ChromePhp::log( $banner );
		ChromePhp::log( $saved_location );
		return $saved_location;
	}
}


