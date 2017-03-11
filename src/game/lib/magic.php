<?
/**
* current spell functions
* args:
* times
* OR
* target
**/
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
function terminate($action, $turnoutput)
{
    global $users, $playerdb;
    mysql_safe_query("UPDATE $playerdb SET lastturnoutput='$turnoutput' WHERE num=$users[num];");
    $uri = urldecode($_SERVER['REQUEST_URI']);
    $action = substr($uri, strpos($uri, '?') + 1);
    header("Location: ?" . $action);
}

function doMagicErrorPage($error)
{
    global $tpl;
    $tpl->assign("err", $error);
    echo "<span class='error-font'><b>" . $error . "</b></span><br /><br /><br />";
    endScript('');
}

function missionSucceed($msg)
{
    global $uera, $users, $playerdb, $shadowdata;
    echo '<h1>Mission Success</h1>';
    echo 'Your ' . $uera[wizards] .
        ' performed the mission and it was <span class="cgood">successful</span>!<br />';
    echo $msg;
    echo '<br /><br />';
    // New Mission Succeed
    $reportdata = "<table border=\'0\' cellspacing=\'0\' cellpadding=\'0\' width=380>
	<tr>
	<td class=shlarge rowspan=2 style=\'text-align:center;padding-top:5px;padding-bottom:15px\'>
	<table width=340 cellpadding=2><tr><td class=\'acenter\'>";
    $reportdata .= "<h1>~ Mission Success ~</h1><br />" . str_replace("'", "\'",$msg);
    $reportdata .= "</table>";
    $reportdata .= $shadowdata['end'];
    if ((microtime() * 10) - (gamefactor($users['wizards']) / 5000) > 5)
    {
        $users[espsucc]++;
        $reportdata .= "<span class=\'success-font\'>You have gained one espionage point.</span>";
    }
    $users[esptotal]++;
    mysql_query("UPDATE $playerdb SET lastmagicreport='" . $reportdata .
        "', espsucc='" . $users[espsucc] . "', esptotal='" . $users[esptotal] .
        "' WHERE num='$users[num]';");

}

function missionFail($msg =
    '<h1>Mission Failed</h1>Your %wizards% are <span class="cbad">foiled!</span><br />')
{
    global $users, $uera, $wizloss, $total_wizloss, $failed;
    echo str_replace('%wizards%', $uera['wizards'], $msg);
    if ($wizloss > 0)
        echo commas(gamefactor($wizloss)) . " $uera[wizards] are killed!";
    else
        echo "Luckily, they were able to escape without getting killed.";
    echo '<br /><br />';
    $users[wizards] -= $wizloss;
    $failed = 1;
}

function missionShielded()
{
    global $uera;
    echo '<span class="cwarn">...though the enemy\'s ' . $uera[wizards] .
        ' prevented too much damage.</span><br />';
}

function CastMission($num)
{
    global $spfuncs, $called;
    $called = $spfuncs[$num];
    call_user_func($spfuncs[$num]);
}

function getRatios()
{
    global $uratio, $lratio, $eratio, $users, $enemy, $urace, $erace;

    $uwiz = $users[wizards];
    //	if($uwiz > $users[labs] * 175;
    //		$uwiz = $users[labs] * 175;

    if ($enemy)
    {
        $ewiz = $enemy[wizards];
        //		if($ewiz > $enemy[labs] * 175;
        //			$ewiz = $enemy[labs] * 175;
    }

    if (getBuildings('runes', $users)) // for defence, wizards/towers
        $lratio = $uwiz / getBuildings('runes', $users) * $urace[magic];
    else
        $lratio = 0;

    if ($enemy && $enemy[land] != 0)
    {
        $uratio = $uwiz / (($users[land] + $enemy[land]) / 2) * $urace[magic];
        $eratio = $ewiz / $enemy[land] * 1.05 * $erace[magic];
    }
}

getRatios();

