<?php
/**
 *  @file main.php
 *  @author immeëmosol (programmer dot willfris at nl)application.php
 *  @date 2011-03-05
 *  Created: sab 2011-03-05, 16:05.33 CET
 *  Last modified: mar 2011-04-12, 17:09.52 CEST
**/


if ( !defined( 'WEB_DIR' ) || !defined( 'APP_DIR' ) )
	throw new Exception( 'missing configuration' );

require 'autoload.php';
spl_autoload_extensions( '.php , .class.php' );
set_include_path( APP_DIR );

$uri_mappings  =  array(
	//'' => array( 'Pages' , 'home' ) ,
	'beheer' => array( 'ContentManager' , ) ,
	//'paginas' => array( 'Pages' , ) ,
	'uploads' => array( 'UploadManager' , ) ,
);

try
{
	new FrontController( $uri_mappings , 'Pages' );
}
catch ( Exception $e )
{
	if ( defined( 'DEV' ) )
		vd( $GLOBALS );
	if ( defined( 'DEV' ) )
		throw $e;
}
