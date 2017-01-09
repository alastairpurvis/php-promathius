<?PHP
/* Clan.php
Handles some clan related functions (currently startup)
*/
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
function mkclan()
{
global $clandb, $prefix, $lockdb, $create_name, $create_tag, $create_pass, $create_flag, $create_url, $create_founder, $time;
if ($lockdb)
			endScript("A clan cannot be creted until the game has begun.");
		if (($create_name == "") || ($create_tag == ""))
			endScript("A clan must have both a name and tag.");
		if (trim($create_tag) == "None")
			endScript("This clan tag is unacceptable.");
		$chk_t = $create_tag;
		sqlQuotes($chk_t);
		if (sqlsafeeval("SELECT COUNT(*) FROM $clandb WHERE tag='$chk_t';"))
			endScript("The clan tag is already registerd to another clan.");

		fixInputNum($create_founder);
		mysql_safe_query("INSERT INTO $clandb (founder) VALUES ($create_founder);");
		$num = mysql_insert_id();
		$uclan = loadClan($num);
		$user =  loadUser($create_founder);
		$user[clan] = $uclan[$num];
		$user[forces] = 0;
		$user[allytime] = $time;
		saveUserData($user, "clan forces allytime");

		$uclan[founder] = $create_founder;
		$uclan[members] = 1;
		$uclan[name] = HTMLEntities(swear_filter(trim($create_name)));
		$uclan[tag] = HTMLEntities(swear_filter(trim($create_tag)));
		$uclan[password] = md5($create_pass);
		$uclan[pic] = $create_flag;
		$uclan[url] = $create_url;
		$uclan[motd] = swear_filter("Welcome to $create_name!");
		saveClanData($uclan,"founder name tag password pic url motd members");
		$ufound = loadUser($create_founder);
		$ufound[clan] = $uclan[num];
		$ufound[allytime] = $time;
		saveUserData($ufound,"clan allytime");
		addNews(110, array(id1=>$create_founder, clan1=>$num));
		// Update new headlines
		$headlinedb = "".$config['prefixes'][1]."_news";
		$current_value = sqlsafeeval("SELECT new_value FROM $headlinedb where name='new_clans';") + 1;
		if(sqlsafeeval("SELECT new_value FROM $headlinedb where name='new_clans';") != 0)
			$updated_strings = (sqlsafeeval("SELECT new_strings FROM $headlinedb where name='new_clans';")).'|'. $uclan[name];
		else
			$updated_strings = $uclan[name];
		mysql_safe_query("UPDATE $headlinedb SET new_value='$current_value', new_strings='$updated_strings' WHERE name='new_clans';");
		$clname = mysql_real_escape_string($uclan[name]);
		mysql_safe_query("INSERT INTO $prefix"."_forums ( `forum_id` , `forum_name` , `forum_desc` , `forum_order` , `forum_icon` , `topics_count`, `posts_count`) 
			VALUES ('$num', '$clname Forums', 'Clan Private Forums', '0', 'default.gif', '0', '0');");
		echo mysql_error();
		endScript("</span><span class='success-font'>$uclan[name] has been successfully created!<br>You are now leader of the clan.</span>");
		}
?>
