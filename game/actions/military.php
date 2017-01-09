<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

include ($game_root_path.'/header.php');
include ($game_root_path."/lib/magicfun.php");
include ($game_root_path."/lib/military.php");

// Load the game graphical user interface
$pagetype = "war";
initGUI();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!empty($_POST['get_bld']))
        $users[std_bld] = 1;
    else
        $users[std_bld] = 0;
    saveUserData($users, "std_bld");
}

if ($users[turnsused] <= $config[protection]) // are they under protection?
{
	if($users['lastattackreport'] != ''){
		endScript("Military actions cannot be performed under protection.");
	}
}

if ($users['health'] < $config['minhealth'])
{
	if($users['lastattackreport'] != ''){
		mysql_safe_query("UPDATE $playerdb SET lastturnoutput='', lastattackreport='' WHERE num=$users[num];");
		endScript("Military actions cannot be performed under " . $config['minhealth'] . "% health.");
	}
}

foreach ($atktypedata as $num => $name)
{
	$atktypedata[$num]['ValidTypesArr'] = explode(',',(str_replace(" ", "", $atktypedata[$num]['ValidTypes'])));
}

$tpl->assign('err', $current_Error);
if ($users['condense'])
{
	if($users['lastattackreport'] != ''){
		$tpl->assign('showreport', '1');
		$tpl->assign('attackreport', $users['lastattackreport']);
		$tpl->assign('turnoutput', $users['lastturnoutput']);
	}
}
else
{
	if($users['lastattackreport'] != ''){
		$tpl->assign('showreport', '2');
		$tpl->assign('attackreport', $users['lastattackreport']);
		$tpl->assign('turnoutput', $users['lastturnoutput']);
	}
}
?>
<?php
if ($config[warset])
{
    if ($users[warset])
    {
        $warset = loadUser($users[warset]);
        echo "You are currently at war with $warset[empire] <a class=proflink href=?profile&num=$warset[num]$authstr>(#$warset[num])</a>.<br />";
        $peace = (($users[warset_time] - $time) / 3600);
        if ($peace < 0)
        {
            echo "<input type='submit' name='declare_end_war' value='Declare neutrality with #$warset[num]'>";
        }
        else
        {
            echo "You can declare neutrality in " . round($peace) . " hours.<br />";
        }
    }
    else
    {
        echo "You are currently not at war.<br />";
        echo "<input type='submit' name='declarewar' value='Declare War'> on <input type='text' name='declareon_w' length='3'><br />";
    }
    echo '<br /><br />';
}

if ($config['peaceset'])
{
    if ($users[peaceset])
    {
        $peaceset = loadUser($users[peaceset]);
        echo "You are currently at peace with $peaceset[empire] <a class=proflink href=?profile&num=$peaceset[num]$authstr>(#$peaceset[num])</a>.<br />";
        $peace = (($users[peaceset_time] - $time) / 3600);
        if ($peace < 0)
        {
            echo "<input type='submit' name='declare_end_peace' value='Declare neutrality with #$peaceset[num]'>";
        }
        else
        {
            echo "You can declare neutrality in " . round($peace) . " hours.<br />";
        }
    }
    else
    {
        echo "You are currently not at peace with anyone.<br />";
        echo "<input type='submit' name='declarepeace' value='Declare Peace'> on <input type='text' name='declareon_p' length='3'><br />";
    }
    echo '<br /><br />';
}

