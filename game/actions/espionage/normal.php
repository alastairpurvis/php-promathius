<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

include($game_root_path."/lib/magicfun.php");

// Load the game graphical user interface
initGUI("");

if($php_block == "No") 
{
	$do_mission = 0;
}

if ($users['condense'])
{
	if($users['lastmagicreport'] != '')
	{
		$tpl->assign('showreport', '1');
		$tpl->assign('magicreport', $users['lastmagicreport']);
		$tpl->assign('turnoutput', $users['lastturnoutput']);
	}
}
else
{
	if($users['lastmagicreport'] != '')
	{
		$tpl->assign('showreport', '2');
		$tpl->assign('magicreport', $users['lastmagicreport']);
		$tpl->assign('turnoutput', $users['lastturnoutput']);
	}
}
		for ($i = 1; $i <= $missions; $i++)
		if ($sptype[$i] == 'd')
		{
			if ($sptype[$i] == 'd' && $first == 0)
			{
				printMRowFirst($i);
				$first++;
			}
			else
			{
				for ($i2 = $i; $sptype[$i] == 'd'; $i++)
			//	if($sptype[$i] == 'd')
					printMRow($i);
			}
		}

$tpl->assign('opts', $magicrows);
$tpl->assign('optsfirst', $magicrowfirst);
$tpl->assign('cnd', $cnd);
$tpl->assign('err', $current_Error);
$tpl->display('actions/espionage/normal.tpl');

if ($users[shield] > $time)
{
	print "<span style='font-size: 9px'>We currently have temporary defences around our ".$uera[empire].",<br /> which will be up for ".round(($users[shield]-$time)/3600,1)." more hours.<br /></span>\n";
}
if ($users[gate] > $time)
{
	if ($users[gate] > $time && $users[shield] > $time)
		print "<span style='font-size: 9px'>We also ";
	else
		print "<span style='font-size: 9px'>We currently ";
	print "have troops prepared for a distant conquest<br /> which will last for ".round(($users[gate]-$time)/3600,1)." more hours.<br /></span>\n";
}
if($users[lastmagicreport] != '')
{
	mysql_safe_query("UPDATE $playerdb SET lastturnoutput='', lastmagicreport='' WHERE num=$users[num];");
}

?>
