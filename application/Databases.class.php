<?php
/**
 *  @file Databases.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-04-01
 *  Created: ven 2011-04-01, 10:21.44 CEST
 *  Last modified: ven 2011-04-01, 10:26.01 CEST
**/

class Databases
{
	private $db;
	public           function __construct ()
	{
		$this->db  =  new MySQLi(
			'localhost' , 'brookman' , 'bm' , 'brookman_db99'
		);
	}
	private static function getInstance ()
	{
		static $instance  =  NULL;
		if ( !( $instance instanceof self ) )
			$instance  =  new self();
		return $instance;
	}
	public static function get ( $class = NULL , $method = NULL )
	{
		$self  =  self::getInstance();
		return $self->db;
	}
}


