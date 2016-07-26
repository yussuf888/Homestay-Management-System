<?php
include('Connections/MyHomeStay_System.php');
if($_REQUEST)
{
	$username 	= $_REQUEST['username'];
	$query = "select * from guest where Guest_Email = '".strtolower($username)."'";
	$results = mysql_query( $query) or die('Available');
	
	if(mysql_num_rows(@$results) > 0) 
		echo '<div id="Error">Email already registered.</div>';
	}
	else
	{
		echo '<div id="Success">Email is available.</div>';
	}
	
}?>