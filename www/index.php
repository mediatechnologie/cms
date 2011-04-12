<?php
/**
 *  @file index.php
 *  @author immeëmosol (programmer dot willfris at nl)
 *  @date 2011-03-05
 *  Created: sab 2011-03-05, 15:51.10 CET
 *  Last modified: dim 2011-03-27, 15:26.44 CEST
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
define(
	'WEB_ROOT' ,
	str_replace(
			realpath(
				dirname(
					$_SERVER[ 'SCRIPT_FILENAME' ]
				)
			) ,
		'' ,
		WEB_DIR
	)
);

require APP_DIR . 'main.php';


