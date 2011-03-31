<?php
/**
 *  @file Window.class.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-03-31
 *  Created: ĵaŭ 2011-03-31, 22:19.00 CEST
 *  Last modified: ĵaŭ 2011-03-31, 22:32.09 CEST
**/

class Window
{
	public           function __construct ( $title , $content )
	{
		$this->title    =  $title;
		$this->content  =  $content;
	}
	public function content ()
	{
		return $this->content;
	}
	public function title ()
	{
		return $this->title;
	}
}


