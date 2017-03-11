<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
	function getWardropColor($wardrop) {
		global $users, $uclan, $urace, $uera, $config;
			if($users[num] == $wardrop[num])
				return "self";

			if($wardrop[disabled] == 2)
				return "admin";

			$color = "normal";
			$warflag = 0;
			if ($wardrop[clan] != 0 && ($uclan[war1] == $wardrop[clan] || $uclan[war2] == $wardrop[clan] || $uclan[war3] == $wardrop[clan] || $uclan[war4] == $wardrop[clan] || $uclan[war5] == $wardrop[clan]))
				$warflag = 1;
			$netmult = 20;
			if($users[warset] == $wardrop[num] || $wardrop[warset] == $users[num]) {
				$netmult = 50;
				$warflag = 1;
			}

			if($warflag == 1)
				$color = "good";

			if (($users[networth] > $wardrop[networth] * 2.5) && $warflag == 0)
				$color = "disabled";
			if (($wardrop[networth] > $users[networth] * 2.5) && $warflag == 0)
				$color = "disabled";
			if ($wardrop[networth] > $users[networth] * $netmult)
				$color = "dead";
			if ($users[networth] > $wardrop[networth] * $netmult)
				$color = "dead";

			if (($wardrop[era] != $users[region]) && ($users[gate] <= $time) && ($wardrop[gate] <= $time))
				$color = "protected";
			if ($wardrop[attacks] > $config['max_attacks'] && $warflag == 0)
				$color = "protected";

			if ($users[clan] == $wardrop[clan] && $users[clan] != 0)
				$color = "ally";
			if ($wardrop[clan] != 0 && (($uclan[ally1] == $wardrop[clan]) || ($uclan[ally2] == $wardrop[clan]) || ($uclan[ally3] == $wardrop[clan]) || ($uclan[ally4] == $wardrop[clan]) || ($uclan[ally5] == $wardrop[clan])))
				$color = "ally";

		return $color;
	}
	
// era of troops, quantity of troops, type of troops, offense or defence
function CalcPoints($era, $quantity, $ttype, $atype)
{
    $type = $atype . "_troop" . $ttype;
    return $quantity * $era[$type];
}

function numWarSet($war_user)
{
    global $users, $playerdb;
    fixInputNum($war_user[num]);
    $num = sqlsafeeval("SELECT count(*) FROM $playerdb WHERE warset=$war_user[num];");
    return $num;
}

function ClanCheck() // Need to set warflag and netmult
{
    global $warflag, $netmult, $users, $uclan, $enemy, $config;
    if ($users[clan] == $enemy[clan] && $users[clan] != 0)
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Cannot attack empires within your clan.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if (($uclan[ally1] == $enemy[clan]) || ($uclan[ally2] == $enemy[clan]) || ($uclan
        [ally3] == $enemy[clan]) || ($uclan[ally4] == $enemy[clan]) || ($uclan[ally5] ==
        $enemy[clan]))
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Your generals quietly ignore your orders to attack an ally.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if (($uclan[war1] == $enemy[clan]) || ($uclan[war2] == $enemy[clan]) || ($uclan
        [war3] == $enemy[clan]) || ($uclan[war4] == $enemy[clan]) || ($uclan[war5] == $enemy
        [clan]))
    {
        $warflag = 1.2;
        $netmult = 50;
    }
}

function ReadInputOLDA($type)
{
    global $users, $usent, $enemy, $esent, $sendall, $config;

    foreach ($config[troop] as $troop => $mktcost)
    {
        $esent[$troop] = $enemy[troop][$troop];
        if ($enemy[forces] > 0) // if enemy shares forces, he can't use them for defence
            $esent[$troop] *= 0.9;
        if ($sendall) // send everything?
            $usent[$troop] = $users[troop][$troop];

        $numtroops = count($config[troop]);
		
        if ($type == 9 && $troop != 1 && $troop != 3)
        {
            $usent[$troop] = 0;
            $esent[$troop] = 0;
        }
        else
            if ($type == 8 && $troop != 0 && $troop != 3)
            {
                $usent[$troop] = 0;
                $esent[$troop] = 0;
            }
            else
                if ($type >= 4 && $type < ($numtroops + 4) && $troop != ($type - 4))
                {
                    $usent[$troop] = 0;
                    $esent[$troop] = 0;
                }

        CheckQuantity($troop);
    }
}

