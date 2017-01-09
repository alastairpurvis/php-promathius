<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');

$page="turnuse.tpl";
$button = 'Forage';
$suffix = 'foraging';
$ad = 'For each turn you spend farming, you can obtain about 25% more food.';
$actiontype = $action; // change this if you rename the file to something different than in taketurns() function
$domessage = "Spend how many turns farming?";
$menustat = "farm";
$special = true;
$action = $actiontype;

if (isset($_POST['do_use']) && $use_turns != 0) {
	$msg = fn_forage(array(	num => $use_turns,
				hide => $hide_turns)
		);
	$tpl->assign('message', $msg);
} 

$tpl->assign('admessage', $ad);
$tpl->assign('turntype', $action);
$tpl->assign('doingwhat', $suffix);
$tpl->assign('domessage', $domessage);
$tpl->assign('buttontext', $button);
$tpl->assign('menustat', $menustat);
$tpl->assign('special', $special);
include($game_root_path."/lib/error_msg.php");

// Load the game graphical user interface
initGUI("");
$tpl->display('turnuse.tpl');

endScript('');

?>

