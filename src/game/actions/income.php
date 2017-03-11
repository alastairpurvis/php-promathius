<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

$tabsection = $_GET["tab"];
$pagetype = 'income';

if($tabsection == "taxes"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/income/taxes.php');
}
elseif($tabsection == "treasury"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/income/treasury.php');
}
elseif($tabsection == "help"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	initGUI();
	$wikidirargs = "income";
	include($game_root_path.'/lib/wiki.php');
	$tpl->display('actions/income/help.tpl');
}
elseif(!$tabsection){
	require_once($game_root_path."/header.php");
	$tabsection = "taxes";
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/income/taxes.php');
}
else{
	include($game_root_path.'/error.php');
}

?>