function ReadInput($type)
{
    global $users, $usent, $enemy, $esent, $sendall, $config, $atktypedata;

	$usentrec[] = array();
	$esentrec[] = array();
    foreach ($config[troop] as $troop => $mktcost)
    {
        $esent[$troop] = $enemy[troop][$troop];
        if ($enemy[forces] > 0) // if enemy shares forces, he can't use them for defence
            $esent[$troop] *= 0.9;
        if ($sendall) // send everything?
            $usent[$troop] = $users[troop][$troop];

        $numtroops = count($config[troop]);
		
		// Determine valid troop types for the strategy type
		$rtype = $type - 1;
		$uera = loadRegion($users['region'], $users['race']);
		$eera = loadRegion($enemy['region'], $enemy['race']);
		foreach($atktypedata[$rtype]['ValidTypesArr'] as $num => $name)
		{
			// User
			if($uera['troop'.$troop.'type'] == $name)
			{
				$usentrec[$troop]++;
			}
			// Enemy
			if($eera['troop'.$troop.'type'] == $name)
			{
				$esentrec[$troop]++;
			}
		}
		if($usentrec[$troop] == 0 || $usentrec[$troop] == null)
		{
			$usent[$troop] = 0;
		}
		if($esentrec[$troop] == 0 || $esentrec[$troop] == null)
		{
			$esent[$troop] = 0;
		}

        CheckQuantity($troop);
    }
}

