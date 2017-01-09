<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
$page="actions/turnuse/explore.tpl";
$type="land";
$button = 'Scout';
$suffix = 'scouting';
$ad = 'For each turn you spend exploring,<br> you can gain roughly <b>'.gimmeLand($users[land],$urace[expl],$users[region], $uera[explb]).'</b> '.plural(gimmeLand($users[land],$urace[expl],$users[region], $uera[explb]), 'acres', 'acre').' of land.';
$actiontype = "explore";		// change this if you rename the file to something different than in taketurns() function

if (isset($_POST['do_use']) && $use_turns != 0) {
	$msg = fn_land(array(	num  => $use_turns,
				hide => $hide_turns)
			);
	$tpl->assign('message', $msg);
}

$tpl->assign('admessage', $ad);
$tpl->assign('turntype', $action);
$tpl->assign('doingwhat', $suffix);
$tpl->assign('buttontext', $button);
include($game_root_path."/lib/error_msg.php");

// Load the game graphical user interface
initGUI();
$tpl->display($page);

endScript('');
?>
