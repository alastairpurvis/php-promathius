<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

$tabsection = $_GET["tab"];
$pagetype = 'explore';

if($tabsection == "explore"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/turnuse/explore.php');
}
elseif($tabsection == "help"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	initGUI();
	$wikidirargs = "explore";
	include($game_root_path.'/lib/wiki.php');
	$tpl->display('actions/turnuse/help.tpl');
}
elseif(!$tabsection){
	require_once($game_root_path."/header.php");
	$tabsection = "explore";
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/turnuse/explore.php');
}
else{
	include($game_root_path.'/error.php');
}

?>