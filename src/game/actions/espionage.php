<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

$tabsection = $_GET["tab"];
$pagetype = 'espionage';

if($tabsection == "normal"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/espionage/normal.php');
}
elseif($tabsection == "hostile"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/espionage/hostile.php');
}
elseif($tabsection == "help"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	initGUI();
	$wikidirargs = "espionage";
	include($game_root_path.'/lib/wiki.php');
	$tpl->display('actions/espionage/help.tpl');
}
elseif(!$tabsection){
	require_once($game_root_path."/header.php");
	$tabsection = "normal";
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/espionage/normal.php');
}
else{
	include($game_root_path.'/error.php');
}

?>