<?php 
	if( (isset($_SESSION) && empty($_SESSION))|| !isset($_SESSION))
	{
		header("Location: index.php");
;	}
	//
?>

