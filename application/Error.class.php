<?php
/**
 *  @file Error.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-05
 *  Created: sab 2011-03-05, 17:38.25 CET
 *  Last modified: sab 2011-03-05, 17:52.14 CET
**/

class Error
{
	private $logs  =  array();
	public static function log ( $message , $addition = NULL )
	{
		self::instance()->_log( $message , $addition );
	}
	public function _log ( $message , $addition = NULL )
	{
		$this->logs[]  =  array( $message , $addition );
	}
	public function __destruct ()
	{
		echo '<table>'
			. '<tr><th>Message</th>'
			. ( defined( 'DEV' ) ? '<th>Addition</th>' : '' )
			. '</tr>'
		;
		foreach ( $this->logs as $log )
		{
			echo
				  '<tr>'
					. '<td><pre>'
						. $log[0]
					. '</pre></td>'
				. ( defined( 'DEV' )
					?
						  '<td>'
							. $log[1]
						. '</td>'
					: ''
				)
				. '</tr>'
			;
		}
		echo '</table>';
	}

	private          function __clone ()
	{
	}
	private static $instance  =  NULL;
	private static function instance ()
	{
		if ( !( self::$instance instanceof self ) )
			self::$instance  =  new self();
		return self::$instance;
	}
	private          function __construct ()
	{
	}
	public static function __callStatic ( $method , $args = NULL )
	{
		if ( !( self::$instance instanceof self ) )
			self::$instance  =  new self();

		if ( '_log' === $method )
			return call_user_func_array(
				array(
					self::$instance ,
					'_log'
				) ,
				$args
			);

		throw new BadMethodCallException();
	}
}


