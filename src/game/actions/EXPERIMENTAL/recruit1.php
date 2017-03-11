<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');

$page="turnuse.tpl";
$button = 'Recruit';
$suffix = 'recruiting';
$ad = 'For each turn you spend recruiting, you can train about 25% more soldiers.';
$domessage = "Spend how many turns recruiting?";
$menustat = "recruit";
$actiontype = "recruit";          // change this if you rename the file to something different than in taketurns() function
$special = true;

if (isset($_POST['do_use']) && $use_turns != 0) {
	$msg = fn_ind(array(	num  => $use_turns,
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
if($hasbarracks == 0)
	endScript("You need to construct a ".strtolower($uera[industry])." in order to begin recruitment.");
$tpl->display('turnuse.tpl');

endScript('');
?>
