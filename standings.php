<?php
	//echo "<pre>";

	// Not the most efficient way to collect, store, and retrieve this data, but I wanted to try something new
	
	
	
    // Defining the basic cURL function
    function curl($url) {
        // Assigning cURL options to an array
        $options = Array(
            CURLOPT_RETURNTRANSFER => TRUE,  // Setting cURL's option to return the webpage data
            CURLOPT_FOLLOWLOCATION => TRUE,  // Setting cURL to follow 'location' HTTP headers
            CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
            CURLOPT_CONNECTTIMEOUT => 120,   // Setting the amount of time (in seconds) before the request times out
            CURLOPT_TIMEOUT => 120,  // Setting the maximum amount of time for cURL to execute queries
            CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
            CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8",  // Setting the useragent
            CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function
        );
         
        $ch = curl_init();  // Initialising cURL 
        curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL 
        return $data;   // Returning the data from the function 
    }
   
    function scrape_between($data, $start, $end){
        $data = stristr($data, $start); // Stripping all data from before $start
        $data = substr($data, strlen($start));  // Stripping $start
        $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
        return $data;   // Returning the scraped data from the function
    }
	
	// Setting urls
	if ( $_GET['series'] == "wc" )
	{
		$scraped_page = curl("http://gpcos.formula-simracing.net/league.php?leagueid=1&type=introduction&menu=season"); 
		$team_prepend="<h3>World Championship Team Standings</h3>";	
		$driver_prepend="<br><h3>World Championship Driver Standings</h3>";
	}
	
	if ( $_GET['series'] == "ace" )
	{
		$scraped_page = curl("http://gpcos.formula-simracing.net/league.php?leagueid=5&type=introduction&menu=season"); 
		$team_prepend="<h3>ACE Team Standings</h3>";	
		$driver_prepend="<br><h3>ACE Driver Standings</h3>";
	}
	
	if ( $_GET['series'] == "pro" )
	{
		$scraped_page = curl("http://gpcos.formula-simracing.net/league.php?leagueid=4&type=introduction&menu=season"); 
		$team_prepend="<h3>PRO Team Standings</h3>";	
		$driver_prepend="<br><h3>PRO Driver Standings</h3>";
	}
	
	
	// Cleaning data
    $team_data = scrape_between($scraped_page, "Current&nbsp;team&nbsp;championship&nbsp;standings:", "</table>");   // Scraping downloaded dara in $scraped_page for content between <title> and </title> tags
    $team_data=str_replace("images/country", "16", $team_data);
    $team_data=str_replace(".gif", ".png", $team_data);
    $team_data=str_replace("team-profile.php", "http://gpcos.formula-simracing.net/team-profile.php", $team_data);
	$team_data=str_replace("Avid Chronic Racing - Blue Team", "<b>Avid Chronic Racing - Blue Team</b>", $team_data);
	$team_data=str_replace("Avid Chronic Racing Team", "<b>Avid Chronic Racing Team</b>", $team_data);
    $team_data=str_replace("Avid Chronic Racing", "<b>Avid Chronic Racing</b>", $team_data);
    
	$driver_data = scrape_between($scraped_page, "Current&nbsp;driver&nbsp;championship&nbsp;standings:", "</table>");   // Scraping downloaded dara in $scraped_page for content between <title> and </title> tags
    $driver_data=str_replace("images/country", "16", $driver_data);
	$driver_data=str_replace(".gif", ".png", $driver_data);
    $driver_data=str_replace("driver-profile.php", "http://gpcos.formula-simracing.net/driver-profile.php", $driver_data);   
    $driver_data=str_replace("images/site/alert.png", "", $driver_data); 
	
	$driver_data=str_replace("Avid Chronic Racing", "<b>Avid Chronic Racing</b>", $driver_data);

	$team_data=utf8_encode($team_data);
	$driver_data=utf8_encode($driver_data);
	
	// Outputting data
	echo "<meta charset=\"UTF-8\">";
	echo $team_prepend;
    echo $team_data;
	echo "</table>";
	echo $driver_prepend;
	echo $driver_data;
    //print_r($scraped_website);
    //echo "<br>goodbye";
?>