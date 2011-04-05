<?php
/**
 *  @file Databases.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-04-01
 *  Created: ven 2011-04-01, 10:21.44 CEST
 *  Last modified: mar 2011-04-05, 21:37.11 CEST
**/

class Databases
{
	private $databases;
	public           function __construct ()
	{
	}
	private static function getInstance ()
	{
		static $instance  =  NULL;
		if ( !( $instance instanceof self ) )
			$instance  =  new self();
		return $instance;
	}
	private function getDatabaseProperties ( $class , $method )
	{
		$db  =  array(
			'default' => array(
				'MySQLi' ,
				'localhost' ,
				'brookman' ,
				'bm' ,
				'brookman_db99' ,
			) ,
		);
	}
	public static function get ( $class = NULL , $method = NULL )
	{
		$self  =  self::getInstance();
		$db  =  array(
			'default' => array(
				'MySQLi' ,
				'localhost' ,
				'brookman' ,
				'bm' ,
				'brookman_db99' ,
			) ,
		);
		if ( NULL === $class )
			$db  =  $self->getDatabaseProperties( $class , $method );

		$k  =  key( $db );
		if ( !isset( $self->databases[ $k ] ) )
		{
			$o  =  new ReflectionClass( array_shift( $db[ $k ] ) );
			$self->databases[ $k ]  =  $o->newInstanceArgs( $db[ $k ] );
		}
		return $self->databases[ $k ];
	}
}


