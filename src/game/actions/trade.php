<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

$tabsection = $_GET["tab"];
$pagetype = 'trade';

if($tabsection == "buy"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/trade/buy.php');
}
elseif($tabsection == "sell"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/trade/sell.php');
}
elseif($tabsection == "help"){
	require_once($game_root_path."/header.php");
	$tpl->assign('tabsection', $tabsection);
	initGUI();
	$wikidirargs = "trade";
	include($game_root_path.'/lib/wiki.php');
	$tpl->display('actions/trade/help.tpl');
}
elseif(!$tabsection){
	require_once($game_root_path."/header.php");
	$tabsection = "buy";
	$tpl->assign('tabsection', $tabsection);
	include($game_root_path.'/actions/trade/buy.php');
}
else{
	include($game_root_path.'/error.php');
}

?>