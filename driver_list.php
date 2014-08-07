<?php

//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);


mysql_connect("192.186.253.160", "rclient", "result_client") or die(mysql_error()); 
mysql_select_db("Results") or die(mysql_error()); 


$series_array=array("WC", "ACE", "PRO", "Reserve");

foreach ( $series_array as $series )
{
	echo $series;
	$driver_query_string=" select * from drivers where series='$series'; ";
	//echo $driver_query_string;
	$driver_query=mysql_query($driver_query_string);
	while ( $driver_fetch = mysql_fetch_array( $driver_query ) )
	{
		$driver=$driver_fetch['driver'];
		echo "<li><a class=\"driver_link\" href=\"#\" id=\"$driver\">$driver</a></li>";
	}
}


















?>