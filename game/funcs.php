<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
require_once ($game_root_path."/html.php");
require_once ($game_root_path."/lib/mercfuncs.php");
require_once ($game_root_path."/lib/news-funcs.php");
require_once ($game_root_path."/lib/turnuse.php");
require_once ($game_root_path."/includes/SampleParser.php");
require_once ($game_root_path."/lib/crons.php");
require_once ($game_root_path."/lib/status.php");

$hide_fatal_errors = false;

$closed = 0;
$open = 0;

function is_on_vacation(&$user)
{
    global $config;
    return ($user['vacation'] > 0) && ($user['vacation'] < ($config['minvacation'] +
        $config['vacationdelay']));
}

function vac_hours_left(&$user)
{
    global $config;
    return ($config['minvacation'] + $config['vacationdelay'] - $user['vacation']);
}

function doError($error)
{
	global $users, $config;
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript("");
}


// Convert to B.C. or A.D.
function makeDate($date)
{
	global $config;
	if ($date < 0)
	{
	    $date *= -1;
	    $year_acronym = $config['lang']['BCE'];
	}
	else
	    $year_acronym = $config['lang']['CE'];
	
	$date .= ' '.$year_acronym;
	return $date;
}

function determinePower($troop)
{
	global $config;

	$power = 0;
	
	if($troop)
	{
		foreach($troop as $num => $amount) {
			$power += gamefactor($amount);
		}
	}

	for ($m = 1; $m <= $config['measures']['Power']['Number']; $m++)
	{
		$measure = explode(",", $config['measures']['Power'][$m]);
		$measurenext = explode(",", $config['measures']['Power'][$m+1]);
		$measurehighest = explode(",", $config['measures']['Power'][$config['measures']['Power']['Number']]);
		if($measurenext[1] > 0)
		{
			if($power >= $measure[1] && $power < $measurenext[1])
			{
				$npower = $measure[0];
				$m = $config['measures']['Power']['Number'];
			}
		}
		else
				$npower = $measurehighest[0];
	}
	$xpower['value'] = $power;
	$xpower['string'] = $npower;
	
	return $xpower;
}

function determineWealth($wealth)
{
	global $config;

	for ($m = 1; $m <= $config['measures']['Wealth']['Number']; $m++)
	{
		$measure = explode(",", $config['measures']['Wealth'][$m]);
		$measurenext = explode(",", $config['measures']['Wealth'][$m+1]);
		$measurehighest = explode(",", $config['measures']['Wealth'][$config['measures']['Wealth']['Number']]);
		if($measurenext[1] != '')
		{
			if($wealth >= $measure[1] && $wealth < $measurenext[1])
			{
				$nwealth = $measure[0];
				$m = $config['measures']['Wealth']['Number'];
			}
		}
		else
				$nwealth = $measurehighest[0];
	}
	
	return $nwealth;
}

function calculateYear($args)
{
	
}

function gamefactor($num)
{
    global $config;

    return floor($num * $config['game_factor']);
}

function buildingfactor($num)
{
    global $config;

		$factor = $num * $config['game_factor'];
		if((ceil($factor) - $factor) < 750)
			$factor = ceil($factor);
		else
			$factor = floor($factor);

    return $factor;
}

function invfactor($num)
{
    global $config;

    if ($num == 0)
        return 0;

    return floor($num / $config['game_factor']);
}

/* Generate a new nonce */
function rand_nonce($oldval)
{
    $newval = $oldval;
    while ($newval == $oldval)
        $newval = rand(16384, 32768);
    return $newval;
}

/* Just an alias to show what code has been audited for security. */
function mysql_safe_query($query)
{
    return mysql_query($query);/* SAFE -- root call */
}

/* Just an alias to show what code has been audited for security. */
function sqlsafeeval($query)
{
    return sqleval($query);/* SAFE -- root call */
}

function replace($string)
{
    // print("-------" . $string . "----------<br />");
    if (!stristr($string, "&false=1"))
    {
        $string .= "&false=1";
    }
    // print("$string");
    return $string . '"';
}

/**
* Handle minit quotes
*/
function open_tag($string)
{
    global $open;
    // print("open...." . $open);
    $open++;
    if (!empty($string))
        $string = "($string)";
    $replace_with = "<table align='center' width='95%' cellpadding='3' cellspacing='1'><tr><td><b><tt>QUOTE</tt></b> $string </td></tr><tr><td id='QUOTE'><tt>";
    return $replace_with;
}

function close_tag()
{
    global $closed, $open;
    // print("....close..." . $closed);
    if ($closed < $open)
    {
        // print("Needs to close!");
        $replace_with = "</tt></td></tr></table>";
        $closed++;
    }
    return $replace_with;
}

function loadSuid($su)
{
    global $users, $urace, $uera, $uclan, $suid;
    if ($su == 0)
        return;
    $users = loadUser($su);
    if (!$users[num])
        endScript("No empire exists!");
    $suid = $su;
    $urace = loadRace($users['race'], $users['region']);
    $uera = loadRegion($users['region'], $users['race']);
    $uclan = loadClan($users[clan]);
    return true;
}

function makeAuthCode($num, $hash, $su, $srv, $cookie, $rsalt = 0)
{
    global $prefix, $auth, $authcode, $authstr;
    $nhash = md5($hash . $rsalt);
    $authcode = base64_encode("$num\n$nhash\n$su\n$srv");
    if ($cookie)
    {
        setcookie($prefix . '_auth', $authcode);
        $authstr = '';
    }
    else
    {
        $authstr = '&amp;auth=' . $authcode;
        $auth = $authcode;
    }
}

function auth_user($loose = false)
{
    global $prefix, $cookie, $auth, $tpl, $config, $authstr, $authcode, $root, $suid,
        $admin, $usecookie, $action;

    if ($root != 0)
    {
        if ($suid != 0)
            loadSuid($suid);
        else
            loadSuid($root);
        return true;
    }
    if (isset($cookie['auth']))
    {
        $auth = $cookie['auth'];
        $usecookie = true;

    }
    else
        if (isset($_GET['auth']))
        {
            $auth = $_GET['auth'];
            $usecookie = false;

        }
        else
            if ($loose)
            {
                return false;
            }
            else
            {
                header("Location: forum/index.php");
                exit;
            }

    $auth_a = explode("\n", base64_decode($auth));
    $num = $auth_a[0];
    $hash = $auth_a[1];
    $su = $auth_a[2];

    global $users;
    $users = loadUser($num);
    $chash = md5($users[password] . $users[rsalt]);
    if ($chash == $hash)
    {
        if (!$usecookie || stristr($_SERVER['HTTP_REFERER'], substr($config['sitedir'],
            0, -1)))
        {
            $root = $users[num];
            if ($users[disabled] != 2)
            {
                loadSuid($root);
                makeAuthCode($num, $users[password], 0, SERVER, $usecookie, $users[rsalt]);
                return true;
            }
            else
                if ($users[disabled] == 2)
                {
                    $admin = true;
                    $hash = $users[password];
                    $salt = $users[rsalt];
                    if ($su)
                        loadSuid($su);
                    else
                        loadSuid($users[num]);
                    makeAuthCode($num, $hash, $su, SERVER, $usecookie, $salt);
                    return true;
                }
        }
    }
    // I'm on to somethin here...I can feel it
    if ($loose == false)
    {
    	//$session_logged_in = sqlsafeeval("SELECT session_logged_in FROM phpbb_sessions WHERE session_user_id='$userdata[user_id]';");
    	if ($session_logged_in == 1)
		{
			    
		}
		else
		{
			header("Location:welcome.php");
			exit;
		}
		
    }
}

function ban_ip($ip)
{
    //	fixInputNum($ip);
    //	mysql_safe_query("UPDATE $playerdb SET disabled=3 WHERE IP LIKE '$ip';");
    //	mysql_safe_query("INSERT INTO $prefix" . "_banned (banip) VALUES ('$ip');");
}

function swear_filter($str)
{
    //consider carefully: scrap, crass, etc.
    $swear_literals = 'asshole|penis|fuck|shit|dick|cunt|fuk|bitch|bastard|vagina|piss';
    //Retto is corrupting me!111
    $swear_at_beginning = 'crap|sex';
    $swear_separate_word = 'ass|arse|tit';
    $swear_regex = "/( ((\w*)($swear_literals)(\w*)) | ((\b|\A)($swear_at_beginning)(\w*)) | ((\b|\A)($swear_separate_word)(\b|\Z)) )/xi";
    return preg_replace($swear_regex, "*****", $str);
}

function bbcode_parse($str)
{
    global $open, $closed, $config;

    $str = swear_filter($str);

    $mytagparser = &new SampleParser();
    $str = $mytagparser->parseTags($str);

    $str = preg_replace("#\[quote=([^\]]+?)\]#ie", "open_tag('\\1')", $str);
    $str = preg_replace("#\[quote\]#ie", "open_tag('\\1')", $str);
    $str = preg_replace("#\[/quote\]#ie", "close_tag()", $str);
    // printf("closed: $closed open: $open");
    while ($closed < $open)
    {
        // printf("All right...");
        $closed++;
        $str .= "</td></tr></table>";
    }
    $str = preg_replace("#($config[sitedir]\?[^\">]+?)\"#ie", "replace('$1')", $str);
    // $str = preg_replace("#$config[sitedir]#ie", "1", $str);
    $open = 0;
    $closed = 0;

    return $str;
}

function aim_notify($num, $message)
{
}

// adds commas to a number
function commas($str)
{
    return number_format($str, 0, ".", ",");
}

function sqlQuotes(&$str)
{
    $str = mysql_real_escape_string($str);
}

// remove numbers from a string
function remove_numbers($string) 
{
  	$vowels = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", " ");
  	$string = str_replace($vowels, '', $string);
  	return $string;
 }

// remove commas, make integer
function fixInputNum(&$num)
{
    $num = round(str_replace(",", "", $num));
    $num = round(abs($num));
}

// remove commas, make integer
function fixInputNumReturn(&$num)
{
    $num = round(str_replace(",", "", $num));
    $num = round(abs($num));
	return $num;
}
// remove commas, make double
function fixInputDouble(&$num)
{
	global $config;
    $num = round(str_replace(",", ".", $num), $config['greatness_roundoff']);
    $num = round(abs($num),$config['greatness_roundoff']);
}

function fixInputNegativeNum(&$num)
{
    $num = round(str_replace(",", "", $num));
}

// randomize the mt_rand() function
function randomize()
{
    mt_srand((double)microtime() * 1000000);
}
// pluralize a string
function plural($num, $plur, $sing)
{
    if ($num != 1)
        return $plur;
    else
        return $sing;
}
// evaluate an SQL query, return first cell of first row
// useful for "SELECT count(*) ..." queries
function sqleval($query)
{/* SAFE -- root declaration */
    /* Safe because it's up to the caller to do proper checking */
    $data = @mysql_fetch_array(mysql_safe_query($query));
    return $data[0];
}