function do_magic($spellname, $args)
{
    global $spnumbyname, $sptype, $spcost, $spratio, $spname, $spfuncs, $gamblemessage,
        $enemy, $eera, $erace;
    global $failed, $produced, $total_wizloss, $wizloss, $hide_turns, $all_t_output,
        $turnoutput;
    global $users, $urace, $uera, $uclan, $config, $uratio, $eratio, $lratio, $config,
        $time;
    $failed = 0;
    $oldhealth = $users[health];

    $mission_num = $spnumbyname[$spellname];
    $num_times = $args[times];
    $erace = loadRace($enemy[race], $enemy[region]);
    $eera = loadRegion($enemy[region], $enemy[race]);
    if ($mission_num == 0)
    {
        doError("An operation must be specified.");
    }
    if ($users[turns] < $num_times * 2)
    {
        doError("Not enough turns.");
    }
    if ($users[runes] < $spcost["$mission_num"])
    {
        doError("There are not enough " . strtolower($uera[runes]) .
            " to perform this operation.");
    }
    if ($users[health] < 0)
    {
        doError("Due to their waning health, your $uera[wizards] cannot perform any operations.");
    }
    if ($num_times < 1 || $num_times > $users[turns] * 2)
        $num_times = 1;

    if ($spellname == 'missiongamble' && $num_times != 1)
    {
        doError("A gamble may only be performed once at a time.");
    }
    if ($sptype[$mission_num] == o)
    {// offense mission?
        if (empty($args[target]))
            doError("A target must be made.");
        $target = $args[target];
        if ($target == $users[num])
            doError("It would be foolish to attack yourself.");
        $enemy = loadUser($target);

        if ($enemy[num] != $target)
            doError("There is no such " . $uera[empire] . " in existence.");
        $erace = loadRace($enemy[race], $enemy[region]);
        $eera = loadRegion($enemy[region], $enemy[race]);
        if ($enemy[land] == 0)
            doError("This " . $uera[empire] . " is gone, locked in the books of history.");
        if (($users[clan] > 0) && ($users[clan] == $enemy[clan]))
            doError("It would be unwise to attack a " . $uera[empire] .
                " within your own clan.");
        if ($enemy[land] == 0)
            doError("That " . $uera[empire] . " is destroyed.");
        if ($enemy[disabled] >= 2)
            doError("This " . $uera[empire] . " has been disabled.");
        if ($enemy[turnsused] <= $config[protection])
            doError("This " . $uera[empire] . " is still under new player protection.");
        if ($enemy[vacation] > $config[vacationdelay])
            doError("The owner of this " . $uera[empire] .
                " is away at this time. His/her account has been frozen.");
        if (($enemy[region] != $users[region]) && ($users[gate] <= $time) && ($enemy[gate] <=
            $time))
        {
            doError($eera['ename'] .
                " is too far. An expedition to these lands will have to be made in order carry out any kind of undercover operations on this " .
                $uera[empire] . ".");
        }
        if ($sptype[$num] == o && $config['dual_game'])
            if ($urace[type] == $erace[type])
            {
                doError("This " . $uera[empire] . " is on your side.");
            }

        $warflag = 0;
        $netmult = 10;
        if ($enemy[clan])
        {
            if ($users[clan] == $enemy[clan])
            {
                doError("It would be unwise to attack a " . $uera[empire] .
                    " within your own clan.");
            }
            if ($enemy[clan] != 0 && $users[clan] != 0)
            {
                if (($uclan[ally1] == $enemy[clan]) || ($uclan[ally2] == $enemy[clan]) || ($uclan
                    [ally3] == $enemy[clan]) || ($uclan[ally4] == $enemy[clan]) || ($uclan[ally5] ==
                    $enemy[clan]))
                {
                    doError("Your Generals refuse to attack an ally.");
                }
                if (($uclan[war1] == $enemy[clan]) || ($uclan[war2] == $enemy[clan]) || ($uclan
                    [war3] == $enemy[clan]) || ($uclan[war4] == $enemy[clan]) || ($uclan[war5] == $enemy
                    [clan]))
                {
                    $warflag = 1;
                    $netmult = 30;
                }
            }
        }

        if ($users[warset] == $enemy[num])
            $warflag = 1;

        if ($mission_num != 1)
        {
            if ($enemy[networth] > $users[networth] * $netmult && $enemy[clan] != 0)
            {
                doError("Your $uera[wizards] refuse to target such a strong power.");
            }
            if ($users[networth] > $enemy[networth] * $netmult && $enemy[clan] != 0)
            {
                doError("Your $uera[wizards] politely refuse your orders to target a defenceless " .
                    $uera[empire] . "!");
            }
            if ($warflag == 0)
            {
                if ($enemy[attacks] > $config['max_attacks'])
                {
                    doError("Too many recent attacks have been made on that " . $uera[empire] .
                        ". It may be possible to try again in the next hour.");
                }
                $revolt = 1;
                if ($users[networth] > $enemy[networth] * 2.5)
                {// Shame is less powerful than fear
                    echo '<span class="cwarn">Your ' . $uera[wizards] .
                        ' are shamed by your attack on such a weak opponent.<br /> Many desert.</span><br />';
                    $revolt = 1 - $users[networth] / $enemy[networth] / 125;
                }
                elseif ($enemy[networth] > $users[networth] * 2.5)
                {
                    echo '<span class="cwarn">Your ' . $uera[wizards] .
                        ' tremble at your attack on such a strong opponent.<br /> Many desert.</span><br />';
                    $revolt = 1 - $users[networth] / $enemy[networth] / 100;
                }
                if ($revolt < .9)
                    $revolt = .9;
                $users[wizards] = ceil($users[wizards] * $revolt);
            }
            if ($warflag == 0)
                $enemy[attacks]++;
            $users[attacks] -= 2;
            if ($users[attacks] < 0)
                $users[attacks] = 0;
            $users[health] -= 4;
            $users[esptotal]++;
            $enemy[esptotal]++;
        }
        getRatios();
    }
    if ($users[labs]) // for defence, wizards/towers
        $lratio = $users[wizards] / getBuildings('runes', $users) * $urace[magic];
    else
        $lratio = 0;

    // lose 1%-5% of your wizards if mission fails
    $wizloss = mt_rand(ceil($users[wizards] * .01), ceil($users[wizards] * .05 + 1));
    if ($wizloss > $users[wizards])
        $wizloss = $users[wizards];
    //print("Wizloss calced during do_magic reads: $wizloss with total, $total_wizloss (added after statement)");
    $total_wizloss += $wizloss;

    if ($num_times * 2 > $users[turns])
    {
        doError("You have not the turns require_onced.");
    }

    ob_start();
    $i = 0;
    $oldturns = $users[turns];

    $all_t_output = '';

    global $turnoutput, $missions, $shmod, $users;
    $taken = 0;
    for ($i = 0; $i < $num_times; $i += 1)
    {
        if ((1 <= $mission_num) && ($mission_num <= $missions))
        {
            if ($enemy[shield] > $time)
                $shmod = 1 / 3;
            else
                $shmod = 1;

            CastMission($mission_num);
        }
        if ($users[runes] < $spcost[$mission_num])
            break;
        $users[runes] -= $spcost[$mission_num];
        saveUserData($users, "attacks espsucc esptotal kills");
        if ($enemy[num])
            saveUserData($enemy, "l_attack attacks espsucc deftotal");

        global $noutput;
        $noutput = true;
        $taken += 2;
        takeTurns(2, magic, $noutput, $taken);

        if (!$hide_turns)
            $all_t_output .= $turnoutput;

        if ($users[cash] <= 0 || $users[food] <= 0 || $users[runes] <= 0 || $failed == 1)
            break;
    }

    if ($sptype[$mission_num] == d)
    {
        if ($failed != 1)
        {
            switch ($spellname)
            {
                case 'missionshield':
                    missionSucceed("Your " . strtolower($uera[wizards]) .
                        " have setup temporary defences around your " . $uera[empire] . "!");
                    break;
                case 'missionfood':
                    missionSucceed("Your " . strtolower($uera[wizards]) . " have foraged up " .
                        commas(gamefactor($produced)) . " food!");
                    break;
                case 'missiongold':
                    missionSucceed("Your " . strtolower($uera[wizards]) .
                        " have managed to sqeeze out " . commas(gamefactor($produced)) .
                        " gold <br /> from an intensive taxing campaign.");
                    break;
                case 'missioned':
                    missionSucceed("Your " . strtolower($uera[wizards]) . " have expanded your " . $uera
                        [empire] . "'s borders by " . commas($produced) . " acres. However, some " .
                        strtolower($uera[wizards]) . ", food, and cash were lost in the effort.");
                    break;
                case 'missionheal':
                    missionSucceed("Your $uera[wizards] have fixed your " . $uera[empire] .
                        "'s damages. Your health incresases by " . ($users[health] - $oldhealth) . "%.");
                    break;
                case 'missiongate':
                    missionSucceed("Your " . strtolower($uera[wizards]) .
                        " have made the preparations necessary for a distant conquest.");
                    terminate($action, $turnoutput);
                    break;
                case 'missionungate':
                    missionSucceed("You have recalled your " . strtolower($uera[wizards]) . ".");
                    break;
                case 'missionadvance':
                    missionSucceed("Your $uera[wizards] have coordinated the movement of your entire army Eastwards.");
                    break;
                case 'missionsouth':
                    missionSucceed("Your $uera[wizards] have coordinated the movement of your entire army Westwards.");
                    break;
                case 'missionkill':
                    missionSucceed("Your $uera[wizards] have completed the ritual suicide of your troops and workers!");
                    break;
                case 'missionprod':
                    missionSucceed("Your $uera[wizards] have 'prodded' the market...");
                    break;
                case 'missionpeasant':
                    missionSucceed("Your $uera[wizards] have managed to enslave " . commas($produced) .
                        " workers into your " . $uera[empire] . ".");
                    break;
                case 'missiongamble':
                    missionSucceed($gamblemessage);
            }
        }
    }

    if ($all_t_output == '')
        $all_t_output = $turnoutput;
	terminate($action, $turnoutput);
    return $all_t_output;
}

