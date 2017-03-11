<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

$tabsection = $_GET["tab"];
$pagetype = 'construct';

if($tabsection == "construct"){
	require($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/construct/construct.php');
}
elseif($tabsection == "demolish"){
	require($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/construct/demolish.php');
}
elseif($tabsection == "help"){
	require($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	initGUI();
	$wikidirargs = "construct";
	include($game_root_path.'/lib/wiki.php');
	$tpl->display('actions/construct/help.tpl');
}
elseif(!$tabsection){
	require($game_root_path."/header.php");
	$tabsection = "construct";
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/construct/construct.php');
}
else{
	include($game_root_path.'/error.php');
}

?>