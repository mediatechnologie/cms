<?php
/**
 *  @file UploadManager.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-04-12
 *  Created: mar 2011-04-12, 17:10.05 CEST
 *  Last modified: mar 2011-04-12, 17:34.16 CEST
**/

class UploadManager extends Handler
{
	public           function __construct ()
	{
	}
	/**
	 *  Shows requested uploaded resource or offers it for download
	**/
	public function get ( $resource = NULL )
	{
		$contents      =  array();

		$upload_dir  =  ''
			. dirname( APP_DIR ) . DIRECTORY_SEPARATOR
			. 'uploads' . DIRECTORY_SEPARATOR
		;
		$file  =  $upload_dir . $resource;

		$contents[]    =  file_get_contents( $file );

		$finfo = finfo_open( FILEINFO_MIME_TYPE );
		$mimetype  =  finfo_file( $finfo , $file );

		header( 'Content-type: ' . $mimetype );
		return $contents;
	}
}