function CheckQuantity($type)
{
    global $users, $uera, $usent, $config;

    fixInputNum($usent[$type]);
    $esent[$type] = round($esent[$type]);
    if ($usent[$type] < 0)
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='You cannot attack with a negative amount of units.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($usent[$type] > $users[troop][$type])
    {
        $mil_error = "You do not have that many " . strtolower($uera["troop$type"]) . ".";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
}

function Attack($type)
{
    global $users, $uera, $urace, $usent, $enemy, $eera, $erace, $esent, $playerdb, $datetime, $time,
        $warflag, $config;
    $uoffense = 0;
    $edefence = 0;

    foreach ($config[troop] as $num => $mktcost)
    {
        $uoffense += CalcPoints($uera, $usent[$num], $num, o);
        $edefence += CalcPoints($eera, $esent[$num], $num, d);
    }
    if ($uoffense == 0 && $type != 'Kamikaze')
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='You must attack with something.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
	
	$erace = loadRace($enemy[race], $enemy[region]);
    $uoffense *= $users[health] / 100;
	$uoffense *= $urace[offense];
    $edefence *= $enemy[health] / 100;
	$edefence *= $erace[defence];

    if ($warflag)
        $uoffense *= 1.2;

    $helping = 0;

    if ($type == "Surprise")
    {// surprise attack?
        $offpts *= 1.25;
        $helping = 0;
        $users[attackpenalty] += 5;
    }
    elseif (($enemy[clan]) && ($enemy[forces] > 0))
    {// enemy has allies and sharing forces?
        $dbally = mysql_safe_query("SELECT troops,num,era,race,clan,gate FROM $playerdb WHERE clan=$enemy[clan] AND forces>0 AND land>0;");
        $helping = @mysql_num_rows($dbally);
    }
    if ($helping)
    {// add up allies
        if (($helping - 1) != 0)
            print $helping . plural($helping, ' ' . $uera[empire] . "s rush", ' ' . $uera[
                empire] . " rushes") . " to defend your target!<br />\n";
        $emaxdefence = $edefence * 2;
        while ($ally = mysql_fetch_array($dbally))
        {
            $ally[troop] = explode("|", $ally[troops]);
            unset($ally[troops]);
            $ad = 0;
            if (($enemy[gate] > $time) || ($ally[gate] > $time) || ($enemy[region] == $ally[
                era]))
            {// defence is limited to eras as well
                if ($ally[num] != $users[num]) // addNews(300,$users,$ally,$enemy[num]);
                    $arace = loadRace($ally[race], $ally[era]);// adjust according to ally race
                $aera = loadRegion($ally[era], $ally[race]);// and era
                foreach ($config[troop] as $num => $mktcost)
                    $ad += allyHelp($num, $helping) * ($ally[health] / 100);

                $ad = round($ad * $arace[defence]);
                $edefence += $ad;
            }
        }
        if ($edefence > $emaxdefence) // limit ally defence
            $edefence = $emaxdefence;
    }
    $tdefence = $enemy[towers] * $config[towers] * min(1, $enemy[troop][0] / (100 *
        $enemy[towers] + 1));// and add in towers
    $bldgs = ($enemy[land] - $enemy[freeland] - $enemy[towers]);
    $bdefence = $bldgs * $config[blddef] * min(1, $enemy[troop][0] / (100 * $bldgs +
        1));// add in normal buildings
    $edefence += $tdefence;
    $edefence += $bdefence;
    if ($users['hero_war'] == 1) // Nike'?
        $uoffense *= 1.25;
    if ($enemy['hero_war'] == 2) // Hephaestus?
        $edefence *= 1.25;
    $bonus = 1;
    if ($users['hero_special'] == 2)
    {// Nemesis?
        $bonus = ($users['attacks'] / $config['max_attacks']) + 1;
    }
    $uoffense *= $bonus;
    if ($warflag == 0) // war == infinite attacks
        $enemy[attacks]++;

    dobattle($uoffense, $edefence, $type, $tdefence);
}

function AllyHelp($type, $numallies)
{
    global $enemy, $esent, $ally, $aera;
    $amt = round($ally[troop][$type] * .1);
    if ($amt > $esent[$type] / $numallies)
        $amt = $esent[$type] / $numallies;
    return CalcPoints($aera, $amt, $type, d);
}

/**
* dobattle(Offense_Points, defence_Points, Attack_Type)
* This function:
* determines who won
* calls detloss() to determine troop losses
* calls dealland() if attack was successful
*/
function dobattle($op, $dp, $type, $towp)
{
    global $users, $enemy, $config;
    // EXPERIENCE ALGORITHM (Anton:030313)
    $succpoint = 5;
    $failpoint = 2;
    $uoffexp = (($users[offsucc] * $succpoint) + (($users[offtotal] - $users[
        offsucc]) * $failpoint)) / (1000 * $succpoint);
    $edefexp = (($enemy[defsucc] * $succpoint) + (($enemy[deftotal] - $enemy[
        defsucc]) * $failpoint)) / (1000 * $succpoint);

    $op = (1 + $uoffexp) * $op;
    $dp = (1 + $edefexp) * $dp;
    // END EXPERIENCE ALGORITHM
    $emod = sqrt($op / ($dp + 1));// modification to enemy losses
    $umod = sqrt(($dp - $towp) / ($op + 1));// modification to attacker losses (towers not included)

    $loss_mod1 = array();
    $loss_mod2 = array();

    foreach ($config[troop] as $num => $mktcost)
    {
        $loss_mod1[$num] = 0.13 - (0.0146 * $mktcost * $config['troopscale'][$num]) / (
            $config[troop][0]);
        $loss_mod2[$num] = 0.0716 - (0.0065 * $mktcost * $config['troopscale'][$num]) /
            ($config[troop][0]);
    }

    foreach ($config[troop] as $num => $mktcost)
    {
        if ($type == ($num + 4))
        {
            detloss($loss_mod1[$num], $loss_mod2[$num], $umod, $emod, $num);
        }
    }

    if ($type == 8)
    {
        detloss($loss_mod1[0], $loss_mod2[0], $umod, $emod, 0);
        detloss($loss_mod1[3], $loss_mod2[3], $umod, $emod, 3);
    }
    else
        if ($type == 9)
        {
            detloss($loss_mod1[1], $loss_mod2[1], $umod, $emod, 1);
            detloss($loss_mod1[3], $loss_mod2[3], $umod, $emod, 3);
        }
        else
            if ($type == 3)
                $umod *= 1.2;

    if ($type == 2 || $type == 3)
    {
        foreach ($config[troop] as $num => $mktcost)
        {
            detloss($loss_mod1[$num], $loss_mod2[$num], $umod, $emod, $num);
        }
    }
    if ($op > $dp * 1.05)
    {
        dealland($type);
    }
	printedreportdata();
}

/**
* This function determines the loss of specific types of troops
* It handles the attacker and defender in one run through
*/
function detloss($uper, $eper, $umod, $emod, $type)
{
    global $uloss, $eloss, $usent, $esent;
    if ($usent[$type] > 0) // can't lose more than you send... send none, lose none
        $uloss[$type] = min(mt_rand(0, (ceil($usent[$type] * $uper * $umod) + 1)), $usent
            [$type]);
    else
        $uloss[$type] = 0;

    $maxkill = round(.9 * $usent[$type]) + mt_rand(0, round(.2 * $usent[$type] + 1));// max kills determination (90% - 110%)
    if ($esent[$type] > 0)
        // he can't lose more than he defended with, or attacker can kill
        $eloss[$type] = min(mt_rand(0, ceil($esent[$type] * $eper * $emod)), $esent[$type],
            $maxkill);
    else
        $eloss[$type] = 0;// no troops, no losses
}

function LossCalc(&$player, &$ploss)
{
    global $config;
    foreach ($config[troop] as $num => $mktcost)
        $player[troop][$num] -= $ploss[$num];
}

// This was the old method of determining the spoils of war. We no longer pick types.
function DealLandOLD($type)
{
    global $landloss, $buildgain, $enemy, $users, $foodloss, $cashloss, $what_for, $config;

    if ($what_for == 'land')
    {
        // destroy structures
        destroyBuildings('homes', 7, 70, $type);
        destroyBuildings('shops', 7, 70, $type);
        destroyBuildings('industry', 7, 50, $type);
        destroyBuildings('barracks', 7, 70, $type);
        destroyBuildings('labs', 7, 60, $type);
        destroyBuildings('farms', 7, 30, $type);
        destroyBuildings('towers', 7, 60, $type);
        destroyBuildings('freeland', (10 * $config['landattackgains']), 0, $type);// 3rd argument MUST be 0 - calculate gained freeland below
        $users[freeland] += $landloss*$config['landattackgains'] - $buildgain;
        // update total land counts
        $users[land] += $landloss;
        $enemy[land] -= $landloss;
        // $enemy[l_attack] = $users[num];
    }
    else
        if ($what_for == 'cash')
        {
            $money = round(($enemy[cash] / 100000 * mt_rand(ceil(10000), ceil(15000))) * $config
                ['sackmodifiercash']);
            if ($money > $enemy[cash])
                $money = $enemy[cash];
            if ($money == 0)
            {
                ob_end_clean();
                {
                    mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='<span class=\"cwarn\">Your troops find that your enemy has no ".strtolower($uera[cash])." for you to take!</span>' WHERE num='$users[num]';");
                    $uri = urldecode($_SERVER['REQUEST_URI']);
                    $action = substr($uri, strpos($uri, '?') + 1);
                    header("Location: ?" . $action);
                    endScript();
                }
            }
            $users[cash] += $money;
            $enemy[cash] -= $money;
            $landloss = $money;
        }
        else
            if ($what_for == 'food')
            {
                $food = round(($enemy[food] / 100000 * mt_rand(ceil(10000), ceil(15000))) * $config
                    ['sackmodifierfood']);
                if ($food > $enemy[food])
                    $food = $enemy[food];
                if ($food == 0)
                {
                    ob_end_clean();
                    {
                        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='<span class=\"cwarn\">Your troops find your enemy has no food for you to take!</span>' WHERE num='$users[num]';");
                        $uri = urldecode($_SERVER['REQUEST_URI']);
                        $action = substr($uri, strpos($uri, '?') + 1);
                        header("Location: ?" . $action);
                        endScript();
                    }
                }
                $users[food] += $food;
                $enemy[food] -= $food;
                $landloss = $food;
            }
            else
            {
                mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='But why, what for?' WHERE num='$users[num]';");
                $uri = urldecode($_SERVER['REQUEST_URI']);
                $action = substr($uri, strpos($uri, '?') + 1);
                header("Location: ?" . $action);
                endScript();
            }
}
function DealLand($type)
{
    global $landloss, $buildgain, $enemy, $users, $foodloss, $cashloss, $what_for, $config, $atktypedata;

		// LAND
        // destroy structures
        destroyBuildings('homes', 7, 70, $type);
        destroyBuildings('shops', 7, 70, $type);
        destroyBuildings('industry', 7, 50, $type);
        destroyBuildings('barracks', 7, 70, $type);
        destroyBuildings('labs', 7, 60, $type);
        destroyBuildings('farms', 7, 30, $type);
        destroyBuildings('towers', 7, 60, $type);
        destroyBuildings('freeland', (10 * $config['landattackgains']* $atktypedata[$type - 1]['TerritoryGain']), 0, $type);// 3rd argument MUST be 0 - calculate gained freeland below
        $users[freeland] += $landloss*$config['landattackgains'] - $buildgain;
        // update total land counts
        $users[land] += $landloss;
        $enemy[land] -= $landloss;
        // $enemy[l_attack] = $users[num];
		
		// MONEY
            $money = round(($enemy[cash] / 100000 * mt_rand(ceil(10000), ceil(15000))) * $config
                ['sackmodifiercash']* $atktypedata[$type - 1]['CashGain']);
            if ($money > $enemy[cash])
                $money = $enemy[cash];
            $users[cash] += $money;
            $enemy[cash] -= $money;
            $cashloss = $money;

			// FOOD
                $food = round(($enemy[food] / 100000 * mt_rand(ceil(10000), ceil(15000))) * $config
                    ['sackmodifierfood']* $atktypedata[$type - 1]['FoodGain']);
                if ($food > $enemy[food])
                    $food = $enemy[food];
                $users[food] += $food;
                $enemy[food] -= $food;
                $foodloss = $food;
}
// To handle destroying buildings during successful attacks
function destroyBuildings($type, $pcloss, $pcgain, $atktype)
{
    global $landloss, $buildgain, $enemy, $users, $config, $atktypedata;
    $pcloss /= 100;
    $pcgain /= 100;

	//$pcloss *= ($atktypedata[$type - 1]['BuildingDestroy'])/$config['buildingoutput'];
    //$pcgain *= ($atktypedata[$type - 1]['BuildingDestroy'])/$config['buildingoutput'];
    
    if (($atktype == 'troop1') || ($atktype == 'troop2') || ($atktype == 'troop3'))
    {// these attacks destroy extra buildings, but fewer are gained
        if ($atktype == 'troop2')
        {
            $pcloss *= 1.25/$config['buildingoutput'];
            $pcgain *= 0.72/$config['buildingoutput'];
        }
        elseif (($type == 'towers') || ($type == 'labs'))
        {
            $pcloss *= 1.3/$config['buildingoutput'];
            $pcgain *= (9 / 13)/$config['buildingoutput'];
        }
        else
            $pcgain *= 0.9/$config['buildingoutput'];
    }

    if ($enemy[$type] > 0)
        $loss = mt_rand(1, ceil($enemy[$type] * $pcloss + 2));
    if ($loss > $enemy[$type])
        $loss = $enemy[$type];
    $gain = ceil($loss * $pcgain);

    $enemy[$type] -= $loss;
    $landloss += $loss;
    if ($atktype == 2 && $users[std_bld] == 1)
    {// only gain buildings with standard attack
        $users[$type] += $gain;
        $buildgain += $gain;
    }
}
function printedreportdata()
{
    global $attacktype, $users, $uloss, $usent, $uera, $enemy, $erace, $eloss, $eera,
        $landloss, $buildgain, $foodloss, $cashloss, $what_for, $losstype, $config, $shadowdata, $playerdb, $units, $game_root_path;

	$reportdata = '';
    if (!$landloss)
        $landloss = 0;

        $ploss .= commas($landloss) . ' acres of new territory.';

        $ploss .= "<br><br>Because this land is, as of now, under your authority, you have ".commas(gamefactor($foodloss)) . ' food provisions';

        $ploss .= ' and ' . commas(gamefactor($cashloss) . $uera[cash]).' gold under your control';


    //echo $attacktype ;
    for ($i = 0; $i <= $units['Units']['Number']; $i++)
    {
// 	echo 'Loss1: ' . $uloss[$i] . '<br />';
        $utotal_loss += $uloss[$i];
    }
    for ($i = 0; $i <= $units['Units']['Number']; $i++)
    {
        $etotal_loss = $etotal_loss + $eloss[$i];
    }
    $utotal_loss = commas(gamefactor($utotal_loss));
    $etotal_loss = commas(gamefactor($etotal_loss));

	include($game_root_path.'/lib/battle.php');

    srand((double)microtime() * 1000000);
    $rand = rand(0, count($randomdefeat) - 1);

    srand((double)microtime() * 1000000);
    $randvict = rand(0, count($randomvictory) - 1);
    $reportdata =  "<table border=\'0\' cellspacing=\'0\' cellpadding=\'0\' width=380>
	<tr>
	<td class=shlarge rowspan=2 style=\'text-align:center;padding-top:5px;padding-bottom:15px\'>
	<table width=340 cellpadding=2><tr><td class=\'acenter\'>";
	if ($buildgain)
        $structgain .=  " You also captured $buildgain structures!";
    if ($landloss || $cashloss || $foodloss)
    {
        $reportdata .=  "<h1>~ " . $victory_type . " ~</h1>" . str_replace("'", "\'", sprintf($randomvictory[$randvict], $enemy
            [empire], $ploss)) . $structgain . "<br /><br />\n";
    }
    else
    {
        $reportdata .=  "<h1>~ " . $defeat_type . " ~</h1>" . str_replace("'", "\'", sprintf($randomdefeat[$rand], $enemy[
            empire])) . "<br /><br />\n";
    }
	$reportdata .= "<table width=80%><tr><td  valign=top>";
	
	if($utotal_loss >= 1 || $etotal_loss >= 1)
	{
		if($utotal_loss >= 1)
		{
		    $reportdata .=  "<b>Your losses:</b><br />\n";
		    foreach ($config[troop] as $num => $mktcost)
		    {
		        if ($uloss[$num])
		            if (gamefactor($uloss[$num]) >= 1)
					{
						if(commas(gamefactor($uloss[$num])) != 1)
		                	$reportdata.= commas(gamefactor($uloss[$num])) . ' ' . $uera["troop$num"] . "<br />\n";
						else
							$reportdata.= commas(gamefactor($uloss[$num])) . ' ' . $uera["troop$num".'alt'] . "<br />\n";
					}
		    }
		}
		else
			$reportdata .=  "<b>You had no casulties</b>\n";
		$reportdata .= "</td><td class=\'aright\' valign=top>";
		if($etotal_loss >= 1)
		{
		    $reportdata .=  "<b>$enemy[empire] losses:</b><br />\n";
		
		    foreach ($config[troop] as $num => $mktcost)
		    {
//		        if ($eloss[$num])
		            if (gamefactor($eloss[$num]) >= 1)
					{
						if(commas(gamefactor($eloss[$num])) != 1)
		                	$reportdata.= commas(gamefactor($eloss[$num])) . ' ' . $eera["troop$num"] . "<br />\n";
						else
							$reportdata.= commas(gamefactor($eloss[$num])) . ' ' . $eera["troop$num".'alt'] . "<br />\n";
					}
		    }
		}
		else
			$reportdata .=  "<b>$enemy[empire] had no casulties</b>\n";
	}
	else
	{
		$reportdata .=  "<center><b>No casualties</b></center>\n";
	}
$reportdata .= "</table>";
    if ($enemy[land] == 0)
    {
		$reportdata .= '<span class="cgood"><b><?= $enemy[empire] ?> <a class=proflink href=?profile&target='.$enemy[num].$authstr.'>'.$enemy[empire].'</a></b> has been destroyed!</span><br />';
		$users[kills]++;
    }
    else
        if ($what_for == 'land')
        {
        }
    $reportdata .=  "</table>";
    $reportdata .=  $shadowdata['end'];
    $reportdata .=  '';
    if ($landloss)
    	$reportdata .= "<span class=\'success-font\'>You have gained one experience point.</span>";
    mysql_query("UPDATE $playerdb SET lastattackreport='".$reportdata."' WHERE num='$users[num]';");
}

function printRow($num)
{
    global $users, $uera, $trooplist;

//    echo '<tr><td>' . $uera["troop$num"] . '</td>';
 //   echo '<td class="aright">' . commas(gamefactor($users[troop][$num])) . '</td>';
 //   echo '<td class="aright"><input type="text" name="usent[' . $num .
  //      ']" size="8" value="0"></td></tr>';
  $trooplist[] = array('name' => ucwords($uera["troop$num"]), 'owned' => gamefactor($users[troop][$num]), 'sent' => 'usent['.$num.']', 'type' => $uera["troop$num".'type'] );
}

// *************
// End Functions
// *************
if ($users[disabled] == 2) // are they admin?
{
    mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Administrative accounts cannot use offensive actions.' WHERE num='$users[num]';");
    $uri = urldecode($_SERVER['REQUEST_URI']);
    $action = substr($uri, strpos($uri, '?') + 1);
    header("Location: ?" . $action);
    endScript();
}

if ($config['warset'] && $declarewar)
{
    $declareon = $declareon_w;
    fixInputNum($declareon);
    $target = $declareon;
    if (!$target) // specified target?
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='You must specify a target.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($target == $users[num]) // attacking self?
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Cannot declare war on yourself.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($target == $users[peaceset])
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Cannot declare war on someone you are at peace with.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    $enemy = loadUser($target);
    $uclan = loadClan($users[clan]);
    if ($users[clan] != 0 && $enemy[clan] != 0 && ($uclan[ally1] == $enemy[clan] ||
        $uclan[ally2] == $enemy[clan] || $uclan[ally3] == $enemy[clan] || $uclan[ally4] ==
        $enemy[clan] || $uclan[ally5] == $enemy[clan]))
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Cannot declare war on your clan's allies.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }

    if ($users[warset] != 0)
    {
        $mil_error = "You are already at war with another " . $uera[empire] . ".";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }

    $erace = loadRace($enemy[race], $enemy[region]);
    $eera = loadRegion($enemy[region], $enemy[race]);// load enemy info
    if ($config['dual_game'])
        if ($urace[type] == $erace[type])
        {
            $mil_error = "That " . $uera[empire] . " is on your side!";
            mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
            $uri = urldecode($_SERVER['REQUEST_URI']);
            $action = substr($uri, strpos($uri, '?') + 1);
            header("Location: ?" . $action);
            endScript();
        }

    if ($enemy[land] == 0)
    {
        $mil_error = "That " . $uera[empire] . " has already been destroyed.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[clan] == $users[clan] && $users[clan] != 0)
        endScript("That " . $uera[empire] . " is in your clan!");
    {
        $mil_error = "That " . $uera[empire] . " is in your clan.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[disabled] >= 2)
    {
        $mil_error = "Cannot declare war on disabled " . $uera[empire] . "s.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[turnsused] <= $config[protection])
    {
        $mil_error = "Cannot declare war on " . $uera[empire] .
            "s under new player protection.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[vacation] > $config[vacationdelay])
    {
        $mil_error = "Cannot declare war on " . $uera[empire] . "s on vacation.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }

    $users[warset] = $declareon;
    $users[warset_time] = $time + 36 * 3600;
    saveUserData($users, "warset warset_time");
    addNews(603, array(id1 => $users[num], id2 => $enemy[num], clan1 => $enemy[clan],
        clan2 => $users[clan]));
    addNews(601, array(id1 => $enemy[num], id2 => $users[num], clan1 => $enemy[clan],
        clan2 => $users[clan]));

    endScript("You have declared war on $enemy[empire] <a class=proflink href=?profile&target=$enemy[num]$authstr>(#$enemy[num])</a>!");
}
if ($config['peaceset'] && $declarepeace)
{
    $declareon = $declareon_p;
    fixInputNum($declareon);
    $target = $declareon;
    if (!$target) // specified target?
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='You must specify a target.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($target == $users[num]) // attacking self?
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Cannot declare war on yourself.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($target == $users[warset])
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Cannot declare peace with someone you have declared war on.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    $enemy = loadUser($target);
    $uclan = loadClan($users[clan]);
    if ($users[clan] != 0 && $enemy[clan] != 0 && ($uclan[war1] == $enemy[clan] || $uclan
        [war2] == $enemy[clan] || $uclan[war3] == $enemy[clan] || $uclan[war4] == $enemy
        [clan] || $uclan[war5] == $enemy[clan]))
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Cannot declare peace on your clan's enemies.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }

    if ($users[peaceset] != 0)
    {
        $mil_error = "You are already at peace with another " . $uera[empire] . ".";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }

    $erace = loadRace($enemy[race], $enemy[region]);
    $eera = loadRegion($enemy[region], $enemy[race]);// load enemy info
    if ($config['dual_game'])
        if ($urace[type] != $erace[type])
        {
            $mil_error = "That " . $uera[empire] . " is against your side.";
            mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
            $uri = urldecode($_SERVER['REQUEST_URI']);
            $action = substr($uri, strpos($uri, '?') + 1);
            header("Location: ?" . $action);
            endScript();
        }

    if ($enemy[land] == 0)
    {
        $mil_error = "That " . $uera[empire] . " has already been destroyed.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[clan] == $users[clan] && $users[clan] != 0)
    {
        $mil_error = "That " . $uera[empire] . " is in your clan anyways.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[disabled] >= 2)
    {
        $mil_error = "Cannot declare peace on disabled " . $uera[empire] . "s.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[turnsused] <= $config[protection])
    {
        $mil_error = "Cannot declare peace on " . $uera[empire] .
            "s under new player protection.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[vacation] > $config[vacationdelay])
    {
        $mil_error = "Cannot declare peace on " . $uera[empire] . "s on vacation.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }

    $users[peaceset] = $declareon;
    $users[peaceset_time] = $time + 36 * 3600;
    saveUserData($users, "peaceset peaceset_time");
    addNews(606, array(id1 => $users[num], id2 => $enemy[num], clan1 => $enemy[clan],
        clan2 => $users[clan]));
    addNews(605, array(id1 => $enemy[num], id2 => $users[num], clan1 => $enemy[clan],
        clan2 => $users[clan]));

    endScript("You have declared peace on $enemy[empire] <a class=proflink href=?profile&target=$enemy[num]$authstr>(#$enemy[num])</a>!");
}

if ($declare_end_war)
{
    $neut = (($users[warset_time] - $time) / 3600);
    if ($neut > 0)
    {
        $mil_error = "You must wait $neut hours before declaring neutrality.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    $enemy = loadUser($users[warset]);
    $users[warset] = 0;
    $users[warset_time] = $time;
    saveUserData($users, "warset warset_time");
    addNews(604, array(id1 => $users[num], id2 => $enemy[num], clan1 => $enemy[clan],
        clan2 => $users[clan]));
    addNews(602, array(id1 => $enemy[num], id2 => $users[num], clan1 => $enemy[clan],
        clan2 => $users[clan]));
    endScript("You have declared neutrality!");
}

if ($declare_end_peace)
{
    $neut = (($users[peaceset_time] - $time) / 3600);
    if ($neut > 0)
    {
        $mil_error = "You must wait $neut hours before declaring neutrality.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }

    $enemy = loadUser($users[peaceset]);
    $users[peaceset] = 0;
    $users[peaceset_time] = $time;
    saveUserData($users, "peaceset peaceset_time");
    addNews(604, array(id1 => $users[num], id2 => $enemy[num], clan1 => $enemy[clan],
        clan2 => $users[clan]));
    addNews(602, array(id1 => $enemy[num], id2 => $users[num], clan1 => $enemy[clan],
        clan2 => $users[clan]));
    endScript("You have declared neutrality!");
}
if ($do_attack)
{
    if ($users[turns] < 2) // enough turns?
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Not enough turns.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if (!$target) // specified target?
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='You must specify a target.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($target == $users[num]) // attacking self?
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='You cannot attack yourself.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if (!$attacktype)
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='You must create a battle strategy.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($users[health] <= 1)
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Due to the absolute unrest within your empire,<br> your soldiers refuse to fight.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    $enemy = loadUser($target);
    $erace = loadRace($enemy[race], $enemy[region]);
    $eera = loadRegion($enemy[region], $enemy[race]);// load enemy info
    if ($enemy[land] == 0)
    {
        $mil_error = "That " . $uera[empire] . " has already been destroyed.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($config['force_atktype'] != 0 && $enemy[land] <= $config['force_atkland'] &&
        $attacktype != $config['force_atktype'])
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Your enemy's forces are too highly concentrated to attempt a specialized strategy like that.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if (($enemy[region] != $users[region]) && ($users[gate] <= $time) && ($enemy[gate] <=
        $time))
    {
    	$eeera = loadRegion($enemy[region], $enemy[race]);
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='We need to prepare a conquest to $eeera[name] in order to attack this " . strtolower($uera[empire]) . ". A conquest can be prepared by means of a spy operation.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[disabled] >= 2)
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Cannot attack disabled empires.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }

    if ($enemy[turnsused] <= $config[protection])
    {
        $mil_error = "Cannot attack " . $uera[empire] . "s under new player protection.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[vacation] > $config[vacationdelay])
    {
        $mil_error = "Cannot attack " . $uera[empire] . "s on vacation.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[num] == $users[peaceset])
    {
        $mil_error = "Cannot attack " . $uera[empire] . "s you are allied with.";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    $warflag = 0;
    $netmult = 20;

    $prof_target = $enemy[num];//populate fields

    $uclan = loadClan($users[clan]);

    if ($enemy[clan])
        ClanCheck();

    if ($users[warset] == $enemy[num] || $enemy[warset] == $users[num])
    {
        $warflag = 1.2;
        $netmult = 50;
        $warset = 1;
    }

    if ($enemy[networth] > $users[networth] * $netmult)
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Your Generals flatly refuse to attack such a strong opponent.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($users[networth] > $enemy[networth] * $netmult)
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Your Generals politely refuse your orders to attack a defenceless empire.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[networth] > ($users[networth] * 2.5) && $attacktype == "Kamikaze")
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Your Generals flatly refuse to attack such a strong opponent.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($users[networth] > ($enemy[networth] * 2.5) && $attacktype == "Kamikaze")
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Your Generals politely refuse your orders to attack a defenceless empire.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }
    if ($enemy[land] <= $config['force_atkland'] && $attacktype != $config[
        'force_atktype'])
    {
        $mil_error = "Your Generals politely refuse your orders to attack such a small empire with a non-" .
            $config['atknames'][$config['force_atktype']] . ".";
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }

    if ($config['dual_game'])
        if ($urace[type] == $erace[type])
        {
            $mil_error = "That " . $uera[empire] . " is on your side.";
            mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$mil_error' WHERE num='$users[num]';");
            $uri = urldecode($_SERVER['REQUEST_URI']);
            $action = substr($uri, strpos($uri, '?') + 1);
            header("Location: ?" . $action);
            endScript();
        }
    if ($users[turnsused] < 1000 && $attacktype == "Kamikaze")
    {
        mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Your Generals refuse to sacrifice your people before it has even had a chance to grow.' WHERE num='$users[num]';");
        $uri = urldecode($_SERVER['REQUEST_URI']);
        $action = substr($uri, strpos($uri, '?') + 1);
        header("Location: ?" . $action);
        endScript();
    }

    if ($warflag == 0)
    {
        if ($enemy[attacks] > $config['max_attacks'])
        {
            mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Too many recent attacks have been made on that empire.  Try again in one hour.' WHERE num='$users[num]';");
            $uri = urldecode($_SERVER['REQUEST_URI']);
            $action = substr($uri, strpos($uri, '?') + 1);
            header("Location: ?" . $action);
            endScript();
        }
        $revolt = 1;
        if ($users[networth] > $enemy[networth] * 2.5)
        {// Shame is less powerful than fear

?><span class="cwarn">Your military is shamed by your attack on such a weak opponent. Many desert!</span><br />
<?php $revolt = 1 - $users[networth] / $enemy[networth] / 125;
        }
        elseif ($enemy[networth] > $users[networth] * 2.5)
        {

?><span class="cwarn">Your military trembles at your attack on such a strong opponent. Many desert!</span><br />
<?php $revolt = 1 - $enemy[networth] / $users[networth] / 100;
        }
        if ($revolt < .9)
            $revolt = .9;
        if ($users['hero_special'] == 3) // Hestia?
            $revolt = $revolt + (1 - $revolt) / 3;
        foreach ($config[troop] as $num => $mktcost)
            $users[troop][$num] = round($users[troop][$num] * $revolt);
    }
    readInput($attacktype);
    Attack($attacktype);
    // record losses
    losscalc($users, $uloss);
    losscalc($enemy, $eloss);

    $troops1 = $eloss[0];
    $troops2 = $uloss[0];
    foreach ($config[troop] as $num => $mktcost)
    {
        if ($num == 0)
            continue;
        $troops1 .= '|' . ($eloss[$num] == 0 ? '' : $eloss[$num]);
        $troops2 .= '|' . ($uloss[$num] == 0 ? '' : $uloss[$num]);
    }

    $code = 300 + $attacktype;
    $shielded = 0;

    $newsArray = array(id1 => $enemy[num], clan1 => $enemy[clan], id2 => $users[num],
        clan2 => $users[clan], troops1 => $troops1, troops2 => $troops2);
    switch ($what_for)
    {
        case 'land':
            $newsArray[land1] = $landloss;
            $shielded = 1;
            break;
        case 'cash':
            $newsArray[cash1] = $landloss;
            $shielded = 2;
            break;
        case 'food':
            $newsArray[food1] = $landloss;
            $shielded = 3;
            break;
    }

    if ($landloss == 0)
        $shielded += 10;

    $newsArray[shielded] = $shielded;

    addNews($code, $newsArray);

    if ($enemy[land] == 0)
    {
        addNews(399, $newsArray);
    }

    bountyScan($users, $enemy);//We're scanning everytime now.

    $users[attacks] -= 2;
    if ($users[attacks] < 0)
        $users[attacks] = 0;
    $users[offtotal]++;
    if ($landloss)
    {
        $users[offsucc]++;
        $enemy[l_attack] = $users[num];
    }
    else
        $enemy[defsucc]++;
    $enemy[deftotal]++;
    $users[attackpenalty] += $config['attack_penalty'];
    saveUserData($users,
        "networth troops land homes shops industry barracks labs farms towers freeland offsucc offtotal attacks health kills food cash");
    saveUserData($enemy,
        "l_attack networth troops land homes shops industry barracks labs farms towers freeland defsucc deftotal attacks food cash");
    mysql_safe_query("UPDATE $playerdb SET land=(homes+shops+industry+barracks+labs+farms+towers+freeland) WHERE num=$users[num];");
    mysql_safe_query("UPDATE $playerdb SET land=(homes+shops+industry+barracks+labs+farms+towers+freeland) WHERE num=$enemy[num];");
    taketurns(2, attack);
    mysql_safe_query("UPDATE $playerdb SET lastturnoutput='$turnoutput' WHERE num=$users[num];");
    $uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
    header("Location: ?" . $action);
    endScript("");
//    echo $turnoutput;
}
?>
