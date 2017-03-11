<?
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
define('IN_PHPBB', true);

require_once ($game_root_path."/funcs.php");
include $game_root_path.'/config.php';

// Retrieve user session from forum
$phpbb_root_path = './forum/'; 
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_LOGIN);
init_userprefs($userdata);

if ($userdata['session_logged_in'])
{
		$users = @mysql_fetch_array(mysql_safe_query("SELECT * FROM ".$config['prefixes'][1]."_players
		 WHERE username='$userdata[username]';"));
		
		// Check to see if the user has an empire. If not, let him create one
		if($userdata[is_empire] == 1)
		{	
			if ($userdata[user_allow_viewonline] == 0)
				$users[hide] = 0;
			else
				$users[hide] = 1;
			saveUserData($users, "hide", true);
			mysql_safe_query("UPDATE ".$config['prefixes'][1]."_players SET loggedin='1' WHERE num=$userdata[empire_id];");
			$tpl->assign('is_empire', $is_empire);
			$tpl->assign('logged_in', 'true');
			$tpl->assign('username', $userdata[username]);
			header("Location: " . $config[sitedir] . $config[main] ."?main");
			exit;
		}
		else if($userdata[is_empire] == 0)
			header("Location: create_empire.php?mode=newplayer");
			exit;
}
else
		header("Location: login.php");
?>
