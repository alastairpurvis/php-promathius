<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
if($hrs = howmanytimes(lasttime('vacation'), 60)) {
	mysql_safe_query("UPDATE $playerdb SET vacation=(vacation+$hrs) WHERE vacation>0;");
	justRun('vacation', 60);
}

if(howmanytimes(lasttime('tidying'), $config['updatetime'])) {
//	# Delete dead people (DISABLED as of Promathius)
//	$delusers = mysql_safe_query("SELECT * FROM $playerdb WHERE
//		(disabled<=1 AND vacation=0 AND land>0 AND idle<($time-86400*7)) OR
//		(land=0 AND disabled=1 AND ip!='0.0.0.0' AND idle<($time-86400*3)) OR
//		(disabled=4)
//			;");
//	while ($users = mysql_fetch_array($delusers)) {
//		// print "Deleting user $users[empire] <a class=proflink href=?profiles&num=$users[num]>(#$users[num])</a>...\n";
//		if ($users[clan]) { // remove user from clan
//			$clan = loadClan($users[clan]);
//			mysql_safe_query("UPDATE $clandb SET members=members-1 WHERE num=$clan[num];");
//		}
//		mysql_safe_query("DELETE FROM $marketdb WHERE seller=$users[num];"); // any of the user's items on the market
//		mysql_safe_query("DELETE FROM $lotterydb WHERE num=$users[num];"); // any lottery tickets
//		$users[name] .= ".DEAD." . $time;
//		$users[username] .= ".DEAD." . $time;
//		$users[password] = md5($users[password]);
//		$users[email] .= ".DEAD." . $time;
//		$users[disabled] = 1;
//		$users[land] = $users[shops] = $users[homes] = $users[industry] = $users[barracks] = $users[labs] = $users[farms] = $users[towers] = $users[freeland] = 0;
	//	$users[ip] = "0.0.0.0";
	//	$users[clan] = 0;
		//$users[idle] = $time;
		// and kill the user
		//$new_empires_owned = sqlsafeeval("SELECT username FROM phpbb_users WHERE empire_id='$users[num]';"); + 1;
		
		//saveUserData($users, "networth name username password email disabled land shops homes industry barracks labs farms towers freeland ip clan idle");
		
		// Update the user statistics
		//mysql_safe_query("UPDATE phpbb_users SET empires_owned='$new_empires_owned', empires_abandoned='$new_empires_abandoned', is_empire=0, empire='' WHERE empire_id=$users[num];");
//	}


	# Set 'em offline after they're idle for 2 turns updates
	mysql_safe_query("UPDATE $playerdb SET online=0,hide=0 WHERE idle<($time-(3600 / $config[updatetime]));");

	# Special players shouldn't idle away
	mysql_safe_query("UPDATE $playerdb SET idle=$time WHERE password='special';");


	justRun('tidying', $config['updatetime']);
}
?>
