<?php
/**
 *  @file index.php
 *  @author immeëmosol (programmer dot willfris at nl)
 *  @date 2011-03-05
 *  Created: sab 2011-03-05, 15:51.10 CET
 *  Last modified: sab 2011-03-05, 16:04.42 CET
**/


define(
	'WEB_DIR' ,
	(
		defined( '__DIR__' )
		? __DIR__
		: dirname( __FILE__ )
	) .
	DIRECTORY_SEPARATOR
);
define(
	'APP_DIR' ,
	realpath(
		WEB_DIR .
		'..' .
		DIRECTORY_SEPARATOR .
		'application' .
		DIRECTORY_SEPARATOR
	) .
	DIRECTORY_SEPARATOR
);

require APP_DIR . 'application.php';


