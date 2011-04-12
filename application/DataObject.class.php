<?php
/**
 *  @file DataObject.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-31
 *  Created: ĵaŭ 2011-03-31, 22:42.33 CEST
 *  Last modified: mar 2011-04-12, 16:36.37 CEST
**/

class DataObject
{
	protected $controller  =  NULL;
	protected $primary  =  array();
	private $columns  =  array();
	private $name  =  '';

	/**
	 *  Fake array with columns linking to property $columns byt their titles.
	**/
	private $id_columns;

	public           function __construct ( $data = NULL )
	{
		if ( isset( $data ) /* && $data is marked as database-data */ )
		{
			$columns  =  $this->attemptFromDatabase( $data );
			$this->controller( $data . 's' );
			$this->name  =  $data;
		}

		if ( !isset( $columns ) )
			throw new Exception(
				'appropriate columns could not be found'
			);

		$this->columns( $columns , __METHOD__ );
	}
	private function attemptFromDatabase ( $table )
	{
		$db  =  Databases::get( __CLASS__ , __FUNCTION__ );
		$resource  =  $db->query(
			'SHOW FULL COLUMNS FROM '
			. $db->real_escape_string( $table )
		);
		if ( !$resource )
			throw new Exception(
				'unknown table' . (defined('DEV')?', `'.$table.'`':'')
			);

		$columns  =  array();
		while ( $result  =  $resource->fetch_assoc() )
		{
			$column  =  array(
				'title' => $result[ 'Field' ] , // the identifier
				'type'  => $result[ 'Type' ] ,
				'desc'  => $result[ 'Comment' ] ,
				'name'  => $result[ 'Field' ] ,
			);

			$column[ 'desc' ]  =  explode(
				';' ,
				$column[ 'desc' ] ,
				2
			);
			if ( isset( $column[ 'desc' ][0] ) )
				$column[ 'type' ]  =  $column[ 'desc' ][0];
			if ( isset( $column[ 'desc' ][1] ) )
				$column[ 'desc' ]  =  $column[ 'desc' ][1];
			else
				$column[ 'desc' ]  =  $column[ 'name' ];
			
			if ( 'PRI' === $result[ 'Key' ] )
				$this->primary( $result[ 'Field' ] );

			$columns[]  =  $column;
			$this->id_columns[ $column['title'] ]  =&
				$columns[ count( $columns ) - 1 ];
			//vd( $result );
			//vd( $column );
		}

		return $columns;
	}

	public function columns ( $columns = NULL , $secret = NULL )
	{
		if ( NULL === $columns )
		{
			return $this->columns;
		}

		if ( $secret !== 'DataObject::__construct' )
			throw new Exception( 'illegal use of meth.' );

		$this->columns  =  $columns;
	}

	public function controller ( $controller = NULL )
	{
		if ( NULL === $controller )
			return $this->controller;

		$this->controller  =  $controller;
	}
	public function name ()
	{
		return $this->name;
	}


	public function primary ( $primary = NULL )
	{
		if ( NULL !== $primary )
		{
			$this->primary[]  =  $primary;
			return;
		}
		return $this->primary;
	}

	/**
	 *  DEPRECATED
	**/
	public function getColumnValue ( $column_id )
	{
		if ( isset( $this->id_columns[ $column_id ] ) )
			return $this->id_columns[ $column_id ];
		throw new Exception(
			  'column '
			. ( defined( 'DEV' ) ? 'for column_id: `' . $column_id . '` ' : '' )
			. 'does not exist'
		);
	}
}


