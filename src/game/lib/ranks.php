<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
if(howmanytimes(lasttime('ranks'), $perminutes)) {
	$users = mysql_safe_query("SELECT num FROM $playerdb WHERE disabled != 2 AND disabled !=3 AND land>0 ORDER BY networth DESC;");
	$urank = 0;
	while ($user = mysql_fetch_array($users)) {
		$urank++;
		mysql_safe_query("UPDATE $playerdb SET rank=$urank WHERE num=$user[num];");
	}
	$urank++;
	mysql_safe_query("UPDATE $playerdb SET rank=$urank WHERE disabled=3 OR disabled=2 OR land=0;");
	justRun('ranks', $perminutes);
}
?>
