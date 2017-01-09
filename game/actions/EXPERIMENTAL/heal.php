<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');

$page="turnuse.tpl";
$button = 'Heal';
$suffix = 'healing';
$ad = 'For each turn you spend healing, your health goes up 2%. After the tax rate limit, your health goes up only 1% for each turn spent healing. If your health is at 100%, further healing will have no effect, so don\'t heal too much.';
$actiontype = $action;		//' change this if you rename the file to something different than in taketurns() function
$domessage = "Spend how many turns healing?";
$special = false;

if (isset($_POST['do_use'])  && $use_turns != 0) {
	$msg = fn_heal(array(	num  => $use_turns,
				hide => $hide_turns)
			);
	$tpl->assign('heal_result', $msg);
}

$tpl->assign('admessage', $ad);
$tpl->assign('turntype', $action);
$tpl->assign('doingwhat', $suffix);
$tpl->assign('buttontext', $button);
$tpl->assign('domessage', $domessage);
$tpl->assign('menustat', $menustat);
$tpl->assign('special', $special);
include($game_root_path."/lib/error_msg.php");
// Load the game graphical user interface
initGUI();
$tpl->display('turnuse.tpl');

endScript('');
?>
