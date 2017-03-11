<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
if(howmanytimes(lasttime('graveyard'), $perminutes)) {
	// update graveyard networths
	$deadmen = mysql_safe_query("SELECT * FROM $playerdb WHERE land=0 AND disabled!=2 AND disabled!=3 AND is_empire != 0;");
	while ($dead = mysql_fetch_array($deadmen)) {
		$dead['networth'] = getGreatness($dead);
		saveUserData($dead, "networth");
		saveUserData(0, "is_empire");
	}
	// update graveyard ranks
	$deadmen2 = mysql_safe_query("SELECT * FROM $playerdb WHERE land=0 AND disabled!=2 AND disabled!=3 ORDER BY networth DESC;");
	$rank = 0;
	while ($dead = mysql_fetch_array($deadmen2)) {
		$rank++;
		$dead[rank] = $rank;
		saveUserData($dead, "rank"); 
	}    
	justRun('graveyard', $perminutes);
}
?>
