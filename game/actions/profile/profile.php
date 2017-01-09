<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

	// User details handling
	$num = $_GET["target"];
	
	if($num)
	{
		fixInputNum($num);
		$enemy = loadUser($num);
		if(!$enemy[signedup])
		{
			initGUI();
			endScript("The profile specified does not exist.");
		}
	}
	else
	{
		initGUI();
		endScript("No profile selected.");
	}

	if ($enemy[profile] == "") $enemy[profile] = "No profile";
	$enemy[profile] = bbcode_parse(trim($enemy[profile]));

	//$enemy[profile] = wordwrap($enemy[profile], 75, "<br />", 1); I wrap when you save so all your smilies are not belong to wrap
//	$enemy[networth] = commas($enemy[networth]);
// We now measure an empire's greatness by its, uh - greatness.
	$enemy[networth] = round((floor($enemy[networth] * 10)) /($config['greatness_roundoff']  ^ 10), $config['greatness_roundoff']);
	if($enemy[land] >= 500)
	{
	$en_land = round($enemy[land]/1000);
	$enemy_land_new = $en_land * 1000;
	}
	else
	{
	$enemy_land_new = "less than 1000";
	}
	$enemy[land] = commas($enemy[land]);
	$race = loadRace($enemy[race], $enemy[region]);
	$era = loadRegion($enemy[region], $enemy[race]);

	$power = determinePower($enemy['troop']);
	$power = $power['string'];
	$wealth = determineWealth(gamefactor($enemy[cash]));

//	if(!$enemy[aim_public]) $enemy[aim] = "Not Public";
//	if(!$enemy[msn_public]) $enemy[msn] = "Not Public";
	if(!$enemy[pub_email]) $enemy[pub_email] = "Not Public";



	if ($enemy[offtotal]) {
	    $offsuccpercent = round($enemy[offsucc]/$enemy[offtotal]*100);
	} else {
	    $offsuccpercent = 0;
	}

	if ($enemy[deftotal]) {
	    $defsuccpercent = round($enemy[defsucc]/$enemy[deftotal]*100);
	} else {
	    $defsuccpercent = 0;
	}

	// Clan Handling


	// Color

		$mclan = loadClan($users[clan]);

		$ccolor = "mnormal";
		if (($enemy[clan] == $mclan[ally1]) || ($enemy[clan] == $mclan[ally2]) || ($enemy[clan] == $mclan[ally3]) || ($enemy[clan] == $mclan[ally4]) || ($enemy[clan] == $mclan[ally5])) {
			$ccolor = "mally";
		} else if (($enemy[clan] == $mclan[war1]) || ($enemy[clan] == $mclan[war2]) || ($enemy[clan] == $mclan[war3]) || ($enemy[clan] == $mclan[war4]) || ($enemy[clan] == $mclan[war5])) {
			$ccolor = "mdead";
		}
		if(!$enemy[clan]) $ccolor="mnormal";

	$ctags = loadClanTags();
	$uclan = loadClan($enemy[clan]);
	if($uclan[name]=="") {
		$uclan[name] = "No Clan";
		$uclan[num] = 0;
	}
	$tags = array($ctags["$uclan[ally1]"], $ctags["$uclan[ally2]"], $ctags["$uclan[ally3]"], $ctags["$uclan[ally4]"], $ctags["$uclan[ally5]"], $ctags["$uclan[war1]"], $ctags["$uclan[war2]"], $ctags["$uclan[war3]"], $ctags["$uclan[war4]"], $ctags["$uclan[war5]"]);
	
	$z = 0;
	while($z<sizeof($tags)) {
		if($tags[$z] == "") $tags[$z] = "None";
		$z++;
	}
	
	// This next section groups all the 'None's so that only the active allies/ enemies are shown
	if($tags[0] == 'None')
	{
		$allies = 'None';
	}
	else if ($tags[1] == 'None')
	{
		$allies = $tags[0];
	}
	else if ($tags[2] == 'None')
	{
		$allies = $tags[0].', '.$tags[1];
	}
	else if ($tags[3] == 'None')
	{
		$allies = $tags[0].', '.$tags[1].', '.$tags[2];
	}
	else if ($tags[4] == 'None')
	{
		$allies = $tags[0].', '.$tags[1].', '.$tags[2].', '.$tags[3];
	}
	else
	{
		$allies = $tags[0].', '.$tags[1].', '.$tags[2].', '.$tags[3].', '.$tags[4];
	}

	if($tags[5] == 'None')
	{
		$enemies = 'None';
	}
	else if ($tags[6] == 'None')
	{
		$enemies = $tags[5];
	}
	else if ($tags[7] == 'None')
	{
		$enemies = $tags[5].', '.$tags[6];
	}
	else if ($tags[8] == 'None')
	{
		$enemies = $tags[5].', '.$tags[6].', '.$tags[7];
	}
	else if ($tags[9] == 'None')
	{
		$enemies = $tags[5].', '.$tags[6].', '.$tags[7].', '.$tags[8];
	}
	else
	{
		$enemies = $tags[5].', '.$tags[6].', '.$tags[7].', '.$tags[8].', '.$tags[9];
	}
	
	$enemy[signedup] = date($dateformat, $enemy[signedup]);
	if ($enemy[startyear] < 0)
{
    $enemy[start_year] = $enemy[startyear] * -1;
    $enemy[year_acronym] = $config['lang']['BCE'];
}
else
{
    $enemy[year_acronym] = $config['lang']['CE'];
}
	
