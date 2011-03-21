<?php
/**
 *  @file application.php
 *  @author immeëmosol (programmer dot willfris at nl)application.php
 *  @date 2011-03-05
 *  Created: sab 2011-03-05, 16:05.33 CET
 *  Last modified: lun 2011-03-21, 02:56.47 CET
**/


if ( !defined( 'WEB_DIR' ) || !defined( 'APP_DIR' ) )
	throw new Exception( 'missing configuration' );

require 'autoload.php';
spl_autoload_extensions( '.php , .class.php' );
set_include_path( APP_DIR );
echo '<style>html,body{background-color:#111;color:#EEE;}</style>';
var_dump( Request::_() );

