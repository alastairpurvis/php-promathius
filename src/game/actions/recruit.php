<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

$tabsection = $_GET["tab"];
$pagetype = 'military';

if($tabsection == "recruit"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/recruit/recruit.php');
}
elseif($tabsection == "disband"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/recruit/disband.php');
}
elseif($tabsection == "help"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	initGUI();
	$wikidirargs = "recruit";
	include($game_root_path.'/lib/wiki.php');
	$tpl->display('actions/recruit/help.tpl');
}
elseif(!$tabsection){
	require_once($game_root_path."/header.php");
	$tabsection = "recruit";
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/recruit/recruit.php');
}
else{
	include($game_root_path.'/error.php');
}

?>