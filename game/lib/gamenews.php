<?
// GAMENEWS.PHP
// This file is specifially for the news tracking system used on the side menu
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
$table = '".$config['prefixes'][1]."_news';
$new_empires = sqlsafeeval("SELECT old_value FROM ".$config['prefixes'][1]."_news where name='new_empires';");
$tpl->assign('new_empires', $new_empires);


?>