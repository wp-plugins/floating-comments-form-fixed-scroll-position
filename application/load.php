<?php

class FC_Load
{
	function view( $filename, $data = null)
	{
		if( is_array($data) )
		{
			extract( $data );
		}

		include( dirname(__FILE__) . '/views/' . $filename );
	}
}

?>