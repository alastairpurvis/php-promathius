<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
$current_Error = sqlsafeeval("SELECT new_error FROM ".$config['prefixes'][1]."_players where num='$users[num]';");
mysql_query("UPDATE ".$config['prefixes'][1]."_players SET old_error='$current_Error' WHERE username='$userdata[username]';");
mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='' WHERE username='$userdata[username]';");
$tpl->assign('err', $current_Error);
?>