$enemy[maxgreat] = round((floor($enemy[max_greatness] * 10)) /($config['greatness_roundoff']  ^ 10), $config['greatness_roundoff']);
	$eturnsleft = $config[protection] - $enemy[turnsused] + 1;

	// Enable or disable measures of wealth or power
	$enablepower = $config['measures']['Power']['Enabled'];
	$enablewealth = $config['measures']['Wealth']['Enabled'];
	$tpl->assign('enablepower', $enablepower);
	$tpl->assign('enablewealth', $enablepower);
	
	$loggedin = false;
	if($users[num])
		$loggedin = true;
	$tpl->assign('eturnsleft', $eturnsleft);
	$tpl->assign('loggedin', $loggedin);
	$tpl->assign("do_view", "true");
	$tpl->assign("enemy_land_new", $enemy_land_new);
	$tpl->assign("enemy", $enemy);
	$tpl->assign("power_int", $power_int);
	$tpl->assign("power", $power);
	$tpl->assign("wealth", $wealth);
	$tpl->assign("allies", $allies);
	$tpl->assign("enemies", $enemies);
	$tpl->assign("urace", $race);
	$tpl->assign("ccolor", $ccolor);
	$tpl->assign("uera", $era);
	$tpl->assign("clan", $uclan);
	$tpl->assign("off_percent", $offsuccpercent);
	$tpl->assign("def_percent", $defsuccpercent);
	$tpl->assign("tags", $tags);
	$tpl->assign("authstr", $authstr);

$warquery = "SELECT num, empire, land, disabled, clan FROM $playerdb WHERE disabled != 3 ORDER BY rank;";
$warquery_result = @mysql_safe_query($warquery);
while ($wardrop = @mysql_fetch_array($warquery_result)) {
		if (($wardrop[land] > 0) && ($wardrop[num] != 1)) {
				$color = "normal";
				if ($wardrop[num] == $users[num])
					$color = "self";
				elseif ($wardrop[land] == 0)
					$color = "dead";
				elseif ($wardrop[disabled] == 2)
					$color = "admin";
				elseif ($wardrop[disabled] == 3)
					$color = "disabled";
				elseif (($users[clan]) && ($wardrop[clan] == $users[clan]))
					$color = "ally";

		$warquery_array[] = array('num' => $wardrop['num'], 'color' => $color, 'name' => $wardrop['empire']);
	}
}

// Max number of bounties
$max = $config['maxmissions'];

$tpl->assign("maxbounty", $max);
$tpl->assign("selected", $enemy[num]);
$tpl->assign("drop", $warquery_array);
$tpl->assign("users", $users);
$tpl->assign("uera", $uera);
$tpl->assign("eera", $era);
$tpl->assign("erace", $race);
// Load the game graphical user interface
initGUI();
$tpl->display('actions/profile/profile.tpl');

        $search_num = $enemy['num'];
        $search_limit = 4;
        $do_search = true;
        $crier = true;
       // require_once("news.php");

	endScript("");

?>