function fn_murder($args)
{
    do_magic('missionblast', $args);
}
function fn_raisedefences($args)
{
    do_magic('missionshield', $args);
}
function fn_poison($args)
{
    do_magic('missionstorm', $args);
}
function fn_destroyrunes($args)
{
    do_magic('missionrunes', $args);
}
function fn_destroystructures($args)
{
    do_magic('missionstruct', $args);
}
function fn_hawkforage($args)
{
    do_magic('missionfood', $args);
}
function fn_hawkloot($args)
{
    do_magic('missiongold', $args);
}
function fn_hawkscout($args)
{
    do_magic('missioned', $args);
}
function fn_hawkheal($args)
{
    do_magic('missionheal', $args);
}
function fn_recruit($args)
{
    do_magic('missionpeasant', $args);
}
function fn_prodmarket($args)
{
    do_magic('missionprod', $args);
}
function fn_seppuku($args)
{
    do_magic('missionkill', $args);
}
function fn_preparehawks($args)
{
    do_magic('missiongate', $args);
}
function fn_recallhawks($args)
{
    do_magic('missionungate', $args);
}
function fn_hawkattack($args)
{
    do_magic('missionfight', $args);
}
function fn_embezzle($args)
{
    do_magic('missionsteal', $args);
}
function fn_rob($args)
{
    do_magic('missionrob', $args);
}
function fn_movenorth($args)
{
    do_magic('missionadvance', $args);
}
function fn_movesouth($args)
{
    do_magic('missionsouth', $args);
}

?>
