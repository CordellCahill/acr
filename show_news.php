<?php

//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);


mysql_connect("xxx", "xxx", "xxx") or die(mysql_error()); 
mysql_select_db("Results") or die(mysql_error()); 

$title=$_GET['title'];
//echo $title;

$news_query_string=" select * from news where title='$title'; ";
//cho $news_query_string;

$news_query=mysql_query($news_query_string);
while ( $news_fetch = mysql_fetch_array( $news_query ) )
{
    $news=$news_fetch['news'];
	$news=str_replace("/images", "http://www.formula-simracing.net/images", $news);
	echo "<h3>$title</h3>";
    echo $news;
	$link=$news_fetch['link'];
	echo "<br><br><a href=\"$link\" target=\"_blank\"><font color=\"0013cc\"><b>Click here to go to the original post</b></font></a>";
}







?>
