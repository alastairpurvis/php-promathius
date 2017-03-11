<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI();
if ($users[clan] == 0)
	endScript("You are not in a clan!");

$tpl_prom = $tpl;

function set_var($var, $value)
{
	global $_GET, $_POST, $HTTP_GET_VARS, $HTTP_POST_VARS;
	$_GET[$var] = $value;
	$_POST[$var] = $value;
	$HTTP_GET_VARS[$var] = $value;
	$HTTP_POST_VARS[$var] = $value;
	global $$var;
	$$var = $value;
} 

set_var('forum', $users[clan]);
if (empty($HTTP_GET_VARS['action']) && empty($HTTP_POST_VARS[action]))
	set_var('action', 'vtopic');

$cookiename=$prefix.'_forum';

$newtime = $time + 200000;
$_COOKIE[$cookiename] = $users[igname].'|'.$users[password].'|'.$newtime;

$indexphp = str_replace("&amp;", "&", "?clanforum$authstr&");

$clForums = array();
$roForums = array();
$poForums = array();
$userRanks = array();
$regUsrForums = array();

$uclan = loadClan($users[clan]);

$mods = array($uclan[founder], $uclan[asst], $uclan[fa1], $uclan[fa2]);

$DB='mysql';

$DBhost=$dbhost;
$DBname=$dbname;
$DBusr=$dbuser;
$DBpwd=$dbpass;

$Tf=$prefix.'_forums';
$Tp=$prefix.'_posts';
$Tt=$prefix.'_topics';
$Tu=$prefix.'_users';
$Ts=$prefix.'_send_mails';
$Tb=$prefix.'_banned';
$Tpq=$prefix.'_poll_questions';
$Tplog=$prefix.'_poll_log';
$Tpd=$prefix.'_poll_data';

$admin_usr=$dbuser;
$admin_pwd=$dbpass;
$admin_email='spam@spam.com';

$bb_admin='bb_admin.php';

include($game_root_path."/clanforums/minibb.php");

$tpl = $tpl_prom;

$users[page] = 'forum';
saveUserData($users, "page");

$clanmembertotal = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE online=0 AND clan='$users[clan]' AND hide='1';");
$forumbrowsetotal = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE online=0 AND clan=$users[clan] AND page='forum' AND hide='1';");

echo "<div align=right style='width: 90%'>";
if($clanmembertotal != 1)
	echo "<b>$clanmembertotal</b> members online, ";
else
	echo "<b>$clanmembertotal</b> member online, ";
if($forumbrowsetotal != 1)
	echo "and <b>$forumbrowsetotal</b> members viewing the forum.";
else
	echo "and <b>$forumbrowsetotal</b> member viewing the forum.";
echo "</div>";
endScript("");

?>
