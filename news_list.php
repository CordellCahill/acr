<?php

//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);


mysql_connect("192.186.253.160", "rclient", "result_client") or die(mysql_error()); 
mysql_select_db("Results") or die(mysql_error()); 



$news_query_string=" select * from news order by timestamp desc limit 6; ";
//echo $news_query_string;
//echo "<br>";
$news_query=mysql_query($news_query_string);
while ( $news_fetch = mysql_fetch_array( $news_query ) )
{
    $image=$news_fetch['image'];
    $link=$news_fetch['link'];
    $series=$news_fetch['series'];
    $timestamp=$news_fetch['timestamp'];
	$timestamp=date('m/d', $timestamp);
    $title=$news_fetch['title'];	

    echo "				<a class=\"news_link\" href=\"#\" id=\"$title\"><img src=\"$image\" class=\"img-responsive\"></a>
						<div class=\"news_link\" class=\"text-muted\"><small>$timestamp  $series</small></div>
						<p>
						<a class=\"news_link\" href=\"#\" id=\"$title\">$title</a>
						</p>
						<hr>	";		
	
}


// echo "	<script type=\'text/javascript\'>
			// $(\".news_link\").click(function(){
				// $(this).attr(\'id\');
				// console.log(\'5\');
				// $(\"#standings\").load(\'show_news.php?title=\'+escape($(this).attr(\'id\')));
			// });
			
		// ";







?>