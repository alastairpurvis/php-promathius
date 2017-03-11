<?
// HEADLINES.PHP
// This file is specifially for the news tracking system used on the side menu
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
// Note that this MySQL table should NEVER be modified manually. If so, the entire system could distort.
$headlinedb = ''.$config['prefixes'][1].'_news';

// Update the news database information every day at 8:00 am
$timer2 = sqlsafeeval("SELECT lastday2 FROM ".$config['prefixes'][1]."_server WHERE lastday2 < NOW();");
if($timer2 != '') 
{
	mysql_query("UPDATE ".$config['prefixes'][1]."_server SET lastday2 = DATE_ADD(NOW(), INTERVAL 24 HOUR);");
	// The current new values will become old values
	mysql_safe_query("UPDATE $headlinedb SET old_value=new_value;");
	mysql_safe_query("UPDATE $headlinedb SET new_value='0';");
	mysql_safe_query("UPDATE $headlinedb SET old_strings=new_strings;");
	mysql_safe_query("UPDATE $headlinedb SET new_strings='';");
}

// Obtain information about new empires in the database. This is fairly simple.
$no_newempires = sqlsafeeval("SELECT old_value FROM $headlinedb where name='new_empires';");
$newempires = sqlsafeeval("SELECT old_strings FROM $headlinedb where name='new_empires';");
$tpl->assign('new_empires', $no_newempires);

// New clans
$no_newclans = sqlsafeeval("SELECT old_value FROM $headlinedb where name='new_clans';");
$newempires = sqlsafeeval("SELECT old_strings FROM $headlinedb where name='new_clans';");
$tpl->assign('new_clans', $no_newclans);

// Destroyed empires
$no_destroyedempires = sqlsafeeval("SELECT old_value FROM $headlinedb where name='destroyed_empires';");
$destroyedempires = sqlsafeeval("SELECT old_strings FROM $headlinedb where name='destroyed_empires';");
$tpl->assign('destroyed_empires', $no_destroyedempires);

// Abandoned empires
$no_abandonedempires = sqlsafeeval("SELECT old_value FROM $headlinedb where name='abandoned_empires';");
$abandonedempires = sqlsafeeval("SELECT old_strings FROM $headlinedb where name='abandoned_empires';");
$tpl->assign('abandoned_empires', $no_abandonedempires);

// Dead emperors
$no_deademperors = sqlsafeeval("SELECT old_value FROM $headlinedb where name='dead_emperors';");
$deademperors = sqlsafeeval("SELECT old_strings FROM $headlinedb where name='dead_emperors';");
$tpl->assign('dead_emperors', $no_deademperors);

// New missions
$no_newmissions = sqlsafeeval("SELECT old_value FROM $headlinedb where name='new_missions';");
$newmissions = sqlsafeeval("SELECT old_strings FROM $headlinedb where name='new_missions';");
$tpl->assign('new_missions', $no_newmissions);


// Richest Empire
// To determine if a new contender has become the richest empire, we will check to see
// how long they have been rich for. If they have only been the richest for a day,
// it means that they are a new no.1
$record_richestempire = sqlsafeeval("SELECT old_value FROM $headlinedb where name='richest_empire';");
$richestempire = sqlsafeeval("SELECT old_strings FROM $headlinedb where name='richest_empire';");
if($record_richestempire == 1)
{
	$tpl->assign('new_richest_empire', 'true');
}

// Most powerful Empire
$record_powerfulempire = sqlsafeeval("SELECT old_value FROM $headlinedb where name='powerful_empire';");
$powerfulempire = sqlsafeeval("SELECT old_strings FROM $headlinedb where name='powerful_empire';");
if($record_powerfulempire == 1)
{
	$tpl->assign('new_powerful_empire', 'true');
}

// Greatest Empire
$record_greatestempire = sqlsafeeval("SELECT old_value FROM $headlinedb where name='greatest_empire';");
$greatestempire = sqlsafeeval("SELECT old_strings FROM $headlinedb where name='greatest_empire';");
if($record_greatestempire == 1)
{
	$tpl->assign('new_greatest_empire', 'true');
}
?>