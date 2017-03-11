<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');

if(!$users[num]) 
{
	$users[clan] = 0;
	$uera = loadRegion(1,1);
	$urace = loadRace(1,1);
	$ctags = loadClanTags();
}

// Load the game graphical user interface
initGUI();
if ($uclan[$item] == 0) 
{
	$selected = " selected";
	$dropdata[] = array('selected' => $selected, 'value' => '0', 'name' => 'None', 'tag' => '');
}

$clannumbers = array();
$count = 0;
$list = mysql_safe_query("SELECT num,name,tag FROM $clandb WHERE members>0;");
while ($clan = @mysql_fetch_array($list)) 
{
	$clannumbers[$count] = $clan[num];
	$count++;
	
	$selected = '';
 if ($clan[num] == $uclan[$item]) 
 {
		$selected = " selected";
	}

	$dropdata[] = array('selected' => $selected, 'value' => $clan[num], 'name' => $clan[name], 'tag' => $clan[tag]);
}

if ((isset($sclan)) && ($sclan > 0)) 
{
	$num = $sclan;
} 
else 
{
	echo "Please select a clan from the form above to see their latest news bulletins.";
	$numrows = @mysql_num_rows($list);
	$rn = rand(0, count($clannumbers)-1);
	
	$num = $clannumbers[$rn];
}

$tclan = loadClan($num);
$tpl->assign('clan', $tclan);
if ($tclan[criernews] == "") 
{
	$tclan[criernews] == "No News";
}
// CRIER NEWS

$contacts = mysql_safe_query("SELECT empire, num FROM $playerdb WHERE num = $tclan[founder] OR num = $tclan[asst] OR num = $tclan[fa1] OR num = $tclan[fa2];");
while ($contact = @mysql_fetch_array($contacts)) 
{
	$ccontacts["$contact[num]"] = $contact[empire];
}
	$tpl->assign('founder', $ccontacts[$tclan[founder]]);
	$tpl->assign('assistant', $ccontacts[$tclan[asst]]);
	$tpl->assign('diplomat1', $ccontacts[$tclan[fa1]]);
	$tpl->assign('diplomat2', $ccontacts[$tclan[fa2]]);


$tpl->assign('criernews', bbcode_parse($tclan[criernews]));

$dbstr = mysql_safe_query("SELECT rank, empire, num, land, networth, clan, race, era, online, disabled, turnsused, vacation, offsucc, offtotal, defsucc, deftotal, kills FROM $playerdb WHERE clan = $tclan[num] ORDER BY rank ASC;");

if ($numrows =@mysql_num_rows($dbstr)) 
{
	while ($stuff = @mysql_fetch_array($dbstr)) 
	{
		global $enemy;
		$enemy = $stuff;
		$tpl->assign('members', printSearchLine('1'));
	}
}

$tpl->assign('drop', $dropdata);
$tpl->display('clancrier.tpl');

// RECENT NEWS
$search_limit = 4;
$search_clan = $tclan['num'];
$crier = true;
require_once("news.php");

?>