function returnCNum($amt, $prefix, $nosign, $suffix = '')
{
    $ret = '';
    $pos = "+";
    $neg = "-";
    if ($nosign)
        $neg = $pos = "";
    $ret .= '<span class=';

    if ($amt < 0)
        $ret .= '"cbad">' . $neg . $prefix;
    elseif ($amt > 0)
        $ret .= '"cgood">' . $pos . $prefix;
    else
        $ret .= '"cneutral">';
    $ret .= commas(abs($amt));
    $ret .= $suffix.'</span>';
    return $ret;
}
// prints a number, colored according to its positivity/negativity.
// Set nosign=1 to omit the +/-
function printCNum($amt, $prefix, $nosign)
{
    $pos = "+";
    $neg = "-";
    if ($nosign)
        $neg = $pos = "";

?>
<span class=<?php
    if ($amt < 0)
        print '"cbad">' . $neg . $prefix;
    elseif ($amt > 0)
        print '"cgood">' . $pos . $prefix;
    else
        print '"cneutral">';
    print commas(abs($amt)) . '</span>';
}
// returns the requested networth
function getNetworth(&$user)
{
    global $config;
    $net = 0;

    if ($config['alt_networth'] == 0)
    {//default formula
        foreach ($config[troop] as $num => $mktcost)
        {
            $net += ($user[troop][$num] * $mktcost / $config[troop][0]);
        }
        $net += ($user[wizards] * 2) + ($user[peasants] * 3) + (($user[cash] + $user[
            savings] / 2 - $user[loan] * 2 // stocks
            ) / (5 * $config[troop][0])) + ($user[land] * 500) + ($user[freeland] * 100) + (
            $user[food] * $config[food] / ($config[troop][0] * 3));
    }
    else
    {//alternative formula
        foreach ($config[troop] as $num => $mktcost)
        {
            $net += ($user[troop][$num] * $mktcost / $config[troop][0]);
        }
        $net += ($user[wizards] * 2) + ($user[peasants] * 3);
        $cashn = $user[cash];//needed cash
        $cash = min($user[cash], $cashn) + $user[savings] / 2 - $user[loan] * 2;
        $net += ($cash / (2 * $config[troop][0]));

        $foodn = $user[food];//needed food
        $food = min($user[food], $foodn);
        $net += ($food * $config[food] / $config[troop][0] * 2);

        $net += ($user[land] * 1000) - ($user[freeland] * 500);
    }
    $net = floor($net);
    if ($net > 0)
        return $net;
    else
        return 1;
}
function getGreatness(&$user)
{
    global $config;
    $net = 0;

    if ($config['alt_networth'] == 0)
    {//default formula
        foreach ($config[troop] as $num => $mktcost)
        {
            $net += ($user[troop][$num] * $mktcost / $config[troop][0]);
        }
		// Old Formula
 		//       $net += ($user[wizards] * 2) + ($user[runes]) + ($user[peasants] * 3) + (($user[cash] + $user[
 		//           savings] / 2 - $user[loan] * 2 // stocks
 		//           ) / (5 * $config[troop][0])) + ($user[land] * 500) + ($user[freeland] * 100) + (
 		//           $user[food] * $config[food] / ($config[troop][0] * 3));
		
 		// New Formula
 	       $net += ($user[wizards] * 2) + ($user[runes]) + ($user[peasants] * 3) + (($user[cash] + $user[
 	           savings] / 2 - $user[loan] * 2 // stocks
 	           ) / (5 * $config[troop][0])) + ($user[land] * 120 * (gamefactor($config['buildings'])/2.5)) + ($user[freeland] * 100) + (
 	           $user[food] * $config[food] / ($config[troop][0] * 3));
    }
	$net2 = round($net / $config[greatness]);
    $net = $net / $config[greatness];
	if($net < 0.1)
	{
		$net = 0.1;
	}
	else
	{
		$rating_increase = $net2 - $user[networth];
		$score = (sqlsafeeval("SELECT rating FROM ".$config[forum_prefix]."_users WHERE user_id='$user[usernum]';") + $rating_increase);
		mysql_query("UPDATE ".$config[forum_prefix]."_users SET rating='$score' WHERE user_id='$user[usernum]';");
	//	echo 'Rating Increase: '. $net - $user[networth]. '. NEW RATING: '.$new_rating.$rounded_rating.'. Current Rating: '. sqlsafeeval("SELECT score FROM ".$config[forum_prefix]."_users WHERE user_id='$user[usernum]';");
	}

	// Determine  empire's maximum Greatness (networth)
	if($user[networth] > $user[max_greatness])
	{
		$user[max_greatness] = $user[networth];
		saveUserData($user, 'max_greatness');
	}	
	// Determine  player's maximum Greatness (networth)
	if($user[networth] > sqlsafeeval("SELECT max_greatness FROM ".$config[forum_prefix]."_users WHERE user_id='$user[usernum]';"))
	{
		mysql_query("UPDATE ".$config[forum_prefix]."_users SET max_greatness='$net' WHERE user_id='$user[usernum]';");
	}
    return $net;
}

function pci($user, $race)
{
	global $config;
    if ($user[land] == 0)
        return 0;
	foreach (getBuildings('income', $user) as $id => $structureincome)
	{
		$tradeincomearr[$id] = round(25 * (1 + ($structureincome)*$config['buildingoutput']) / $user[land]) * $race[pci];
		$no += 1;
		$final += $tradeincomearr[$id];
	}
    return $final;
}

function add_column_if_not_exist($db, $column, $column_attr = "VARCHAR( 210 ) NULL" )
{
          $exists = false;
          $columns = mysql_query("show columns from $db");

          while($c = mysql_fetch_assoc($columns))
		  {
              if($c['Field'] == $column)
			  {
                  $exists = true;
                  break;
              }
          }      
          if(!$exists)
		  {
              mysql_query("ALTER TABLE `$db` ADD `$column`  $column_attr");
          }
}

// loads the information for the specified user number
function loadUser($num, $critical = false)
{
    global $config, $playerdb, $time, $turnsper, $perminutes, $structures;
    fixInputNum($num);
	$user = @mysql_fetch_array(mysql_safe_query("SELECT * FROM $playerdb WHERE num=$num;"),MYSQL_ASSOC);
    if (!$user[num])
    {
    	if($critical)
    		endScript("Error: Player does not exist.");
        return;
    }
	for ($i = 1; $i <= 	$config['trooptotal']; $i++)
	{
		$column = 'unit_'.$config['troopindex'][$i];
		$user[troop][$i-1] = $user[$column];
		if($user[troop][$i-1] == ''){
			// SLOW!!
			add_column_if_not_exist($playerdb,$column);
			$user['unit_'.$config['troopindex'][$i]] = 0;
		}
	}
	foreach($structures as $num => $name)
	{
		$column = 'structure_'.$num;
		$user['buildings'][$num] = $user[$column];
		if($user['buildings'][$num] == ''){
			add_column_if_not_exist($playerdb,$column);
			$user['structure_'.$num] = 0;
		}
	}
    $user[ind] = explode("|", $user[production]);
    $user[pmkt] = explode("|", $user[pvmarket]);
    $user[bmper] = explode("|", $user[bmper]);
    foreach ($user[troop] as $num => $amt)
    {
        $user[troop][$num] = intval($amt);
    }
	manageEmployment($user);
    //Turns, Forces, Attack
		$times = floor((($time - $user['turns_last'])) / (60* $perminutes));
    if ($times > 0)
    {
        $user[turns] += $times * $turnsper;
        if ($user[turns] > $config[maxturns])
        {
            //$user[turnsstored] += ($user[turns] - $config[maxturns]);
            $user[turns] = $config[maxturns];
        }
        if ($user[forces] < 11 && $user[forces] > 0)
        {
            $user[forces] -= $times;
            if ($user[forces] < 1)
                $user[forces] = 1;
            fixInputNum($user[forces]);
        }

        $last = $time - $time % (60 * $perminutes);

        fixInputNum($user[turns]);
        fixInputNum($user[turnsstored]);
        fixInputNum($last);
        fixInputNum($user[forces]);
        $q = "UPDATE $playerdb SET turns=$user[turns],turnsstored=$user[turnsstored],turns_last=$last,forces=$user[forces] WHERE num=$user[num];";
        mysql_safe_query($q);
        $str = mysql_error();
        if ($str)
            echo "<b>PLEASE REPORT IMMEDIATELY: '$q': $str</b><br />";
    }

    $times = floor(($time - $user['hour_last']) / 3600);
    if ($times > 0)
    {
        if ($user[attacks] > 0)
        {
            $user[attacks] -= $times;
            if ($user[attacks] < 0)
                $user[attacks] = 0;
        }

        $last = $time - $time % 3600;

        fixInputNum($last);
        fixInputNum($user[attacks]);
        $q = "UPDATE $playerdb SET hour_last=$last,attacks=$user[attacks] WHERE num=$user[num];";
        mysql_safe_query($q);
        $str = mysql_error();
        if ($str)
            echo "<b>PLEASE REPORT IMMEDIATELY: '$q': $str</b><br />";
    }

    return $user;
}

function getRegionID($regiontag)
{
	global $config;
	
	foreach($config['regionarray'] as $va => $name)
	{
		if(strtolower($name) == strtolower($regiontag))
		{
			$regionid = $va;
		}
	}
	return $regionid;
}
// loads the information for the specified race number
function loadRace($race, $regiontag)
{
    global $config;
    $num = 100 * getRegionID($regiontag) + $race;
    $urace = $config['er'][$num];
    $urace['name'] = $urace['rname'];
    $urace['id'] = $race;
    return $urace;
}
// loads the information for the specified era number
function loadEra($era, $race = 1)
{
    global $config;
    $num = 100 * $era + $race;
    $uera = $config['er'][$num];
    $uera['name'] = $uera['ename'];
    $uera['id'] = $era;
    $uera['food'] = $uera['nfood'];
    $uera['cash'] = $uera['ncash'];
    $uera['food_lc'] = strtolower($uera['nfood']);
    $uera['runes'] = $uera['nrunes'];
    $uera['farms'] = $uera['nfarms'];
    $uera['peasantsC'] = $uera['peasants'];
    $uera['peasants'] = strtolower($uera['peasants']);
    $uera['empireC'] = $uera['empire'];
    $uera['empire'] = strtolower($uera['empire']);
    return $uera;
}
// loads the information for the specified era number
function loadRegion($regiontag, $race = 1)
{
    global $config;
    $num = 100 * getRegionID($regiontag) + $race;
    $uera = $config['er'][$num];
    $uera['name'] = $uera['ename'];
    $uera['id'] = $era;
    $uera['food'] = $uera['nfood'];
    $uera['cash'] = $uera['ncash'];
    $uera['food_lc'] = strtolower($uera['nfood']);
    $uera['runes'] = $uera['nrunes'];
    $uera['farms'] = $uera['nfarms'];
    $uera['peasantsC'] = $uera['peasants'];
    $uera['peasants'] = strtolower($uera['peasants']);
    $uera['empireC'] = $uera['empire'];
    $uera['empire'] = strtolower($uera['empire']);
    return $uera;
}
// loads the information for the specified culture type
function loadCulture($race, $era)
{
    global $config;
	$num = 100 * $era + $race;
    $culture = $config['er'][$num]['culture'];
    return $culture;
}
// loads the information for the specified clan number
function loadClan($num)
{
    global $clandb, $perminutes, $playerdb, $time;
    fixInputNum($num);
    $clan = @mysql_fetch_array(mysql_safe_query("SELECT * FROM $clandb WHERE num=$num;"),
        MYSQL_ASSOC);
    if (!$clan[num])
        return;

    $times = floor(($time - $clan['cron_last']) / (60 * $perminutes));
    if ($times > 0)
    {
        # Members
        $clan[members] = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE clan=$clan[num] AND land>0 AND disabled<2;");

        # Delete?
        if ($clan[members] == 0)
        {
            mysql_safe_query("UPDATE $clandb SET ally1=0 WHERE ally1=$clan[num];");
            mysql_safe_query("UPDATE $clandb SET ally2=0 WHERE ally2=$clan[num];");
            mysql_safe_query("UPDATE $clandb SET ally3=0 WHERE ally3=$clan[num];");
            mysql_safe_query("UPDATE $clandb SET ally4=0 WHERE ally4=$clan[num];");
            mysql_safe_query("UPDATE $clandb SET ally5=0 WHERE ally5=$clan[num];");
            mysql_safe_query("UPDATE $clandb SET  war1=0 WHERE  war1=$clan[num];");
            mysql_safe_query("UPDATE $clandb SET  war2=0 WHERE  war2=$clan[num];");
            mysql_safe_query("UPDATE $clandb SET  war3=0 WHERE  war3=$clan[num];");
            mysql_safe_query("UPDATE $clandb SET  war4=0 WHERE  war4=$clan[num];");
            mysql_safe_query("UPDATE $clandb SET  war5=0 WHERE  war5=$clan[num];");
            mysql_safe_query("UPDATE $clandb SET members=-1 WHERE num=$clan[num];");
            return $clan;
        }

        # Founder
        $founder = loadUser($clan[founder]);
        if ($founder[clan] != $clan[num] || empty($founder) || $founder[land] == 0 || $founder
            [disabled] > 1)
        {
            $founder = $clan[founder];
            if ($newf = sqlsafeeval(mysql_safe_query("SELECT asst FROM $clandb WHERE num=$clan[num];")))
                $founder = $newf;
            else
                if ($newf = sqlsafeeval(mysql_safe_query("SELECT fa1 FROM $clandb WHERE num=$clan[num];")))
                    $founder = $newf;
                else
                    if ($newf = sqlsafeeval(mysql_safe_query("SELECT fa2 FROM $clandb WHERE num=$clan[num];")))
                        $founder = $newf;
                    else
                        if ($newf = sqlsafeeval("SELECT num FROM $playerdb WHERE clan=$clan[num] AND land>0 AND disabled!=2 AND disabled!=3 ORDER BY networth DESC;"))
                            $founder = $newf;
            $clan[founder] = $founder;

            $newf = loadUser($newf);
            addNews(116, array(id1 => $newf[num], clan1 => $newf[clan]));
        }

        saveClanData($clan, "members founder");
    }

    return $clan;
}
// Loads all clan tags into an associative array
function loadClanTags()
{
    global $clandb;
    $clans = mysql_safe_query("SELECT num,tag FROM $clandb;");
    while ($clan = mysql_fetch_array($clans))
        $ctags["$clan[num]"] = $clan[tag];
    $ctags["0"] = "None";
    return $ctags;
}

