<?php  
	function notification($type,$message)
	{
		\Session::put($type,$message);
	}
?>