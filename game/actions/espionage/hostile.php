<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
if($php_block == "No") $do_mission = 0;

// Load the game graphical user interface
initGUI("");
include($game_root_path."/lib/magicfun.php");
		$prof_target = $enemy[num];	//populate fields
if ($users['condense'])
{
	if($users['lastmagicreport'] != ''){
		$tpl->assign('showreport', '1');
		$tpl->assign('magicreport', $users['lastmagicreport']);
		$tpl->assign('turnoutput', $users['lastturnoutput']);
	}
}
else
{
	if($users['lastmagicreport'] != ''){
		$tpl->assign('showreport', '2');
		$tpl->assign('magicreport', $users['lastmagicreport']);
		$tpl->assign('turnoutput', $users['lastturnoutput']);
	}
}
		for ($i = 1; $i <= $missions; $i++)
		if ($sptype[$i] == 'o')
		{
			if ($sptype[$i] == 'o' && $first == 0)
			{
				printMRowFirst($i);
				$first++;
			}
			else
			{
				for ($i2 = $i; $sptype[$i] == 'o'; $i++)
			//	if($sptype[$i] == 'd')
					printMRow($i);

			}
		}

		$uclan = loadClan($users[clan]);
		$warquery = "SELECT * FROM $playerdb WHERE land > 0 AND disabled != 3 AND disabled != 2 AND num != $users[num] AND turnsused>$config[protection] AND vacation<=$config[vacationdelay] ORDER BY rank";
		$warquery_result = @mysql_safe_query($warquery);
		while ($wardrop = @mysql_fetch_array($warquery_result)) {
			if ($wardrop[num] == 1)
				continue;
			$online = '';
			if($wardrop[online])
				$online = '*';

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

		//	echo ("$wardrop[empire]: $color\n");


			$selected = "";
			if ($wardrop[num] == $prof_target)
				$selected = "selected";
		//	echo "<option value=\"$wardrop[num]\" class=\"m$color\" $selected >$wardrop[num] - $wardrop[empire]$online</option>\n";
					$warquery_array[] = array('num' => $wardrop['num'], 'color' => $color, 'name' => $wardrop['empire']);
		}

$tpl->assign('opts', $magicrows);
$tpl->assign('prof_target', $prof_target);
$tpl->assign('drop', $warquery_array); // VITAL!
$tpl->assign('optsfirst', $magicrowfirst);
$tpl->assign('cnd', $cnd);
$tpl->assign('err', $current_Error);
$tpl->display('actions/espionage/hostile.tpl');

if ($users[shield] > $time)
	print "<span style='font-size: 9px'>We currently have temporary defences around our ".$uera[empire].",<br /> which will be up for ".round(($users[shield]-$time)/3600,1)." more hours.<br /></span>\n";
if ($users[gate] > $time)
{
	if ($users[gate] > $time && $users[shield] > $time)
		print "<span style='font-size: 9px'>We also ";
	else
		print "<span style='font-size: 9px'>We currently ";

	print "have troops prepared for a distant conquest<br /> which will last for ".round(($users[gate]-$time)/3600,1)." more hours.<br /></span>\n";
	}

		if($users[lastmagicreport] != '')
	mysql_safe_query("UPDATE $playerdb SET lastturnoutput='', lastmagicreport='' WHERE num=$users[num];");
	
endScript("");
?>