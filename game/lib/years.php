<?
// YEARS.PHP
// This script updates the game year

// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}


updateGameTime(false);

function updateGameTime($loop){
	
	global $config;
	
	// Consider that the previous update was made, e.g. season goes up
	if($loop){
		$seas = sqlsafeeval("SELECT lastday FROM ".$config['prefixes'][1]."_server;");
		mysql_query("UPDATE ".$config['prefixes'][1]."_server SET lastday = DATE_ADD(".$seas.", INTERVAL ".($config['seasontime']*60)." MINUTE);");
	}
	
	$year = sqlsafeeval("SELECT year FROM ".$config['prefixes'][1]."_server;");
	$season = sqlsafeeval("SELECT season FROM ".$config['prefixes'][1]."_server;");
	
	// Time to update?
	$NextSeason = sqlsafeeval("SELECT lastday FROM ".$config['prefixes'][1]."_server WHERE lastday < NOW();");
	if($NextSeason != '')
	{
		// Last season passed?
		if ($season == $config['seasons'])
		{
			mysql_safe_query("UPDATE ".$config['prefixes'][1]."_server SET season='1';");
			$newyear = $year + 1;
			mysql_safe_query("UPDATE ".$config['prefixes'][1]."_server SET year='$newyear';");
		}
		else
		{
			$newseason = $season + 1;
			mysql_safe_query("UPDATE ".$config['prefixes'][1]."_server SET season='$newseason';");
		}

		mysql_query("UPDATE ".$config['prefixes'][1]."_server SET lastday = DATE_ADD(lastday, INTERVAL ".($config['seasontime']*60)." MINUTE);");
 		if (mysql_error())
           echo mysql_error();
	
	
	$DoLoop = sqlsafeeval("SELECT lastday FROM ".$config['prefixes'][1]."_server WHERE lastday < NOW();");
		if($DoLoop){
			updateGameTime(true);
		}
	}
}
