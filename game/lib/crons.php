<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
//global cron stuff
function HowManyTimes($lasttime, $perminutes) {
	global $time;
	if($lasttime == 0)
		return 1;
	return floor(($time-$lasttime)/(60*$perminutes));
}


function newday($name) {
	global $time;
	$oldtime = lasttime($name);
	# This assumes that someone logs on to the game at least once every day
	# That isn't a problem, since if this isn't true, a skipped day won't matter
	return (date('d') != date('d', $oldtime));
}


function lasttime($name) {
	global $crondb;
	$time = time();
	$name = mysql_real_escape_string($name);
	$q = @mysql_safe_query("SELECT time FROM $crondb WHERE name='$name';");
	if(!mysql_num_rows($q)) {
		mysql_safe_query("INSERT INTO $crondb (name, time) VALUES ('$name', $time);");
		return $time;
	} else {
		$a = @mysql_fetch_array($q);
		return $a[0];
	}
}


function justRun($name, $modmins) {
	global $time, $crondb;
	lasttime($name);
	//$last = $time - $time%$modmins;
	$last = $time;
	$name = mysql_real_escape_string($name);
	@mysql_safe_query("UPDATE $crondb SET time=$last WHERE name='$name';");
}

?>
