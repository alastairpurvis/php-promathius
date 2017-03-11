<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

$tabsection = $_GET["tab"];
$enemy['num'] = $_GET["target"];
$tpl->assign('enemy', $enemy);
$pagetype = 'profile';

if($tabsection == "profile"){
	require($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/profile/profile.php');
}
elseif($tabsection == "diplomacy"){
	require($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/profile/diplomacy.php');
}
elseif($tabsection == "help" && $enemy['num']){
	require($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	initGUI();
	$wikidirargs = "profile";
	include($game_root_path.'/lib/wiki.php');
	$tpl->display('actions/profile/help.tpl');
}
elseif(!$tabsection){
	require($game_root_path."/header.php");
	$tabsection = "profile";
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/profile/profile.php');
}
else{
	include($game_root_path.'/error.php');
}

?>