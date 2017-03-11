<?php
define('IN_PHPBB', true);
define('PROMATHIUS', true);
$phpbb_root_path = './forum/';
include ($phpbb_root_path . 'extension.inc');
include ($phpbb_root_path . 'common.' . $phpEx);
//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_EMPIRE);
init_userprefs($userdata);
//
// End session management
//
if ($userdata['session_logged_in'])
{
	if($userdata['is_empire'] == 1)
	{
	    die ("error");
    	exit;
	}
		
}
else
{
    die ("error");
    exit;
}
$faction_query = ( isset($HTTP_GET_VARS['faction']) ) ? $HTTP_GET_VARS['faction'] : $HTTP_POST_VARS['faction'];
$faction_query = strtolower(htmlspecialchars($faction_query));
$faction = $faction_query;
include("game/config.php");
$race_id = $config['er'][$faction_query];

//////////////////////////
/////////////////////////

function mysql_safe_query($query)
{
    return mysql_query($query);/* SAFE -- root call */
}
init_userprefs($userdata);
if($config['er'][$race_id + 100]['unlock'] <= ($userdata['empires_owned'] - $userdata['empires_abandoned']))
	mysql_safe_query("UPDATE " . USERS_TABLE . " SET tmp_faction='$race_id' WHERE username='$userdata[username]';");
//
// Lets build a page ...
//
include ('data/templates/frames/header.tpl');
if (is_file('data/descriptions/'.$faction . '.tpl')) 
{
	if($config['er'][$race_id + 100]['unlock'] <= ($userdata['empires_owned'] - $userdata['empires_abandoned']))
    	include ('data/descriptions/'.$faction . '.tpl');
	else
		echo "You have not unlocked this faction yet.";
}
else
	echo "<span class='gensmall'>No Description</span>";
include ('data/templates/frames/footer.tpl');

?>