function makeMsg($time, $src, $dst, $body, $title)
{
    global $messagedb;

    fixInputNum($time);
    fixInputNum($src);
    fixInputNum($dst);
    sqlQuotes($body);
    sqlQuotes($title);

    mysql_safe_query("INSERT INTO $messagedb (time,src,dest,msg,title) VALUES ($time, $src, $dst, '$body', '$title');");
}

// Example: saveUserData($users,"cash networth land food etc");
function saveUserData (&$user, $data, $overrideDBlock = false) {
	global $playerdb, $lockdb, $hide_fatal_errors, $action, $users, $config, $structures;
	if ($lockdb && !$overrideDBlock)
		return;

	$items = explode(" ", $data);
	$update = "";
	$i = 0;
	while (isset($items[$i])) {
		$tmp = $items[$i];
		$i += 1;
		if($tmp == 'troops')
		{
			$data = '';
			//$data = implode("|", $user[troop]);
			for ($r = 0; $r <= 	$config['trooptotal']; $r++)
			{
				$units = $user[troop][$r];
				$column = 'unit_'.$config['troopindex'][$r+1];
				$update_unit = "$column=$units";
				mysql_safe_query("UPDATE $playerdb SET $update_unit WHERE num=$user[num];");
			}
		}
		else if($tmp == 'buildings')
		{
			$data = '';
			foreach ($structures as $id => $name)
			{
				$buildings = $user['buildings'][$id];
				$columnb = 'structure_'.$id;
				$update_building = "$columnb=$buildings";
				mysql_safe_query("UPDATE $playerdb SET $update_building WHERE num=$user[num];");
			}
		}
		else if($tmp == 'production')
			$data = implode("|", $user[ind]);
		else if($tmp == 'pvmarket')
			$data = implode("|", $user[pmkt]);
		else if($tmp == 'bmper')
			$data = implode("|", $user[bmper]);
		else if($tmp == 'networth')
			$data = getGreatness($user);
		else
			$data = $user[$tmp];
		if (is_numeric($data)) {
			if ($data < 0 && strtolower($tmp) != 'ip')
				$data = 0;
			$update .= "$tmp=$data";
		} else {
			sqlQuotes($data);
			$update .= "$tmp='$data'";
		} 
		if (isset($items[$i])) $update .= ",";
	} 
	if (!mysql_safe_query("UPDATE $playerdb SET $update WHERE num=$user[num];") && !$hide_fatal_errors)
		die ("Fatal error.");
} 

