<?php
////////////////////////////////////////////////
// PROM-SCRIPT.PHP
////////////////////////////////////////////////
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

require_once($game_root_path.'/header.php');

function launchScript($path, $variables, $concerns, $args)
{
	// Simplify the variables
	foreach($variables as $variable => $value)
	{
		if(is_array($variables[$variable]))
		{
			foreach($variables[$variable] as $id => $subvalue)
			{
				$name = $variable.'_'.strtoupper($id);
				${$name} = $subvalue;	
			}
		}
		else
		${$variable} = $value;
	}
	unset($variables);

	// Get general variables like the player's cash, faction etc.
	getGeneralScriptVariables();

	// Load & Execute the script
	$scriptstart = "switch ($args){";
	$scriptend = "}";
	$scriptdata = file_get_contents("data/includes/" . $path . ".inc");
	$scriptdata = str_replace("SCRIPT '", "case '", $scriptdata);
	$scriptdata = $scriptstart . str_replace("END;", "break;", $scriptdata) . $scriptend;
	ob_start();
	if(checkScript($scriptdata))
		@eval($scriptdata);
	else
		die("<div style='text-align:center;' class='error-font'><Br>Script error in '$path.inc'<br></center>");
	$output = ob_get_contents();
	ob_end_clean();
	echo $output;

	if($Notification)
	{
		if(is_array($Title))
			$event['Title'] = $Title[array_rand($Title)];
		else
			$event['Title'] = $Title;
		if(is_array($Body))
			$event['Body'] = $Body[array_rand($Body)];
		else
			$event['Body'] = $Body;
	
	$event['Concerns'] = $concerns;
	
		// Move info to newsdb
		addNotificationEvent($event);
	}
	
	return true;
	
}

function getGeneralScriptVariables()
{
	global $users;

	// Player
	define('CASH', gamefactor($users['cash']));
	define('LAND', gamefactor($users['land']));

	// Universal
	define('YEAR', $gameyear);
	define('SEASON', $season);
	define('TIME', $season);
}

function addNotificationEvent($event)
{
	mysql_query("INSERT INTO game_news (title, body, image, concerns) 
	VALUES('". addslashes($event['Title'])."', '". addslashes($event['Body'])."',
	 '". addslashes($event['Image'])."', '".addslashes($event['Concerns'])."' ) ") 
	or die(mysql_error());  

}

function checkScript($code) {
    return @eval('return true;' . $code);
}

// Display news
		// Retrieve array(s)
		$result = mysql_query('SELECT * FROM game_news');
		$newssdb = array();
		
		while($row = mysql_fetch_assoc($result))
		{
			echo "<p>";
			echo "<b>". $row['title'] . "</b>";
			echo "<Br>";
			echo $row['body'];
			echo "</p>";
		}
		

?>