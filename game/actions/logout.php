<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include ($game_root_path."/find-server.php");
include ("server-config.php");
require_once ($game_root_path."/funcs.php");

define('IN_PHPBB', true);
define('PROMATHIUS', true);
$phpbb_root_path = './forum/';// Must be defined to your board location
include ($phpbb_root_path . 'extension.inc');
include ($phpbb_root_path . 'common.' . $phpEx);
$userdata = session_pagestart($user_ip, PAGE_PROMATHIUS);
init_userprefs($userdata);
                mysql_safe_query("UPDATE ".$config['prefixes'][1]."_players SET loggedin='0', online='0' WHERE num=$userdata[empire_id];");
                session_end($userdata['session_id'], $userdata['user_id']);

Header("Location: welcome.php");
?>
