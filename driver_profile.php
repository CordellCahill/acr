<?php

echo "
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50860231-2', 'ec2-54-203-150-160.us-west-2.compute.amazonaws.com');
  ga('send', 'pageview');

</script>
";



//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);


mysql_connect("192.186.253.160", "rclient", "result_client") or die(mysql_error()); 
mysql_select_db("Results") or die(mysql_error()); 

$driver=$_GET['driver'];

$driver_array=explode(" ", $driver);
$last_name=ucfirst(strtolower($driver_array[1]));
$last_name.=".png";

$src='ACR/FSR/Profiles/'.$last_name;

if (@getimagesize($src))
{
	echo "<img src=\"ACR/FSR/Profiles/$last_name\" class=\"img-responsive\">";
}
else
{
	echo "<h3>$driver</h3>";
}
$driver_query_string=" select * from drivers where driver='$driver'; ";
//echo $driver_query_string;
echo "<br><div class=\"table-responsive\"><table class=\"table table-striped\">";
$driver_query=mysql_query($driver_query_string);
while ( $driver_fetch = mysql_fetch_array( $driver_query ) )
{
    $series=$driver_fetch['series'];
	if ( $series == "WC" )		{ $series="World Championship"; }
	if ( $series )				{ echo "<tr><td><b>Series:</b></td><td>$series</td>"; }
	
	$country=$driver_fetch['country'];
	if ( $country )				{ echo "<tr><td><b>Country:</b></td><td>$country</td>"; }
	
	$email=$driver_fetch['email'];
	if ( $email )				{ echo "<tr><td><b>Email Address:</b></td><td>$email</td>"; }
	
	$birthday=$driver_fetch['birthday'];
	if ( $birthday )			{ echo "<tr><td><b>Birthday:</b></td><td>$birthday</td>"; }
    
}
echo "</table></div>";






















?>