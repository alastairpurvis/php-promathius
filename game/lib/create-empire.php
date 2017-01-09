<?
// CREATE-EMPIRE.PHP
// This script will basically create the player's empire when they wish to establish it

// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}


// Find the current year
include 'game/lib/years.php';
$current_year = sqlsafeeval("SELECT year FROM ".$config['prefixes'][1]."_server;");
$current_yearcounter = sqlsafeeval("SELECT season FROM ".$config['prefixes'][1]."_server;");

// Determine if the player is an admin
$administrator = 0;
if($userdata['user_rank'] == 1)
{
	$administrator = 2;
}

// Determine the location the player will be put into
$raceid = 100 + $race;
$region = $config['er'][$raceid]['location'];

// Calculate the starting conditions of the picked faction type
$starting_land = $config['er'][$raceid]['starting_land'];
if($starting_land <= 0)
		$starting_land = 1;
$starting_cash = $config['er'][$raceid]['starting_cash'];
$starting_food = $config['er'][$raceid]['starting_food'];
$starting_peasants = $config['er'][$raceid]['starting_population'];
$starting_runes = $config['er'][$raceid]['starting_runes'];
$starting_wizards = $config['er'][$raceid]['starting_agents'];
$starting_troops = $config['er'][$raceid]['troopstart'];
$starting_buildings = $config['er'][$raceid]['structurestart'];
foreach($config['structure'] as $name => $cost)
{
	foreach($starting_buildings as $namestart => $value2)
	{
		if($name == $namestart)
		{
			$total_buildings += ($value2*$config['game_factor'])*$config['er'][101]['structure'.$name.'land'];
		}
	}
}
if($total_buildings > $starting_land)
	die('Settings error: The starting land of this faction cannot support the number of buildings specified.');
$unusedland = $starting_land - $total_buildings;
$taxrate = $config['er'][$raceid]['starting_taxrate'];
$loan = $config['er'][$raceid]['starting_loan'];
$savings = $config['er'][$raceid]['starting_savings'];
$patriotism = $config['er'][$raceid]['starting_patriotism'];
$shame = $config['er'][$raceid]['starting_shame'];
$signup = time();
$initial_turns = $config['initturns'];

foreach($starting_buildings as $item => $value)
{
	$buildstartitem .= ', structure_'.$item;
	$buildstartvalue .= ', '.$value;
}
foreach($starting_troops as $item => $value)
{
	$troopsstartitem .= ', '.$item;
	$troopsstartvalue .= ', '.$value;
}

// This is it. Create my empire, muhahahahaha!
$query = "INSERT INTO ".$config['prefixes'][1]."_players (username,	
rsalt,
name, 	
email, 	
IP, 	
signedup, 	
ismulti, 	
disabled, 	
online, 	
vacation, 	
idle, 	
free, 	
style, 	
empire, 	
num ,	
race 	,
era 	,
rank 	,
clan 	,
forces 	,
allytime ,	
attacks 	,
offsucc 	,
offtotal 	,
defsucc 	,
deftotal 	,
kills 	,
turns 	,
turns_last, 	
hour_last ,	
turnsstored ,	
turnsused 	,
networth 	,
cash 	,
food 	,
peasants ,	
troops 	,
health 	,
wizards ,	
runes 	,
shield 	,
gate 	,
production, 	
land 	,
freeland ,	
tax 	,
savings ,	
loan 	,
pvmarket ,	
pvmarket_last ,	
pmkt_food 	,
bmper 	,
bmper_last, 	
aidcred ,	
aidcred_got ,	
msgcred 	,
msgcred_got ,	
msgtime 	,
newstime 	,
notes 	,
loggedin ,	
hero_war 	,
hero_peace 	,
hero_special ,	
heroes_used 	,
warset 	,
warset_time, 	
peaceset 	,
peaceset_time, 	
profile 	,
igname 	,
stocks 	,
l_attack ,	
num_bounties, 	
hide 	,
condense ,	
atkforstruct, 	
folders 	,
menu_lite 	,
validated 	,
vote 	,
newssort ,	
std_bld 	,
is_empire 	,
startyear 	,
startday 	,
old_error 	,
new_error 	,
death 	,
usernum ,	
lastattackreport, 	
lastturnoutput 	,
lastmagicreport ,	
esptotal 	,
espsucc 	,
sales 	,
page 	,
lastattacktime, 	
attackpenalty ,	
upkeep_penalty 	,
defense_bonus 	,
offense_bonus 	,
equip_level 	,
max_greatness 	,
destructiondate ,	
chk_sendall 	,
nojs_nag 	,
lastturnuse ,	
editor,
region, goodopinion, badopinion $troopsstartitem $buildstartitem)
					VALUES ('$userdata[username]', '', '$userdata[username]', '$userdata[user_email]', '128.95.15.73', $signup, 0, $administrator, 1, 0, $signup, 0, 1, '$username', '$user_id', '$race', '$region', '$user_id', 0, 0, 0, 0, 0, 0, 0, 0, 0, $initial_turns, $signup, $signup, 0, 0, 0, $starting_cash, $starting_food, $starting_peasants, '$starting_troops', 100, $starting_wizards, $starting_runes, 0, 0, '25|25|25|25', $starting_land, $unusedland, $taxrate, $savings, $loan, '8333|4167|2083|1389', 0, 100000, '0|0|0|0', 0, 5, 0, 10, 0, $signup, $signup, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '$userdata[username]',  '1000|1000|1000|1000|1000|1000|1000|1000|1000|1000', 0, 0, 0, 1, 1, 'Inbox|Sent', 0, 1, 0, 0, 0, 1, '$current_year', '$current_yearcounter', '', '', '', '$userdata[user_id]', '', '', '', '', '', '0', '', '', '', '', '', '', '', '0', '', '', '', '', '0', '$selectedregion', $patriotism, $shame $troopsstartvalue $buildstartvalue);";
mysql_safe_query($query);

// We need to make sure that the information was successfully written into the database
$empire_status = sqlsafeeval("SELECT is_empire FROM ".$config['prefixes'][1]."_players where num='$user_id';");
if($raceid == '100')
{
		mysql_safe_query("DELETE FROM ".$config['prefixes'][1]."_players WHERE empire='$username' AND num=$user_id;");
        message_die_ext(GENERAL_ERROR, 'No faction type was selected or the faction type is corrupt.');
}
else if ($empire_status > '0')
{
		// This is just to make it easy to retrieve information about an empire within phpBB
		mysql_safe_query("UPDATE " . USERS_TABLE . " SET empire='$username', empire_id = $user_id WHERE username='$userdata[username]';");
		mysql_safe_query("UPDATE " . USERS_TABLE . " SET is_empire='1' WHERE username='$userdata[username]';");
	
		// Update the navbar
		$template->assign_vars(array('EMPIRE_LINK' =>
	    '<a href="{PATH}../game.php">Begin Rule</a>'));
	    
		// Tell the user that their empire has been sucessfully created
		$time = time();
		$message = $message . 'Your settlement <b>' . str_replace("\\'", "'", $username) .
	    '</b> has been founded.<Br>'.
		'The local peoples eagerly await your arrival.<br /><br /><br />~&nbsp&nbsp<a href="game.php">Begin your rule</a>&nbsp&nbsp~';
	     message_die_ext2(ESTABLISH_MESSAGE, $message);
}
else
{
        message_die_ext(GENERAL_ERROR, 'The creation was unsuccessfull. Have you not already founded your settlement?');
}

?>