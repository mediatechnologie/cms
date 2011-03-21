<?php
/**
 *  @file autoload.php
 *  @old_file autoloader.inc.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2010-12-03
 *  Created: ven 2010-12-03, 10:01.29 CET
 *  adjusted 2011-03-05 16:10 +/-
 *  Last modified: ven 2011-03-11, 14:01.53 CET
**/

function mijn_autoloader ( $class_name )
{
	//$class_name  =  implode( DIRECTORY_SEPARATOR , array_map( 'lcfirst' , explode( '\\' , $class_name ) ) );
	//@note[~immeëmosol, sab 2010-12-25, 12:41.31 CET]
	//  replace namespace-slashes with direcory_separator for current operating system
	$class_name     =  implode( DIRECTORY_SEPARATOR , explode( '\\' , $class_name ) );
	$extensions     =  array_filter( array_map( 'trim' , explode( ',' , spl_autoload_extensions() ) ) );
	$include_paths  =  array_filter( array_map( 'trim' , explode( PATH_SEPARATOR , get_include_path() ) ) );
	foreach ( $include_paths as $path )
	{
		$path .=  ( DIRECTORY_SEPARATOR !== $path[ strlen( $path ) - 1 ] ) ? DIRECTORY_SEPARATOR : '';
		foreach ( $extensions as $extension )
		{
			$file  =  $path . $class_name . $extension;
			if ( $e = file_exists( $file ) && $r = is_readable( $file ) )
			{
				require $file;
				return;
			}
			//else{var_dump(@$file,@$e,@$r);}
		}
	}
	//throw new Exception( _( 'class ' . $class_name . ' could not be found.' ) );
	//@NOTE[~imme]: throwing an exception is unwanted
	//	because of the use of class_exists()
	//		which is a proper check to see if a class is loadable and should therefore not throw an exception
	//	or this should throw an exception but then the exception should be catched everytime class_exists() is used
	//		if it would and other autoloaders in the stack do the same, all those exception need to be catched???
}

spl_autoload_register( 'mijn_autoloader' );