$uclan = loadClan($users[clan]);
$warquery = "SELECT * FROM $playerdb WHERE land > 0 AND disabled != 3 AND disabled != 2 AND num != $users[num] AND turnsused>$config[protection] AND vacation<=$config[vacationdelay] ORDER BY rank";
$warquery_result = @mysql_safe_query($warquery);
while ($wardrop = @mysql_fetch_array($warquery_result))
{
    if ($wardrop[num] == 1)
        continue;
    $online = '';
    if ($wardrop[online])
        $online = '*';

    $color = "normal";
    $warflag = 0;
    if ($wardrop[clan] != 0 && ($uclan[war1] == $wardrop[clan] || $uclan[war2] == $wardrop
        [clan] || $uclan[war3] == $wardrop[clan] || $uclan[war4] == $wardrop[clan] || $uclan
        [war5] == $wardrop[clan]))
        $warflag = 1;
    $netmult = 20;
    if ($users[warset] == $wardrop[num] || $wardrop[warset] == $users[num])
    {
        $netmult = 50;
        $warflag = 1;
    }

    if ($warflag == 1)
        $color = "good";

    if (($users[networth] > $wardrop[networth] * 2.5) && $warflag == 0)
        $color = "disabled";
    if (($wardrop[networth] > $users[networth] * 2.5) && $warflag == 0)
        $color = "disabled";
    if ($wardrop[networth] > $users[networth] * $netmult)
        $color = "dead";
    if ($users[networth] > $wardrop[networth] * $netmult)
        $color = "dead";

    if (($wardrop[era] != $users[region]) && ($users[gate] <= $time) && ($wardrop[gate] <=
        $time))
        $color = "protected";
    if ($wardrop[attacks] > $config['max_attacks'] && $warflag == 0)
        $color = "protected";

    if ($users[clan] == $wardrop[clan] && $users[clan] != 0)
        $color = "ally";
    if ($wardrop[clan] != 0 && (($uclan[ally1] == $wardrop[clan]) || ($uclan[ally2] ==
        $wardrop[clan]) || ($uclan[ally3] == $wardrop[clan]) || ($uclan[ally4] == $wardrop
        [clan]) || ($uclan[ally5] == $wardrop[clan])))
        $color = "ally";

    $selected = "";
    if ($wardrop[num] == $prof_target)
        $selected = "selected";
  	$warquery_array[] = array('num' => $wardrop[num], 'color' => $color, 'name' => $wardrop['empire'], 'selected' => $selected, 'online' => $online);
}

// Get attack types
foreach ($atknames as $num => $name)
	$atktypes[] = array(num => $num, name => $name);
foreach ($config['atkdescriptions'] as $num1 => $name1)
	$atkdescr1[] = array(num => $num1, name => $name1);

if($atktypes[2][num] == "")
{
	$monoatktype = true;
}
if($attacking['AttackTypes']['Number'] < 1)
{
	endScript("There are no attack types.");
}

// Get Troop Arsenal
foreach ($config[troop] as $num => $mktcost)
    printRow($num);
	
if ($users[std_bld] == 1 )
	$checked = ' checked';
	
	if($users['chk_sendall'] == 1)
	{
		$chk_sendall = ' checked';
	}

foreach ($attacking['AttackTypes'] as $num => $name)
	$atknums = array(num => $num, name => $name);

if(empty($warquery_array))
	$notargets = true;

$tpl->assign('noattacktypes', $monoatktype);
$tpl->assign('atkdata', $atktypedata);
$tpl->assign('prof_target', $prof_target);
$tpl->assign('atknum', $attacking['AttackTypes']['Number']);
$tpl->assign('atknums', $atktypes);
$tpl->assign('atktypes', $atktypes);
$tpl->assign('atkdescr', $atkdescr1);
$tpl->assign('troops', $trooplist);
$tpl->assign('drop', $warquery_array); // VITAL!
$tpl->assign('notargets', $notargets);
$tpl->assign('checked', $checked);
$tpl->assign('cnd', $cnd);
$tpl->assign('chk_sendall', $chk_sendall);
$tpl->assign('err', $current_Error);
$tpl->display('military.tpl');

// Clear last time's attack report (if there is one)
if($users['lastattackreport'] != '')
{
	mysql_safe_query("UPDATE $playerdb SET lastturnoutput='', lastattackreport='' WHERE num=$users[num];");
}
?>
