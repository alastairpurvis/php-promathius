<?
// ABANDON.PHP
// This script will erase an empire when a user chooses to abandon it

include 'game/config.php';

// Give the dead empire an ID
$user_idx = $row['total'] + 1;
$user_idxx = $user_idx + $userdata['empires_owned'];
$user_id_dead = $user_idxx;

// Copy the data from the empire
$empuser = sqlsafeeval("SELECT username FROM ".$config['prefixes'][1]."_players WHERE num = '$userdata[empire_id]';");
$empname = sqlsafeeval("SELECT empire FROM ".$config['prefixes'][1]."_players WHERE num = '$userdata[empire_id]';");
$empnamedead = sqlsafeeval("SELECT empire FROM ".$config['prefixes'][1]."_players WHERE num = '$userdata[empire_id]';");
$emprace = sqlsafeeval("SELECT race FROM ".$config['prefixes'][1]."_players WHERE num = '$userdata[empire_id]';");
$emploc = sqlsafeeval("SELECT era FROM ".$config['prefixes'][1]."_players WHERE num = '$userdata[empire_id]';");
$empland = sqlsafeeval("SELECT land FROM ".$config['prefixes'][1]."_players WHERE num = '$userdata[empire_id]';");
$empnet = sqlsafeeval("SELECT networth FROM ".$config['prefixes'][1]."_players WHERE num = '$userdata[empire_id]';");
$empkills = sqlsafeeval("SELECT kills FROM ".$config['prefixes'][1]."_players WHERE num = '$userdata[empire_id]';");
$new_empires_owned = $userdata[empires_owned] + 1;
$new_empires_abandoned = $userdata[empires_abandoned] + 1;
$users_clan = sqlsafeeval("SELECT clan FROM ".$config['prefixes'][1]."_players WHERE num = '$userdata[empire_id]';");

// Safely disable the current empire
if($config['abandontag'] == 1)
	$new_empname = $empname . ' (Abandoned)';
else
	$new_empname = $empname;

$gameyear = sqlsafeeval("SELECT year FROM ".$config['prefixes'][1]."_server;");

mysql_query("UPDATE ".$config['prefixes'][1]."_players SET disabled = 1, is_empire = 0, empire = '$new_empname', username = '".$empuser."_DEAD', IP = '', name = 'DESERTER', loggedin = 0, land = 0, death = 'abandon', destructiondate = $gameyear WHERE num = '$userdata[empire_id]';");


		// Make sure that the user can only create a new empire after 24 hours to avoid flooding/cheating
		$abandon_Delay = $config['abandon_delay'];
		mysql_safe_query("UPDATE " . USERS_TABLE . " SET abandontime = DATE_ADD(NOW(), INTERVAL '$abandon_Delay' HOUR), disable_new = 1  WHERE user_id='$userdata[user_id]';");

		// If the user is a part of a clan, update the clan details
		if($users_clan != '0')
		{
			$clan_members = sqlsafeeval("SELECT members FROM ".$config['prefixes'][1]."_clan WHERE num='$users_clan';");
			$new_clan_members = $clan_members - 1;
			if($new_clan_members == 0)
				$final_clan_members = '-1';
			else
				$final_clan_members = $new_clan_members;

			mysql_safe_query("UPDATE ".$config['prefixes'][1]."_clan SET members = '$final_clan_members'  WHERE num='$users_clan';");
			
			if($userdata['user_id'] == sqlsafeeval("SELECT founder FROM ".$config['prefixes'][1]."_clan WHERE num='$users_clan';"))
				mysql_safe_query("UPDATE ".$config['prefixes'][1]."_clan SET founder = 0  WHERE num='$users_clan';");

			if($userdata['user_id'] == sqlsafeeval("SELECT asst FROM ".$config['prefixes'][1]."_clan WHERE num='$users_clan';"))
				mysql_safe_query("UPDATE ".$config['prefixes'][1]."_clan SET asst = 0  WHERE num='$users_clan';");

			if($userdata['user_id'] == sqlsafeeval("SELECT fa1 FROM ".$config['prefixes'][1]."_clan WHERE num='$users_clan';"))
				mysql_safe_query("UPDATE ".$config['prefixes'][1]."_clan SET fa1 = 0  WHERE num='$users_clan';");

			if($userdata['user_id'] == sqlsafeeval("SELECT fa2 FROM ".$config['prefixes'][1]."_clan WHERE num='$users_clan';"))
				mysql_safe_query("UPDATE ".$config['prefixes'][1]."_clan SET fa2 = 0  WHERE num='$users_clan';");
		}

		mysql_safe_query("DELETE FROM ".$config['prefixes'][1]."_market WHERE seller='$userdata[empire_id]';");
		
		// If the user had missions targetting him, delete them, for he is dead
		$s_num = sqlsafeeval("SELECT s_num FROM ".$config['prefixes'][1]."_bounties WHERE t_num='$userdata[empire_id]';");
		$newbountynum = sqlsafeeval("SELECT num_bounties FROM ".$config['prefixes'][1]."_players WHERE num='$s_num';") - 1;
		mysql_safe_query("UPDATE ".$config['prefixes'][1]."_players SET num_bounties = '$newbountynum'  WHERE num='$s_num';");
		mysql_safe_query("DELETE FROM ".$config['prefixes'][1]."_bounties WHERE t_num='$userdata[empire_id]';");

		// Delete the player's news details (Not used anymore, as IDs are no longer shared
		//	mysql_safe_query("DELETE FROM game_news2 WHERE id1=$userdata[empire_id];");

		// Update the user statistics
		mysql_safe_query("UPDATE " . USERS_TABLE . " SET empires_owned='$new_empires_owned', empires_abandoned='$new_empires_abandoned', is_empire=0, empire='' WHERE user_id=$userdata[user_id];");
		
		// Update the server statistics
		$abandoned = sqlsafeeval("SELECT abandoned FROM game_statistics;");
		$abandonednew = $abandoned + 1;
		mysql_safe_query("UPDATE ".$config['prefixes'][1]."_statistics SET abandoned='$abandonednew';");
		
		// Updatate the tomorrow's news headlines
		$headlinedb = "".$config['prefixes'][1]."_news";
		$current_value = sqlsafeeval("SELECT new_value FROM $headlinedb where name='abandoned_empires';") + 1;
		if(sqlsafeeval("SELECT new_value FROM $headlinedb where name='abandoned_empires';") != 0)
			$updated_strings = (sqlsafeeval("SELECT new_strings FROM $headlinedb where name='abandoned_empires';")).'|'. $userdata['empire'];
		else
			$updated_strings = $userdata['empire'];
		mysql_safe_query("UPDATE $headlinedb SET new_value='$current_value', new_strings='$updated_strings' WHERE name='abandoned_empires';");

?>
