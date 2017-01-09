<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');

$page="turnuse.tpl";
$button = 'Write';
$suffix = 'writing runes';
$ad = 'For each turn you spend writing, you can generate 25% more runes.';
$actiontype = "write";		// change this if you rename the file to something different than in taketurns() function
$domessage = "Spend how many turns writing?";
$menustat = "write";
$special = true;

if (isset($_POST['do_use']) && $use_turns != 0) {
	$msg = fn_rune(array(	num  => $use_turns,
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
if($hasacademy == 0)
	endScript("You need to construct an ".strtolower($uera[labs_single])." in order to begin ".strtolower($uera[runes])." production.");
$tpl->display('turnuse.tpl');

endScript('');
?>
