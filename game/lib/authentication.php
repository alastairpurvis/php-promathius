<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
global $users, $urace, $uera, $uclan, $suid, $config;

define('IN_PHPBB', true);
define('PROMATHIUS', true);
$phpbb_root_path = './forum/';// Must be defined to your board location
include ($phpbb_root_path . 'extension.inc');
include ($phpbb_root_path . 'common.' . $phpEx);

$userdata = session_pagestart($user_ip, PAGE_PROMATHIUS);
init_userprefs($userdata);
if ($userdata['session_logged_in'])
{
    $is_empire = $userdata[is_empire];

    if ($is_empire == 1)
    {
		$player_num = sqlsafeeval("SELECT num FROM ".$config['prefixes'][1]."_players WHERE num = '$userdata[empire_id]';");
        $id = $player_num;
        $users = loadUser($id);
        $urace = loadRace($users['race'], $users['region']);
        $uera = loadRegion($users['region'], $users['race']);
        $uclan = loadClan($users[clan]);
			if ($userdata[user_allow_viewonline] == 1)
				$users[hide] = 1;
			else
				$users[hide] = 0;
		saveUserData($users, "hide");
    }
    else
        if ($is_empire == 0)
            header("Location: create_empire.php?mode=newplayer");

    if ($users[disabled] == 2)
    {
        $admin = true;
    }
}
else
    header("Location: login.php");
?>