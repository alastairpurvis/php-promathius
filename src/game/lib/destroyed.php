<?
// DESTROYED.PHP
// This script will erase an empire when it has been found destroyed by a user

define('IN_PHPBB', true);
define('PROMATHIUS', true);
$phpbb_root_path = './forum/';  // Must be defined to your board location
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
$userdata = session_pagestart($user_ip, PAGE_LOGIN);
init_userprefs($userdata);

$sql = "SELECT MAX(num) AS total
				FROM ".$config['prefixes'][1]."_dead";

// Give the dead empire an ID
$user_idx = $row['total'] + 1;
$user_idxx = $user_idx + $userdata['empires_owned'];
$user_id_dead = $user_idxx;

// Copy the data from the empire
$empuser = sqlsafeeval("SELECT username FROM ".$config['prefixes'][1]."_players WHERE num='$userdata[user_id]';");
$empname = sqlsafeeval("SELECT empire FROM ".$config['prefixes'][1]."_players WHERE num='$userdata[user_id]';");
$empnamedead = sqlsafeeval("SELECT empire FROM ".$config['prefixes'][1]."_players WHERE num='$userdata[user_id]';");
$emprace = sqlsafeeval("SELECT race FROM ".$config['prefixes'][1]."_players WHERE num='$userdata[user_id]';");
$emploc = sqlsafeeval("SELECT era FROM ".$config['prefixes'][1]."_players WHERE num='$userdata[user_id]';");
$empland = sqlsafeeval("SELECT land FROM ".$config['prefixes'][1]."_players WHERE num='$userdata[user_id]';");
$empnet = sqlsafeeval("SELECT networth FROM ".$config['prefixes'][1]."_players WHERE num='$userdata[user_id]';");
$empkills = sqlsafeeval("SELECT kills FROM ".$config['prefixes'][1]."_players WHERE num='$userdata[user_id]';");
$new_empires_owned = $userdata[empires_owned] + 1;
$new_empires_abandoned = $userdata[empires_abandoned] + 1;

// And paste it into the 'dead' table
mysql_safe_query("INSERT INTO ".$config['prefixes'][1]."_dead (username, num, race, era, disabled, is_empire, land, networth, empire, kills, igname) VALUES
		 ('$empnamedead', '$user_id_dead', '$emprace', '$emploc', '1', '1', '0', '$empnet', '$empname', '$empkills', '$empuser');");

// Safely erase the current empire
mysql_safe_query("DELETE FROM ".$config['prefixes'][1]."_players WHERE num=$userdata[user_id];");

// Check to see if it was safely erased
$empireisdead = sqlsafeeval("SELECT username FROM ".$config['prefixes'][1]."_players where num='$userdata[user_id]';");
if($empireisdead != '')
{
        message_die_ext(GENERAL_ERROR, 'The deletion was unsuccessfull. Please report this to the administrator as a bug.');
}
else
{
		// Update the user statistics
		mysql_safe_query("UPDATE " . USERS_TABLE . " SET empires_owned='$new_empires_owned', empires_abandoned='$new_empires_abandoned', is_empire=0, empire='' WHERE user_id=$userdata[user_id];");
		
		// Update the server statistics
		$abandoned = sqlsafeeval("SELECT abandoned FROM ".$config['prefixes'][1]."_statistics;");
		$abandonednew = $abandoned + 1;
		mysql_safe_query("UPDATE ".$config['prefixes'][1]."_statistics SET abandoned='$abandonednew';");
		
		// Updatate the tomorrow's news headlines
		$headlinedb = "".$config['prefixes'][1]."_news";
		$current_value = sqlsafeeval("SELECT new_value FROM $headlinedb where name='abandoned_empires';") + 1;
		mysql_safe_query("UPDATE $headlinedb SET new_value='$current_value' WHERE name='abandoned_empires';");
}

?>
