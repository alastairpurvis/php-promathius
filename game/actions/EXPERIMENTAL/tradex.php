<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');

$page="turnuse.tpl";
$button = 'Trade';
$suffix = 'trading';
$ad = 'For each turn you spend trading, you can obtain roughly 25% more gold.';
$domessage = "Spend how many turns trading?";
$menustat = "trade";
$special = true;

$actiontype = "trade"; // change this if you rename the file to something different than in taketurns() function

if (isset($_POST['do_use']) && $use_turns != 0) {
	$msg = fn_cash(array(num => $use_turns,
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