function HallOfFame($user)
{
    global $nolimitdb;
    sqlQuotes($user[name]);
    sqlQuotes($user[empire]);
    mysql_safe_query("INSERT INTO $nolimitdb (num, name, empire, land, networth, race, location, off, offsucc, def, defsucc, kills) VALUES 
		($user[num], '$user[name]', '$user[empire]', $user[land], $user[networth], $user[race], $user[era], $user[offtotal], $user[offsucc], 
		$user[deftotal], $user[defsucc], $user[kills], $users[esptotal], $users[espsucc]);");
}

// Example: saveClanData($uclan,"name motd ally1 war3");
function saveClanData(&$clan, $data, $overrideDBlock = false)
{
    global $clandb, $lockdb, $hide_fatal_errors;
    if ($lockdb && !$overrideDBlock)
        return;
    $items = explode(" ", $data);
    $update = "";
    $i = 0;
    while ($tmp = $items[$i++])
    {
        $data = $clan[$tmp];
        if (is_numeric($data))
        {
            if ($data < 0)
                $data = 0;
            $update .= "$tmp=$data";
        }
        else
        {
            sqlQuotes($data);
            $update .= "$tmp='$data'";
        }
        if ($items[$i])
            $update .= ",";
    }
    if (!mysql_safe_query("update $clandb set $update where num=$clan[num];") && !$hide_fatal_errors)
        print "FATAL ERROR: Failed to update clan data $update for clan #$clan[num]!<br />\n";
}
// function to return amount of land
function gimmeLand($currland, $bonus, $era, $erabonus)
{
 //   if ($era == 1)
 //       $multip = 1;
 //   elseif ($era == 2)
 //       $multip = 1.4;
 //   elseif ($era == 3)
 //       $multip = 1.8;
 //   else
        $multip = 1;

    return ceil((1 / ($currland * .00022 + .25)) * 20 * $bonus * $erabonus * $multip);
}

function calcSizeBonus($networth)
{
	global $config;
    if ($networth <= (100000 / $config[greatness]))
        $size = 0.524;
    elseif ($networth <= (500000 / $config[greatness]))
        $size = 0.887;
    elseif ($networth <= (1000000 / $config[greatness]))
        $size = 1.145;
    elseif ($networth <= (10000000 / $config[greatness]))
        $size = 1.294;
    elseif ($networth <= (100000000 / $config[greatness]))
        $size = 1.454;
    else
        $size = 1.674;
    return $size;
}
// Take a specified number of turns performing the given action
// Valid actions (so far): cash, land, war; others will be added as necessary
function takeTurns($numturns, $action, $noutput = false, $displayturns = -1)
{
    $losspercent = .97;
    if ($users['hero_special'] == 3) // Hebe?
        $losspercent = .99;

    global $tpl;
    global $config, $time, $turnoutput, $hide_turns, $cnd, $taken, $sendall;
    global $users, $urace, $uera, $landgained, $cashgained, $runesgained, $foodgained,
        $warflag, $oldhealth;
    $taken = 0;
    $turnoutput = "";
    $hideturns = $hide_turns;
    $lackof = 1;

    $cnd = '';
    if ($hide_turns)
    {
        $users['condense'] = 1;
        $cnd = ' checked';
    }
    else
        $users['condense'] = 0;
	
	if($sendall)
	{
		$users['chk_sendall'] = 1;
		$chk_sendall = ' checked';
	}
	else
		$users['chk_sendall'] = 0;

    $tpl->assign('condense', $cnd);

    global $net_income, $net_expenses, $net_wartax, $net_loanpayed, $net_money, $net_foodpro,
        $net_foodcon, $net_food, $net_peasants, $net_wizards, $net_runes, $wizards, $settlers, $emigrants,
        $births;
    global $net_troop;
		global $peasants;
    $runesgained;

    $urace = loadRace($users[race], $users[region]);
	 $uera = loadRegion($users[region], $users[race]);
		
    $oldrunes = $urace[runes];
    $oldind = $urace[ind];
    $olduser = $users;

    if ($numturns > $users[turns])
	{
		// Load the game graphical user interface
initGUI();
        endScript('There are not enough turns availiable.');
	}

    if (($action == 'cash') || ($action == 'land') || ($action == 'farm') || ($action ==
        'runes') || ($action == 'heal') || ($action == 'industry'))
        // Actions which can be aborted
        $nonstop = 1;
    else
        $nonstop = 1;

	
	// New Population calculator
	// CONFIG VARS
	$config['landhomecapacity'] = 1.0;
	$config['birthrate'] = 0.5;
	$config['immigrantincomingrate'] = 1;
	$config['immigrantoutgoingrate'] = 1;
	$config['foodgrowthbonus'] = 15; // Lower is higher

    while ($taken < $numturns)
    {// use up specified number of turns
        $taken++;
        $users[networth] = getGreatness($users);
		$users[realnetworth] = getNetworth($users);
        if ($action == 'land')
        {// exploring?
            $tmp = gimmeLand($users[land], $urace[expl], $users[region], 1);
            $users[land] += $tmp;
            $users[freeland] += $tmp;
            $landgained += $tmp;
        }
        $size = calcSizeBonus($users[networth]);// size bonus/penalty
        $loanrate = $config[loanbase] + $size;// update savings and loan
        $saverate = $config[savebase] - $size;
        $users[loan] *= 1 + ($loanrate / 52 / 100);
        $users[loan] = round($users[loan]);
        if ($users[savings] <= ($users[networth] * $config['maxsave']))
        {
            if ($users[turnsused] > $config[protection])
                // no savings interest while under protection
                $users[savings] *= 1 + ($saverate / 52 / 100);
            $users[savings] = round($users[savings]);
        }
        // money
        $income = calcIncome();
        $expenses = calcExpenses(0);
        $loanpayed = calcLoanPay();
        if ($action == 'cash')
            $income = round(1.25 * $income);
        $money = $income - $expenses;
        $cashgained += $money;
        $users[loan] -= $loanpayed;
        $users[cash] += $money;
		
	 $foodpro = calcFoodPro();
        $foodcon = calcFoodCon();
        $food = $foodpro - $foodcon;

        // update population
      //  $popbaseold = round((($users[land] * 2) + ($users[freeland] * 5) + (getBuildings('homes', $users) *
       //     60 * $config['buildingoutput'])) / (0.95 + $taxrate + $taxpenalty)) * $config['PopValue'];
		// New population growth formula
        $popbase = round(($users[land] * 1.4) + ($users[freeland] * 4) + ($order * 2000 * $config['OrderAffectGrowth']) + ($food * 0.01 * $config['foodgrowthbonus'])) * $config['PopValue'];
		if($popbase < 0)
			$popbase = 0;
//	echo "popbase = " .  $popbase;
		
	if($users['peasants'] <= 0)
	{
		$users['peasants'] = 1;
	}
		
	// Calculate home capacity - landvalue + houses
	$HomeCapacity =   (getBuildings('homes', $users) + $users[land] *0.2 * 	$config['landhomecapacity']);
	//echo "<br>Home capacity = " . $HomeCapacity;
	$HomeSlotsRemaining = $HomeCapacity - $users[peasants];
	if ($HomeSlotsRemaining < 0)
	{
		$HomeSlotsRemaining = 0;
	}
	
//	echo "<br>Home remaining = " . $HomeSlotsRemaining;
	
	$births += $users['births']/1000;
	$settlers += $users['settlers']/1000;
	$emigrants += $users['emigrants']/1000;
	$users['births'] = 0;
	$users['settlers'] = 0;
	$users['emigrants'] = 0;
	
	// Food down   or  up? - birthrate/deathrate    - don't cap by homes I think 
	$foodbreed = gamefactor($food)/$config['foodgrowthbonus']* (rand(40, 90)/100) * (($users['peasants']*$config['PopValue'])/100)*50 * $config['birthrate'];
	$popreproduction = (rand(40, 90)) * (($users['peasants']*$config['PopValue'])/100) * 50 * $config['birthrate'];
	$birthtest = (($foodbread + $popreproduction) * 0.01);
		$births += $birthtest;
			//	echo "<br>Breed = " .  ($foodbreed * 0.01) . " Rep = " .  ($popreproduction * 0.01);
		//echo "<br>Births = " .  $births;

	
	// Enough home slots for immigrants?
	$settlerstest = ($HomeSlotsRemaining / 6) * (rand(20, 90)/100) *$config['immigrantincomingrate'] * 0.1;
		
		$settlers += $settlerstest;
	//	echo "<br>Immigrants= " .  $settlers;
	
	$randomleavers = (((rand(0, 35)/100)/100)) * $users['peasants'] * $config['PopValue']; // Maybe had to leave to help family?
	$emigrants += ((((($users['peasants']*$config['PopValue'])/1000) * $config['immigrantoutgoingrate'] * (rand(20, 90)/100) * (100-$users['health']))  * 10.5) + ($randomleavers));
	//echo "<br>Emigrants = " .  $emigrants;
	//echo "<br>Net = " .  $netpeasants;
	// Lack of pay, unemployment? - emmigrate
       
    // Save decimal points on births, emigrants and settlers
    $users['births'] = ($births - floor($births)) * 1000;
    $users['emigrants'] = ($emigrants - floor($emigrants)) * 1000;
    $users['settlers'] = ($settlers - floor($settlers)) * 1000;
		
        // update food
        $foodpro = calcFoodPro();
        $foodcon = calcFoodCon();
        if ($action == 'farm') // farming?
            $foodpro = round(1.25 * $foodpro);
        $food = $foodpro - $foodcon;
        $users[food] += $food;
        $foodgained += $food;

        // health
    //    if (($users[health] < (100 - (($users[tax] - 10) / 2))) && ($users[health] < 100))
     //       $users[health]++;
        if ($users[health] < 100 && $action == 'heal') // healing?
            $users[health]++;
        if ($users[health] < 100 && $users['hero_special'] == 1) // Asclepius?
            $users[health]++;
        // taxes
        $taxrate = ($users[tax] * $config['TaxGrowthPenalty']) / 100;
        if ($users[tax] > 40)
            $taxpenalty = ($taxrate - 0.40) / 2;
        if ($users[tax] < 20)
            $taxpenalty = ($taxrate - 0.20) / 2;
        // gain magic energy
        $runes = 0;
        if (((getBuildings('runes', $users)*$config['buildingoutput']) / $users[land]) > .15)
            $runes = mt_rand(round((getBuildings('runes', $users)*$config['buildingoutput']) * 1.1), round((getBuildings('runes', $users)*$config['buildingoutput']) * 1.5));
        else
            $runes = round((getBuildings('runes', $users)*$config['buildingoutput']) * 1.1);
        $runes = round($runes * $urace[runes]);
        if ($users['hero_peace'] == 2) // Dionysus?
            $runes *= 1.5;
        if ($action == 'runes') // training?
            $runes *= 1.25;
		$runeproduction = $runes;
        $users[runes] += $runes;
        $runesgained += $runes;

		$real = true;
		$wizards = calcWizards();
		if(!$oldwizards)
			$oldwizards = $users[wizards];
		$newwizards = $users[wizards] + $wizards;
		$net_wizards = gamefactor($newwizards) - gamefactor($oldwizards);

        $users[wizards] += $wizards;
        // save status report
        $urace[runes] = $oldrunes;
        $urace[ind] = $oldind;
        $net_income += $income;
        $net_expenses += $expenses;
        $net_wartax += $wartax;
        $net_loanpayed += $loanpayed;
        $net_money += $money;
        $net_foodpro += $foodpro;
        $net_foodcon += $foodcon;
        $net_food += $food;
       //$net_peasants += $net_peasants;
       // $net_wizards += $wizards;
        $net_runes += $runes;
        foreach ($config[troop] as $num => $mktcost)
        {
            $net_troop[$num] += $troop[$num];
        }

        // ran out of money/food? lose 3% of all units
        if (($users[food] < 0) || ($users[cash] < 0))
        {
            //$users[peasants] = round($users[peasants] * $losspercent);
            $BIRTHS -= ($users[peasants] - round($users[peasants] * $losspercent))/3;
            $emigrants += (($users[peasants] - round($users[peasants] * $losspercent))/3)*2;
            foreach ($users[troop] as $num => $amt)
            {
                $users[troop][$num] = round($amt * $losspercent);
                $milloss -= $amt - round($amt * $losspercent);
            }
            $users[wizards] = round($users[wizards] * $losspercent);
            if ($users[food] < 0)
                $users[food] = 0;
            if ($users[cash] < 0)
                $users[cash] = 0;
            $lackof *= $losspercent;
            
            // launchScript('LACKOFFOOD', '')
        }


        $users[turnsused]++;
        $users[turns]--;

        if ($users[food] <= 0 || $users[cash] <= 0)
        {
            if (!$nonstop)
                break;
        }
    }
    
		$netpeasants += floor($settlers);
	$netpeasants += floor($births);
	$netpeasants -= floor($emigrants);
	$peasants = $netpeasants;
		if(!$oldpeasants)
			$oldpeasants = $users[peasants];
		$newpeasants = $users[peasants] + $peasants;
		$net_peasants = $netpeasants;
        $users[peasants] += $net_peasants;
	 	if($users['peasants'] <= 0)
		{
			$users['peasants'] = 1;
			$net_peasants = $net_peasants + ($users['peasants'] - $net_peasants);
		}
    
 		$births = floor($births);
 		$settlers = floor($settlers);
		$emigrants = floor($emigrants);

    manageEmployment($users);
		$newhealth = calcPublicOrder();
	//$old_orde = $users['health'];
		$new_order = $newhealth - $users['health'];
	echo "Order was: " . $users[health];
	echo "Order is: " . $newhealth;
	
    // print report
    $turnsused = $olduser[turns] - $users[turns];

    if ($users[food] == 0)
    {
                $loss = "lack of food";
    			if ($users[cash] == 0)
                    $loss .= " and pay";
            }
            else
                $loss = 'your inabiliy to pay your empire\'s expenses';

            $percent = round((1 - $losspercent) * 100);//don't cumulate a display thingy
            $lackmessage = '';
            if ($lackof != 1)
            {
                $lackmessage .= '<table width=350><tr><td style="text-align:center"><span class="cbad">'.$percent.'% of the populace and military have revolted against your authority and left due to '.$loss.'.<br />';
        if (!$nonstop)
            $lackmessage .= '</span><br /><span class="error-font">Turns were stopped</span><br /></td></tr></table><br /><br />';
        else
            $lackmessage .= '</span></td></tr></table><br />';
    }


    	if($taken == 1)
    		$turn_string = "Turn";
    	else
    		$turn_string = "Turns";
		
		$turnoutputdata['TurnsString'] = $turn_string;
		$turnoutputdata['TurnsTaken'] = ($displayturns == -1 ? $taken : $displayturns);
		$turnoutputdata['NetIncome'] = gamefactor($net_income);
		$turnoutputdata['NetExpenses'] = gamefactor($net_expenses);
		$turnoutputdata['LoanPay'] = gamefactor($net_loanpayed);
		$turnoutputdata['NetMoney'] = returnCNum(gamefactor($net_money), "", 0);	
		$turnoutputdata['FoodPro'] = gamefactor($net_foodpro);	
		$turnoutputdata['FoodCon'] = gamefactor($net_foodcon);	
		$turnoutputdata['NetFood'] = returnCNum(gamefactor($net_food), "", 0);	
		$turnoutputdata['Births'] = $births;
		$turnoutputdata['Settlers'] = $settlers; 
		$turnoutputdata['Emigrants'] = $emigrants; 
		$turnoutputdata['NetPopulation'] = returnCNum($net_peasants, "", 0);	
		$turnoutputdata['NetWizards'] = returnCNum($net_wizards, "", 0);	
		$turnoutputdata['NetRunes'] = returnCNum(gamefactor($net_runes), "", 0);	
		$turnoutputdata['NetOrder'] = returnCNum($new_order, "", 0, '%');	
		$turnoutputdata['NetMilitaryRaw'] = gamefactor($milloss);
		$turnoutputdata['NetMilitary'] = returnCNum(gamefactor($milloss), "", 0);
		$turnoutputdata['Type'] = $action;
		
		if($users[tax] < 15)
			$taxmsg = '<span class="cgood">The low tax rate is encouraging population growth.</span>';
		if($users[tax] > 50)
			$taxmsg = '<span class="cbad">The high tax rate is encouraging unrest.</span>';
		$turnoutputdata['TaxMessage'] = $taxmsg;	
		
		
		$tpl->assign('turndata', $turnoutputdata);
        $turnoutput = '<div id="turnbox" style="height: 230px; width: 100%; text-align:center"><script type="text/javascript">	var Turnbox=new animatedcollapse("turnbox", 700, false, false);openTurnWindow()</script><table align=center>
			<tr class="inputtable"><th colspan="3" valign="top" align="middle">
			<Center><b>' . ($displayturns == -1 ? $taken : $displayturns) .
            ' '.$turn_string.' Used</b></th></tr>
			<tr><td style="vertical-align:top"><table class=font>
		    <tr class="inputtable"><th colspan="2">Economy</th></tr>
		    <tr><th>Income:</th>
		        <td>$' . commas(gamefactor($net_income)) . '</td></tr>
		    <tr><th>Expenses:</th>
		        <td>$' . commas(gamefactor($net_expenses)) . '</td>';
			if ($warflag)
			$turnoutput .= '<tr><th>War Tax:</th>
			        <td>$' . commas(gamefactor($wartax)) . '</td></tr>';
			$turnoutput .= '<tr><th>Loan Pay:</th>
		        <td>$' . commas(gamefactor($net_loanpayed)) . '</td></tr>
		    <tr><th>Net:</th>
		        <td>' . returnCNum(gamefactor($net_money), "$", 0) . '</td></tr>
		    </table></td>
		    <td style="vertical-align:top"><table class=font>
		    <tr class="inputtable"><th colspan="2">Agriculture</th></tr>
		    <tr><th>Produced:</th>
		        <td>' . commas(gamefactor($net_foodpro)) . '</td></tr>
		    <tr><th>Consumed:</th>
		        <td>' . commas(gamefactor($net_foodcon)) . '</td></tr>
		    <tr><th>Net:</th>
		        <td>' . returnCNum(gamefactor($net_food), "", 0) . '</th></tr>
		    </table></td>
		    <td style="vertical-align:top"><table class=font>
		    <tr class="inputtable"><th colspan="2">Population & Military</th></tr>
		    <tr><th>' . 'Population' . ':</th>
		        <td>' . returnCNum($net_peasants, "", 0) . '</td></tr>
		    <tr><th>' . $uera[wizards] . ':</th>
		        <td>' . returnCNum($net_wizards, "", 0) . '</td></tr>
		    <tr><th>' . $uera[runes] . ':</th>
		        <td>' . returnCNum(gamefactor($net_runes), "", 0) . '</td></tr>';
		if($users[tax] < 15)
			$taxmsg = '<span class="cgood">The low tax rate is encouraging population growth.</span>';
		if($users[tax] > 50)
			$taxmsg = '<span class="cbad">The high tax rate is encouraging unrest.</span>';
        $turnoutput .= '
		    </table></td></tr>
			<tr><td colspan="3" style="text-align:center">'.$taxmsg.'</td></tr>
			<tr><td colspan="3" style="text-align:center">'.$indlackmsg.'</td></tr>
		        <tr><td colspan="3" style="text-align: center"><br />' . $lackmessage .
            '</td></tr>
			</table>';

    // end print report
    saveUserData($users,
        "buildings networth land freeland savings loan cash troops food health peasants births emigrants settlers runes wizards turnsused turns idle condense chk_sendall");
    if ($tpl)
        $tpl->assign('turnoutput', $turnoutput);

    if ($config['nolimit_mode'])
    {
        if ($users[turns] == 0)
        {
            //bye bye my friend
            $users[password] = 'locked';
            saveUserData($users, "password");
            HallOfFame($users);
        }
    }

    return $taken;
}

function printSearchHeader($color, $clan = true)
{
    global $uera, $config;

?>
<tr class="era<?= $color ?>" style="font-size:9px">
    <th style="width:5%" class="aright" style="font-size:9px">Rank</th>
    <th style="width:25%" style="font-size:9px"><?= $uera[empireC] ?></th>
    <th style="width:15%" class="aright" style="font-size:9px"><?=$config['lang']['greatness']?></th>
    <th style="width:18%" style="font-size:9px">Location</th><?php if ($clan)
    { ?>
    <th style="width:10%" style="font-size:9px">Clan</th>
<?php } ?>
<?php
}

function printSearchLine($return, $clan = true, $era = true)
{
    global $users, $enemy, $ctags, $rtags, $etags, $racedb, $eradb, $config, $authstr;
    $color = "normal";
    $mclan = loadClan($users[num]);

    if ($enemy[num] == $users[num])
        $color = "self";
    elseif ($enemy[land] == 0)
        $color = "dead";
    elseif ($enemy[disabled] == 2)
        $color = "admin";
    elseif ($enemy[disabled] == 3)
        $color = "disabled";
    elseif (($enemy[turnsused] <= $config[protection]) || ($enemy[vacation] > $config
        [vacationdelay]))
        $color = "protected";
    elseif (($users[clan]) && ($enemy[clan] == $users[clan]))
        $color = "ally";
    $captdet = loadClan($enemy[clan]);
    $leader = "";
    if ($captdet[founder] == $enemy[num])
        $leader = "*";

    $ccolor = "mnormal";
    if (($enemy[clan] == $mclan[ally1]) || ($enemy[clan] == $mclan[ally2]) || ($enemy
        [clan] == $mclan[ally3]) || ($enemy[clan] == $mclan[ally4]) || ($enemy[clan] ==
        $mclan[ally5]))
    {
        $ccolor = "mally";
    }
    else
        if (($enemy[clan] == $mclan[war1]) || ($enemy[clan] == $mclan[war2]) || ($enemy
            [clan] == $mclan[war3]) || ($enemy[clan] == $mclan[war4]) || ($enemy[clan] == $mclan
            [war5]))
        {
            $ccolor = "mdead";
        }

    if ($enemy[clan])
        $clname = "$leader<a class=\"$ccolor\" href=\"?clancrier&amp;sclan=$enemy[clan]$authstr\">" .
            $ctags["$enemy[clan]"] . "</a>$leader";
    else
        $clname = 'None';
	
	$row = '';
	$row .= '<tr class="m'.$color.'"><td class="aright">';

	 if ($enemy[online])
        $row .= "*";
	
	$row .= $enemy[rank] . '</td><td class="acenter" style="font-size:9px"><a class=proflink href="?profile&target='.$enemy
[num].'">'.$enemy[empire].'</a></td><td class="aright" style="font-size:9px">'.round((floor($enemy[networth] * 10)) /($config['greatness_roundoff']  ^ 10), $config['greatness_roundoff']).'</td>';
	if ($era)
    { 
    	$row .= '<td class="acenter" style="font-size:9px">'.$etags[$enemy[region]].'</td>';
	}
	if ($clan)
    {
        $row .= '<td class="acenter" style="font-size:9px">'.$clname.'</td>';
    }
	if ($return == 1)
		return $row;
	else
		echo $row;
}

function printMainStats($user, $race, $era, $esp = false, $other = null)
{
    global $config, $authstr, $playerdb, $users;

    $land = sqlsafeeval("SELECT SUM(land) FROM $playerdb WHERE turnsused>$config[protection] AND disabled != 2 AND disabled != 3;");
    $count = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE turnsused>$config[protection] AND disabled != 2 AND disabled != 3;");

    if ($count == 0)
        $avg = 0;
    else
        $avg = $land / $count;

    $succpoint = 5;
    $failpoint = 2;
    $offexp = (($users[offsucc] * $succpoint) + (($users[offtotal] - $users[offsucc]) *
        $failpoint)) / (1000 * $succpoint);
    $defexp = (($users[defsucc] * $succpoint) + (($users[deftotal] - $users[defsucc]) *
        $failpoint)) / (1000 * $succpoint);

    $experience = floor($offexp * 1000) + floor($defexp * 1000);

    if ($users[land] < $avg)
        $land_color = "cnormal";
    if ($users[land] > $avg)
        $land_color = "cgood";
    if ($users[rank] < 11)
        $rank_color = "cgood";
    else
        $rank_color = "cnormal";
    if ($users[health] > 74)
        $health_color = "cgood";
    if ($users[health] < 51)
        $health_color = "cwarn";
    if ($users[health] < 26)
        $health_color = "cbad";

?>
<table style="width:75%">
<tr class="era<?= $user[era] ?>"><th colspan="3" align=center>
<?=$user['empire']?></th></tr>
<span style="font-size: 10px">
    <tr><td valign="top" style="width:40%">
    <table style="width:100%" style="font-size: 10px">
 <!--       <tr><th>Turns</th><?php  ?><td><?= $user[turns] ?> (max <?= $config[
maxturns] ?>)</td></tr> -->
        <tr><th>Health</th><?php  ?><td><?= $user[health] ?>%</td></tr>
                <tr><th>Tax Rate</th><?php  ?><td><?= $user[tax] ?>%</td></tr>
        <tr><th>Population</th><?php  ?><td><?= commas($user[peasants]) ?></td></tr>
<!--        <tr><th>Land Acres</th><?php  ?><td><span class="<?= $land_color ?>"><?= commas
($user[land]) ?></span></td></tr> -->
<!--        <tr><th>Networth</th><?php  ?><td>$<?= round((floor($user[networth] * 10)) /($config['greatness_roundoff']  ^ 10), $config['greatness_roundoff']) ?></td></tr> -->
        <tr><th>Experience</th><?php  ?><td><?= commas($experience) ?></td></tr>
       <tr><th><?= $era[cash] ?></th><?php  ?><td><?= commas(gamefactor($user[
cash])) ?></td></tr> 
       <tr><th><?= $era[food] ?></th><?php  ?><td><?= commas(gamefactor($user[
food])) ?></td></tr> 
        <tr><th><?= $era[runes] ?></th><?php  ?><td><?= commas(gamefactor($user[
runes])) ?></td></tr>
    </table></td>
    <td style="width:20%"></td>
    <td style="width:40%">
    <table style="width:100%" style="font-size: 10px">
<?
    foreach ($config[troop] as $num => $mktcost)
    {
        echo '<tr><th>' . $era["troop$num"] . '</th><td>' . commas(gamefactor($user[
            troop][$num])) . '</td></tr>';
    }
?>
        <tr><th><?= $era[wizards] ?></th><?php  ?><td><?= commas(gamefactor($user[
wizards])) ?></td></tr>
    </table>
	<?php if ($esp)
    {
        global $spratio, $spfuncs, $spname, $sptype, $uratio, $eratio;
        $enemy = $user;
        $users = $other;
        $erace = loadRace($enemy[race], $enemy[region]);
        $urace = loadRace($users[race], $users[region]);
        getRatios();
//        echo '<tr><td colspan="3" style="text-align: center">';
//        echo $config['missionspy'];
//        foreach ($spratio as $id => $sratio)
//        {
//            if ($id == 1)
//                continue;
//            if ($sptype[$id] != 'o')
//                continue;
//            if ($spfuncs[$id] == 'missionfight')
//                $sratio = 2.2;
//            if ($uratio > $eratio * $sratio)
//                echo ', ' . $spname[$id];
//        }
        echo '</td></tr>';
    } ?>
</td></tr>
</table>
<?php
}

function printMainStats_tpl($user, $race, $era, $esp = false, $other = null)
{
    global $config, $authstr, $playerdb, $users;

    $land = sqlsafeeval("SELECT SUM(land) FROM $playerdb WHERE turnsused>$config[protection] AND disabled != 2 AND disabled != 3;");
    $count = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE turnsused>$config[protection] AND disabled != 2 AND disabled != 3;");

    if ($count == 0)
        $avg = 0;
    else
        $avg = $land / $count;

    $succpoint = 5;
    $failpoint = 2;
    $offexp = (($users[offsucc] * $succpoint) + (($users[offtotal] - $users[offsucc]) *
        $failpoint)) / (1000 * $succpoint);
    $defexp = (($users[defsucc] * $succpoint) + (($users[deftotal] - $users[defsucc]) *
        $failpoint)) / (1000 * $succpoint);

    $experience = floor($offexp * 1000) + floor($defexp * 1000);

    if ($users[land] < $avg)
        $land_color = "cnormal";
    if ($users[land] > $avg)
        $land_color = "cgood";
    if ($users[rank] < 11)
        $rank_color = "cgood";
    else
        $rank_color = "cnormal";
    if ($users[health] > 74)
        $health_color = "cgood";
    if ($users[health] < 51)
        $health_color = "cwarn";
    if ($users[health] < 26)
        $health_color = "cbad";

    $possible_spells = "";
    if ($esp)
    {
        global $spratio, $spfuncs, $spname, $sptype, $uratio, $eratio;
        $enemy = $user;
        $users = $other;
        $erace = loadRace($enemy[race], $enemy[region]);
        $urace = loadRace($users[race], $users[region]);
        getRatios();
        $possible_spells .= $config['missionspy'];
        foreach ($spratio as $id => $sratio)
        {
            if ($id == 1)
                continue;
            if ($sptype[$id] != 'o')
                continue;
            if ($spfuncs[$id] == 'missionfight')
                $sratio = 2.2;
            if ($uratio > $eratio * $sratio)
                $possible_spells .= ', ' . $spname[$id];
        }
    }

    $usertrps = array();
    foreach ($config[troop] as $num => $mktcost)
        $usertrps[] = array('name' => $era["troop$num"], 'amt' => $user[troop][$num]);
    $user['expdisp'] = $experience;
    $tpl->assign('showmainstats', true);
    $tpl->assign('config', $config);
    $tpl->assign('user', $user);
    $tpl->assign('era', $era);
    $tpl->assign('race', $race);
    $tpl->assign('rank_color', $rank_color);
    $tpl->assign('land_color', $land_color);
    $tpl->assign('health_color', $health_color);
    $tpl->assign('usertrps', $usertrps);
    $tpl->assign('esp', $esp);
    $tpl->assign('possible_spells', $possible_spells);
}

function numNewMessages()
{
    global $messagedb, $users;
    return sqlsafeeval("SELECT COUNT(*) FROM $messagedb WHERE dest=$users[num] AND readd=0 AND deleted=0;");
}
function numTotalMessages()
{
    global $messagedb, $users;
    return sqlsafeeval("SELECT COUNT(*) FROM $messagedb WHERE dest=$users[num] AND deleted=0;");
}

function addNews($code, $args, $overrideDBlock = false, $settime = -1)
{
    global $newsdb, $playerdb, $lockdb, $time, $perminutes;

    if ($lockdb && !$overrideDBlock)
        return;

    if ($settime != -1)
        $time = $settime;

    $id1 = $args[id1];
    fixInputNegativeNum($id1);
    $clan1 = $args[clan1];
    fixInputNegativeNum($clan1);
    $land1 = $args[land1];
    fixInputNegativeNum($land1);
    $cash1 = $args[cash1];
    fixInputNegativeNum($cash1);
    $wizards1 = $args[wizards1];
    fixInputNegativeNum($wizards1);
    $food1 = $args[food1];
    fixInputNegativeNum($food1);
    $runes1 = $args[runes1];
    fixInputNegativeNum($runes1);
    $id2 = $args[id2];
    fixInputNegativeNum($id2);
    $clan2 = $args[clan2];
    fixInputNegativeNum($clan2);
    $land2 = $args[land2];
    fixInputNegativeNum($land2);
    $cash2 = $args[cash2];
    fixInputNegativeNum($cash2);
    $wizards2 = $args[wizards2];
    fixInputNegativeNum($wizards2);
    $food2 = $args[food2];
    fixInputNegativeNum($food2);
    $runes2 = $args[runes2];
    fixInputNegativeNum($runes2);
    $id3 = $args[id3];
    fixInputNegativeNum($id3);
    $clan3 = $args[clan3];
    fixInputNegativeNum($clan3);
    $shielded = $args[shielded];
    fixInputNegativeNum($shielded);

    $troops1 = explode('|', $args[troops1]);
    $troops2 = explode('|', $args[troops2]);

    $online = sqlsafeeval("SELECT online FROM $playerdb WHERE num=$id1;");
    fixInputNum($online);

    $limit = time() - $perminutes * 2 * 60;

    $new = false;
    $last_q = mysql_safe_query("SELECT * FROM $newsdb WHERE time>$limit ORDER BY id DESC LIMIT 0,1;");
    if (mysql_num_rows($last_q) == 0)
    {
        $new = true;
    }
    else
    {
        $old = mysql_fetch_array($last_q);

        //what must agree: code, id1, clan1, id2, clan2, id3, clan3, shielded, online
        if ($code == $old[code] && $id1 == $old[id1] && $clan1 == $old[clan1] && $id2 ==
            $old[id2] && $clan2 == $old[clan2] && $id3 == $old[id3] && $clan3 == $old[clan3] &&
            $shielded == $old[shielded])
        {
            $old[land1] += $land1;
            $old[cash1] += $cash1;
            $old[wizards1] += $wizards1;
            $old[food1] += $food1;
            $old[runes1] += $runes1;
            $old[land2] += $land2;
            $old[wizards2] += $wizards2;
            $st1 = explode('|', $old[troops1]);
            $st2 = explode('|', $old[troops2]);

            foreach ($st1 as $key => $val)
            {
                $troops1[$key] += $st1[$key];
                $troops2[$key] += $st2[$key];
            }
            $old[num]++;

            //saving and resetting old
            $old[troops1] = implode('|', $troops1);
            $old[troops2] = implode('|', $troops2);

            mysql_safe_query("UPDATE $newsdb SET num=$old[num], land1=$old[land1], cash1=$old[cash1], wizards1=$old[wizards1], food1=$old[food1], 
					runes1=$old[runes1], land2=$old[land2], wizards2=$old[wizards2], troops1='$old[troops1]', troops2='$old[troops2]' WHERE id=$old[id];");
        }
        else
        {
            $new = true;
        }
    }

    if ($new)
    {
        $troops1 = implode('|', $troops1);
        $troops2 = implode('|', $troops2);
        $query = "INSERT INTO $newsdb (time, code, id1, clan1, land1, cash1, troops1, wizards1, food1, runes1, id2, clan2, land2, troops2, wizards2, id3, clan3, shielded, online)
				VALUES ($time, $code, $id1, $clan1, $land1, $cash1, '$troops1', $wizards1, $food1, $runes1, $id2, $clan2, $land2, '$troops2', $wizards2, $id3, $clan3, $shielded, $online);";
        mysql_safe_query($query);
        if (mysql_error())
            echo "Please show this to the administrators:<br /><b>$query<br />" . mysql_error() .
                "</b><br />";
    }

    $time = time();
}

function doStatusBarHead($show)
{
	global $starttime, $playerdb, $config, $users, $oldhealth, $userdata, $uera, $time, $tpl, $config, $urace, $game_root_path, $tradeincome, $taxincome, $corruption, $wizardcosts, $landupkeep, $pagetype,$structures, $tradeincomearr, $marketincome,$publicorder, $employment, $effectiveStructures;
    require_once ($game_root_path."/lib/status.php");

    $foodnet = calcFoodPro() - calcFoodCon();
    $netincome = calcIncome() - calcExpenses(0);

    //	$land = sqlsafeeval("SELECT SUM(land) FROM $playerdb WHERE turnsused>$config[turnsused] AND disabled != 2 AND disabled != 3;");
    //	$count = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE turnsused>$config[turnsused] AND disabled != 2 AND disabled != 3;");

	manageEmployment($users);

	$oldhealth = $users[health];
	$users[health] = calcPublicOrder();
	saveUserData($users, 'health');
	//$bla = calcPublicOrder();

    $land = sqlsafeeval("SELECT SUM(land) FROM $playerdb WHERE turnsused>$config[protection] AND disabled != 2 AND disabled != 3;");
    $count = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE turnsused>$config[protection] AND disabled != 2 AND disabled != 3;");

    if ($count == 0)
        $avg = 0;
    else
        $avg = $land / $count;

    $succpoint = 5;
    $failpoint = 2;
    $offexp = (($users[offsucc] * $succpoint) + (($users[offtotal] - $users[offsucc]) *
        $failpoint)) / (1000 * $succpoint);
    $defexp = (($users[defsucc] * $succpoint) + (($users[deftotal] - $users[defsucc]) *
        $failpoint)) / (1000 * $succpoint);

    $experience = floor($offexp * 1000) + floor($defexp * 1000);

    if ($users[land] < $avg)
        $land_color = "cnormal";
    if ($users[land] > $avg)
        $land_color = "cgood";
    if ($users[rank] < 11)
        $rank_color = "cgood";
    else
        $rank_color = "cnormal";
    if ($users[health] > 74)
        $health_color = "cgood";
    if ($users[health] < 51)
        $health_color = "cwarn";
    if ($users[health] < 26)
        $health_color = "cbad";

    if ($netincome > 0)
        $cash_color = "cgood";
    else
        if ($netincome < 0)
            $cash_color = "cwarn";
    if ($users[cash] + ($netincome * 5) < 0)
     $cash_color = "cbad";

    if ($foodnet > 0)
        $food_color = "cgood";
    else
        if ($foodnet < 0)
            $food_color = "cwarn";
    if ($users[food] + ($foodnet * 5) < 0)
        $food_color = "cbad";
	// Update this player's score
	$current_score = sqlsafeeval("SELECT score FROM ".$config[forum_prefix]."_users WHERE empire_id='$users[num]';");
	$raw_score = $current_score*10;
	$addition = $users['networth'] - $raw_score;
	$new_score = $raw_score + $addition;
	$new_kills = $users[kills] * 25;
	$final_score = ($new_score / 3032234) + $new_kills;
	mysql_safe_query("UPDATE ".$config[forum_prefix]."_users SET score='$final_score' WHERE empire_id=$users[num];");
	$greatness_new = $users['networth'] / 2000000;
    $tpl->assign('endbar', $show);
    $tpl->assign('era', $users['region']);
    if (numNewMessages() > 0)
        $tpl->assign('newmail', 'true');
    $tpl->assign('turns_new', $users['turns']);
    $tpl->assign('cash_new', commas($users['cash']));
    $tpl->assign('land_new', commas($users['land']));
    $tpl->assign('land_free', commas($users['freeland']));
    $tpl->assign('runesname', $uera['runes']);
	$tpl->assign('cashname', $uera['cash']);
    $tpl->assign('foodname', $uera['food']);
    $tpl->assign('runes_new', commas($users['runes']));
    $tpl->assign('food', commas(gamefactor($users['food'])));
    $tpl->assign('networth_new', round((floor($users['networth'] * 10)) /($config['greatness_roundoff']  ^ 10), $config['greatness_roundoff']));
    $tpl->assign('greatness_new', round($greatness_new, 1));
    $tpl->assign('health_new', $users['health']);
    $tpl->assign('food_color', $food_color);
    $tpl->assign('cash_color', $cash_color);
    $tpl->assign('land_color', $land_color);
    $tpl->assign('health_color', $health_color);
	$tpl->assign('oldhealth', $oldhealth);
    $tpl->assign('turnsleft', $config[protection] - $users[turnsused] + 1);
	
	$mtmppre = "<a onclick=\"document.body.style.cursor='progress';location.replace('";
	$mtmpmid = "')\"><table class='icon ";
	$mtmpaft = "'><td>";
	$mtmpsuf	= "</td></table></a>";
	

	$mcurrentpre = '<table class="icon ';
	$mcurrentaft = ' ac"><td><p>';
	$mcurrentsuf= "</p></td></table>";
	
	$HrefExplore = "?explore";
	$HrefConstruct = "?construct";
	$HrefMilitary = "?recruit";
	$HrefIncome = "?income";
	$HrefTrade = "?trade";
	$HrefEspionage = "?espionage";
	$HrefWar= "?military";

	$explore = $mtmppre.$HrefExplore.$mtmpmid.'explore'.$mtmpaft;
	$exploreend = $mtmpsuf;

	$construct = $mtmppre.$HrefConstruct.$mtmpmid.'construct'.$mtmpaft;
	$constructend = $mtmpsuf;

	$military = $mtmppre.$HrefMilitary.$mtmpmid.'military'.$mtmpaft;
	$militaryend = $mtmpsuf;

	$income = $mtmppre.$HrefIncome.$mtmpmid.'income'.$mtmpaft;
	$incomeend = $mtmpsuf;

	$trade	= $mtmppre.$HrefTrade.$mtmpmid.'trade'.$mtmpaft;
	$tradeend = $mtmpsuf;

	$espionage = $mtmppre.$HrefEspionage.$mtmpmid.'espionage'.$mtmpaft;
	$espionageend = $mtmpsuf;

	$war = $mtmppre.$HrefWar.$mtmpmid.'war'.$mtmpaft;
	$warend = $mtmpsuf;	

	switch ($pagetype){
		case 'explore':
			$explore = $mcurrentpre.'explore'.$mcurrentaft;
			$exploreend = $mcurrentsuf;
			break;
		case 'construct';
			$construct = $mcurrentpre.'construct'.$mcurrentaft;
			$constructend = $mcurrentsuf;
			break;
		case 'military';
			$military = $mcurrentpre.'military'.$mcurrentaft;
			$militaryend = $mcurrentsuf;
			break;
		case 'income';
			$income = $mcurrentpre.'income'.$mcurrentaft;
			$incomeend = $mcurrentsuf;
			break;
		case 'trade';
			$trade	= $mcurrentpre.'trade'.$mcurrentaft;
			$tradeend = $mcurrentsuf;
			break;
		case 'espionage';
			$espionage = $mcurrentpre.'espionage'.$mcurrentaft;
			$espionageend = $mcurrentsuf;
			break;
		case 'war';
			$war = $mcurrentpre.'war'.$mcurrentaft;
			$warend = $mcurrentsuf;
			break;
	}
	
	$tpl->assign('MenuExplore', $explore);
	$tpl->assign('MenuExploreEnd', $exploreend);
	
	$tpl->assign('MenuConstruct', $construct);
	$tpl->assign('MenuConstructEnd', $constructend);
	
	$tpl->assign('MenuMilitary', $military);
	$tpl->assign('MenuMilitaryEnd', $militaryend);
	
	$tpl->assign('MenuIncome', $income);
	$tpl->assign('MenuIncomeEnd', $incomeend);
	
	$tpl->assign('MenuTrade', $trade);
	$tpl->assign('MenuTradeEnd', $tradeend);
	
	$tpl->assign('MenuEspionage', $espionage);
	$tpl->assign('MenuEspionageEnd', $espionageend);
	
	$tpl->assign('MenuWar', $war);
	$tpl->assign('MenuWarEnd', $warend);
	

	
	$ctags = loadClanTags();

//print_r($ctags);

if ($users[offtotal]) {
    $offsuccpercent = round($users[offsucc]/$users[offtotal]*100);
} else {
    $offsuccpercent = 0;
}

if ($users[deftotal]) {
    $defsuccpercent = round($users[defsucc]/$users[deftotal]*100);
} else {
    $defsuccpercent = 0;
}

$succpoint = 5;
$failpoint = 2;
$offexp = (($users[offsucc] * $succpoint) + (($users[offtotal] - $users[offsucc]) * $failpoint)) / (1000 * $succpoint);
$defexp = (($users[defsucc] * $succpoint) + (($users[deftotal] - $users[defsucc]) * $failpoint)) / (1000 * $succpoint);

$experience = floor($offexp*1000)+floor($defexp*1000);
$espionage = $users[espsucc];

$offpts = 0;
$defpts = 0;
foreach($config[troop] as $num => $mktcost) {
	//print "$num -> " . ($users[troop][$num] * $uera["o_troop$num"]) . " / " . ($users[troop][$num] * $uera["d_troop$num"]) . "== " . ($users[troop][$num] * $uera["d_troop$num"] + ($users[towers] * $config[towers])) . "<br />";
	$offpts += $users[troop][$num] * $uera["o_troop$num"];
	$defpts += $users[troop][$num] * $uera["d_troop$num"];
}

$offpts = round($offpts * $urace[offense]);
$bldgs = $users[land] - $users[freeland] - $users[towers];
$defpts += $users[towers] * $config[towers] * min(1, $users[troop][0] / (500 * $users[towers] + 1));
$defpts += $bldgs         * $config[blddef] * min(1, $users[troop][0] / (100 * $bldgs         + 1));
$defpts = round($defpts * $urace[defence]);

$offpts *= (1 + $offexp);
$defpts *= (1 + $defexp);
$size = calcSizeBonus($users[networth]);


$foodpro = calcFoodPro();
$foodcon = calcFoodCon();
$income = calcIncome();
$expenses = calcExpenses(0);

$troopcosts = calcExpenses(1);
$foodnet = $foodpro - $foodcon;
$netincome = $income - $expenses;

$loanpayment =  calcLoanPay();
$wizardrate =  calcWizards();

$runes = 0;
if (((getBuildings('runes', $users)*$config['buildingoutput']) / $users[land]) > .15)
	$runes = mt_rand(round((getBuildings('runes', $users)*$config['buildingoutput']) * 1.1), round((getBuildings('runes', $users)*$config['buildingoutput']) * 1.5));
else
   	$runes = round((getBuildings('runes', $users)*$config['buildingoutput']) * 1.1);
$runes = round($runes * $urace[runes]);
if ($users['hero_peace'] == 2) // Dionysus? 
    $runes *= 1.5;
if ($action == 'runes') // training?
    $runes *= 1.25;
$runeproduction = commas(gamefactor($runes));

// All the stuff to be commas()'ed

$users[turnsused] = commas($users[turnsused]);
$users[cash] = commas(gamefactor($users[cash]));
$users[networth] = commas($users[networth]);
$users[peasants] = commas($users[peasants]);
$foodpro = commas(gamefactor($foodpro));
$foodcon = commas(gamefactor($foodcon));
$users[shops] = commas($users[shops]);
$users[homes] = commas($users[homes]);
$users[industry] = commas($users[industry]);
$users[barracks] = commas($users[barracks]);
$users[labs] = commas($users[labs]);
$users[farms] = commas($users[farms]);
$users[towers] = commas($users[towers]);
$users[freeland] = commas($users[freeland]);
$income = commas(gamefactor($income));
$expenses = commas(gamefactor($expenses));
$loanpayment = commas(gamefactor($loanpayment));
$users[savings] = commas(gamefactor($users[savings]));
$users[loan] = commas(gamefactor($users[loan]));
foreach($config[troop] as $num => $mktcost) {
	$users["troop$num"] = commas(gamefactor($users[troop][$num]));
}
$users[wizards] = commas(gamefactor($users[wizards]));

$foodnet = returnCNum(gamefactor($foodnet), "", 0);
$netincome = returnCNum(gamefactor($netincome), "", 0);


$off_percent = 0;
$def_percent = 0;
$pci = pci($users,$urace);
$users[pci] = $pci;
$uclan = loadClan($users[clan]);

foreach($ctags as $id => $tag) {
	if($id != 0)
		$ctags[$id] = "<a class=\"proflink\" href=\"?clancrier&sclan=$id$authstr\">$tag</a>";
}

$tags = array($ctags["$users[clan]"], $ctags["$uclan[ally1]"], $ctags["$uclan[ally2]"], $ctags["$uclan[ally3]"], $ctags["$uclan[war1]"], $ctags["$uclan[war2]"], $ctags["$uclan[war3]"], $ctags["$uclan[ally4]"], $ctags["$uclan[ally5]"], $ctags["$uclan[war4]"], $ctags["$uclan[war5]"]);
$z = 0;
while($z<sizeof($tags)) {
	if($tags[$z] == "") $tags[$z] = "None";
	$z++;
}


//print_r($tags);


if($users[offtotal]) $off_percent = round($users[offsucc]/$users[offtotal]*100);
if($users[deftotal]) $def_percent = round($users[defsucc]/$users[deftotal]*100);


// Stock loading/displaying
$stocks = array();
$owned = explode("|", $users[stocks]);
$total_owned = 0;
$avg_price = 0;
for($key = 0; $key < sizeof($owned); $key++) {
	$prep_array = array();
	$prep_array['name'] = sqlsafeeval("SELECT name FROM $stockdb WHERE id=" . ($key+1));
	$prep_array['price'] = floor(sqlsafeeval("SELECT price FROM $stockdb WHERE id=" . ($key+1)) / 1000);

	$prep_array['owned'] = $owned[$key];
	$prep_array['total_worth'] = commas($prep_array['owned'] * $prep_array['price']);
	
	if($prep_array['owned'] > 0) {
		$avg_price += $prep_array['owned'] * $prep_array['price'];
		$total_owned += $prep_array['owned'];
	}
	
	// Must apply commas after multiplying
	$prep_array['owned'] = commas($prep_array['owned']);
	$prep_array['price'] = commas($prep_array['price']); // I'm only doing this incase some server has huge prices
	
	

	$stocks[] = $prep_array;
}

	if($total_owned == 0)
		$total_owned = 1;

	$stocks[] = array('name' => "<b>Total</b>", 'price' => "<b>" . commas(floor($avg_price / ($total_owned))) . "</b>", 'owned' => "<b>" . commas($total_owned) . "</b>", 'total_worth' => "<b>" . commas(floor($total_owned * ($avg_price/($total_owned)))) . "</b>");




$numtroops = count($config[troop]);

$troopdisp = array();
foreach($users[troop] as $num => $have) {
	$troopdisp[] = array(name=>ucwords($uera["troop$num"]), have=>commas(gamefactor($have)));
}
$structuresdisp = array();
$structuresworking = array();

foreach($structures as $num => $name) {
	if(buildingfactor($users['structure_'.$num]) > 1)
	{
			$value = $effectiveStructures[$users['num']][$num];
			if(!$value)
				$value = 0;
			$structuresworking[] = array(have=>buildingfactor($value));	
			
			$structuresdisp[] = array(name=>ucwords($uera["structure$num"]), have=>buildingfactor($users['structure_'.$num]));
	}
}
$loanrate = $config[loanbase] + $size;
$savrate = $config[savebase] - $size;

$showstocks = true;
if(in_array('stocks', $config['disabled_pages']))
	$showstocks = false;

$tpl->assign('showstocks', $showstocks);

if($tradeincome > 0)
	$tprefix = '+';
$tradeincome = $tprefix.commas(gamefactor($tradeincome));

if($marketincome > 0)
	$trprefix = '+';
$marketincome = $trprefix.commas(gamefactor($marketincome));

foreach($tradeincomearr as $id => $value){
	if($tradeincomearr[$id] > 0)
	{
		$iprefix[$id] = '+';
		$tradeincomearr[$id] = $iprefix[$id] . commas(gamefactor($tradeincomearr[$id]));
		$structureincomearr[]  = array(name=>ucwords($id), value=>$tradeincomearr[$id]);
	}
}

if($taxincome > 0)
	$taxprefix = '+';
$taxincome = $taxprefix.commas(gamefactor($taxincome));

if($troopcosts > 0)
	$tcprefix = '-';
$troopcosts = $tcprefix.commas($troopcosts);

if($loanpayment > 0)
	$lprefix = '-';
$loanpayment = $lprefix.commas($loanpayment);

if($corruption > 0)
	$cprefix = '-';
$corruption = $cprefix.commas($corruption);

if($wizardcosts > 0)
	$wprefix = '-';
$wizardcosts = $wprefix.commas(gamefactor($wizardcosts));

if($landupkeep > 0)
	$laprefix = '-';
$landupkeep = $laprefix.commas(gamefactor($landupkeep));

foreach($publicorder['positivefactors'] as $name => $num){
	$publicorderarr['positivefactors'][]  = array(name=>$name, value=>round($publicorder['positivefactors'][$name]));
}
foreach($publicorder['negativefactors'] as $name => $num){
	$publicorderarr['negativefactors'][]  = array(name=>$name, value=>round($publicorder['negativefactors'][$name]));
}

$wizardrate = commas(gamefactor($wizardrate));
$tpl->assign('publicorderpositives', $publicorderarr['positivefactors']);
$tpl->assign('publicordernegatives', $publicorderarr['negativefactors']);
$tpl->assign('employment', $employment);
$tpl->assign('wizardrate', $wizardrate);
$tpl->assign('runeproduce', $runeproduction);
$tpl->assign('tradeincome', $marketincome);
$tpl->assign('taxincome', $taxincome);
$tpl->assign('structureincometotal', $tradeincome);
$tpl->assign('structureincome', $structureincomearr);
$tpl->assign('corruption', $corruption);
$tpl->assign('wizardcosts', $wizardcosts);
$tpl->assign('landupkeep', $landupkeep);
$tpl->assign('troopcosts', $troopcosts);
$tpl->assign('troopshave', $troopdisp);
$tpl->assign('structures', $structuresdisp);
$tpl->assign('structuresworking', $structuresworking);
$tpl->assign('numtroops', $numtroops);
$tpl->assign('uera', $uera);
$tpl->assign('users',$users);
$tpl->assign('urace', $urace);
$tpl->assign('tags', $tags);
$tpl->assign('ti', $pci*$users['peasants']);
$tpl->assign('foodpro', $foodpro);
$tpl->assign('foodcon', $foodcon);
$tpl->assign('income', $income);
$tpl->assign('expenses', $expenses);
$tpl->assign('loanpayment', $loanpayment);
$tpl->assign('savrate', $savrate);
$tpl->assign('foodnet', $foodnet);
$tpl->assign('netincome', $netincome);
$tpl->assign('loanrate', $loanrate);
$tpl->assign('experience', $experience);
$tpl->assign('espionage', $espionage);
$tpl->assign('off_percent', $off_percent);
$tpl->assign('def_percent', $def_percent);
$tpl->assign('offpts', commas($offpts));
$tpl->assign('defpts', commas($defpts));
$tpl->assign("stocks", $stocks);

$users=loadUser($users[num]);

    if ($show)
    {
        $generated = getmicrotime() - $starttime;
        $tpl->assign('generated', round($generated, 3));
    //    $tpl->assign('gameversion', $config['version']);
        $tpl->display('subheader.tpl');
    }
}
function doStatusBar($show)
{
    global $starttime, $playerdb, $config, $users, $uera, $tpl, $config, $generated;

    if ($show)
    {
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$endtime = $mtime;

	$generated = ($endtime - $starttime);
       // $generated = getmicrotime() - $starttime;
        $tpl->assign('generated', round($generated, 3).'s');
        $tpl->assign('gameversion', $config['version']);
        $tpl->display('footer.tpl');
    }
}
function initGUI ($reason="")
{
	doStatusBarHead(true);
} 
function endScript ($reason="") // End current action
{
	global $users, $tpldir, $config, $version, $tpl, $starttime;
	echo '<b><span class="error-font">' . $reason . '</span></b>';
	echo '<br /><br /><br />';


	doStatusBar(true);
	ob_end_flush();
	exit;
} 

function ThePrint($message)
{
	echo "$message\n\n";
} 
function endScriptGood ($reason="") // End current action
{
	global $users, $tpldir, $config, $version, $tpl;
	echo '<b><span class="success-font">' . $reason . '</span></b>';
	echo '<br />';


	doStatusBar(true);
	ob_end_flush();
	exit;
} 
function ThePrintGood($message)
{
	echo "$message\n\n";
} 

function getBuildings($type, $player)
{
	global $config, $effectiveStructures;
	
	// Determine the average value of each building's bonus(es)
	switch($type){
		case 'homes':
			$denominator = 1;
			$numeral = true;
			break;
		case 'markets_decay':
			$denominator = 1;
			$numeral = true;
			break;
		case 'income':
			$denominator = 100;
			$numeral = true;
			$separated = true;
			break;
		case 'income_total':
			$denominator = 100;
			$numeral = true;
			$type = 'income';
			break;
		case 'farms';
			$denominator = 10;
			$numeral = true;
			break;
		case 'towers';
			$denominator = 1;
			$numeral = true;
			break;
		case 'walls';
			$denominator = 1;
			$numeral = true;
			break;
		case 'runes';
			$denominator = 10;
			$numeral = true;
			break;
		case 'agents';
			$denominator = 10;
			$numeral = true;
			break;
	}

	if($numeral)
	{
		foreach($config['structures'][$type] as $id => $name)
		{
			// Use must be decimal for accuracy
			if($separated)
				$total[$config['structures'][$type.'category'][$id]] += (($effectiveStructures[$player['num']][$id]*$config['structures'][$type][$id])/$denominator)*$config['game_factor'];
			else
				$total += buildingfactor(($effectiveStructures[$player['num']][$id]*$config['structures'][$type][$id])/$denominator);
		}
	}
	else
	{
		if($config['structures'][$type]){
			foreach($config['structures'][$type] as $id => $name)
			{
				$total += buildingfactor($effectiveStructures[$player['num']][$id]);
			}
		}
	}
	return $total;
}

function unitMeetsRequirements ($uera, $player, $unit) 
{
	global $config;
	
	
	$meets = false;
	$factory = $uera[$unit.'requires'];
	$factorybuilding = 'factory'.$factory;
	$factoryamount = $uera[$unit.'requiresamnt'];
	if(getBuildings($factorybuilding, $player) >= $factoryamount) 
		$meets = true;
		
	return $meets;
}

function structureMeetsRequirements ($uera, $player, $structure) 
{
	global $config;
	
	$meets = false;
	$prereq = explode($uera[$unit.'requires']);
	$prereqamount = explode($uera[$unit.'requiresamnt']);
	foreach($prereq as $id => $structure)
	{
		$prereqbuilding = 'prereq'.$structure;
		if(getBuildings($prereqbuilding, $player) >= $prereqamount[$structure]) 
			$meets = true;
		else
			$meets = false;
	}
		
	return $meets;
}

function getTradeRightsTotal($player)
{
	$traderightsarray = explode(',', $player['trade_agreements']);
	foreach($traderightsarray as $num => $name){
			if($traderightsarray[$num])
				$total++;
	}
	return $total;
}
function effectiveTradeRights($number) 
{
	global $config, $users;

	$traderightsinidecay = $number;
	$traderightstotal = getTradeRightsTotal($users)+1;
	$traderightsdecay1 = pow(10, $traderightsinidecay*100);
	$traderightsdecay = $traderightstotal*($traderightsdecay1);

	$effectivetraderights = $traderightstotal - ($traderightstotal * (log($traderightstotal, ($traderightsdecay))));
//echo $effectivetraderights;
	return $effectivetraderights;
}

function LogarizedTradeRights ($users)
{
	global $config;
	foreach($config['structures']['markets'] as $num => $name)
	{
		$total += ($config['structures']['markets_decay'][$num] * buildingfactor($users['structure_'.$num]));
		$counter++;
	}
	$final = ($total) / getBuildings('markets', $users);
	
	//echo "Trade decay: ".$final."<br>";
	//echo "EffectiveTradeRights: ".effectiveTradeRights($final)."<br>";
	return effectiveTradeRights($final);
}

function getDistanceFactor($users)
{
	global $config;
	foreach($config['structures']['markets'] as $num => $name)
	{
		$total += ($config['structures']['markets_distance'][$num] * buildingfactor($users['structure_'.$num]));
		$counter++;
	}
	$final = ($total) / getBuildings('markets', $users);
	
	//echo "Market Distance: ".$final."<br>";
	return $final;
}

function getDistance($player, $enemy)
{
	global $config, $uera;
	
	$player['x'] = $config['regionpos'][$player['region']]['x'];
	$player['y'] = $config['regionpos'][$player['region']]['y'];
	$enemy['x'] = $config['regionpos'][$enemy['region']]['x'];
	$enemy['y'] = $config['regionpos'][$enemy['region']]['y'];
	
	$eq = pow($player['x'] - $enemy['x'], 2) + pow($player['y'] - $enemy['y'],2);
	$distance = sqrt($eq);
	//echo "Distance: ".$distance."<br>";
	return $distance;
}

function AlliedTrade ($structure)
{
	global $config, $users;
	
	$traderightsarray = explode(',', $users['trade_agreements']);
	foreach($traderightsarray as $num => $name)
	{
			if($traderightsarray[$num])
			{
				$Ally = loadUser($name);
				$AllyIncome += gamefactor($Ally['trade_economy']);
				$Distance =  getDistance($users, $Ally);
				if($Distance > 0)
					$TotalDistances += $Distance;
				else
					$TotalDistances += 1;
			}
	}

	$alliedtrade = (( ($AllyIncome / ($config['structures']['markets_avgincome'][$structure]/500)) / ( $TotalDistances / getDistanceFactor($users) )));
	return $alliedtrade;
}

function getMarketProfits ()
{
	global $config, $users;
	$improvement = 1;
	foreach($config['structures']['markets_roads'] as $num2 => $name2)
	{
		if($config['structures']['markets_roads'][$num2])
			$improvement *= ((1+$config['structures']['markets_roads'][$num2]/1000) * buildingfactor($users['structure_'.$num2]));
	}
	foreach ($config['structures']['markets']  as $type => $name)
	{
		if($users['trade_agreements'])
			$alliedtrade = $improvement/10 * AlliedTrade($type) * LogarizedTradeRights($users);
		$EffectiveMarkets[$type] = 	(buildingfactor($users['structure_'.$type])*$config['structures']['markets'][$type] * ((($users[land] + 300) / 50) + $alliedtrade))/20;
		//echo '<br><br>MARKET PROFITS: '.$EffectiveMarkets[$type].'<br>';
	}
	foreach ($EffectiveMarkets  as $type => $name)
	{
		$MarketProfits += $EffectiveMarkets[$type];
	}
	return $MarketProfits*1000;
}

function shuffle_with_keys(&$array) 
{
      $aux = array();
      $keys = array_keys($array);
      shuffle($keys);
      foreach($keys as $key) 
      {
	      $aux[$key] = $array[$key];
	      unset($array[$key]);
      }
      $array = $aux;
}

function calculateFreeLand($user)
{
	global $uera;
	
	foreach($user['buildings'] as $id => $value)
	{
		$occupiedland += buildingfactor($value)*$uera['structure'.$id.'land'];
	}
	$freeland = $user['land'] - $occupiedland;
	if($freeland < 0)
		$freeland = 0;
	
	return $freeland;
}

function manageEmployment($player)
{
	global $uera, $employment, $effectiveStructures, $config;
		
	foreach($player['buildings'] as $id => $value)
	{
			for($i = 1; $i <= buildingfactor($value); $i++)
			{
					$array[$i][$id] = $id;
			}
	}
	
	$epopulation = $player['peasants'];
	
	foreach($array as $num => $name)
	{
		foreach($array[$num] as $id => $name)
		{
			$counter[$id]++;
			$workers += $uera['structure'.$id.'employees'];
			$epopulation = $player['peasants'] - $workers;
			if($epopulation > 0 || !$uera['structure'.$id.'employees'])
					$effectiveStructures[$player['num']][$id] = $counter[$id]/$config['game_factor']; // actual working buildings
		}
	}
	
	$epopulation = $player['peasants'] - $workers;

	if($epopulation > 0) // Unemployment
	{
		$employment['unemployedpercent'] = ceil($epopulation / $player['peasants'] *100);
		$employment['unemployed'] = $epopulation;
		$employment['workersneededpercent'] = false;
		$employment['workersneeded'] = false;
	}
	elseif($epopulation < 0) // Too many jobs
	{
		$employment['workersneededpercent'] = ceil($workers / $player['peasants']*100 - 100);
		$employment['workersneeded'] = $workers - $player['peasants'];
		$employment['unemployedpercent'] = false;
		$employment['unemployed'] = false;
	}
	else // perfect
		$employment['perfect'] = true;
	
	// feed to public order
	// feed to building tab
	// feed to effective building function
}

?>
