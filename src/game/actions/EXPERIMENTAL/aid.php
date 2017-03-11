<?

// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

include($game_root_path."/header.php");
include($game_root_path."/lib/aid.php");
include($game_root_path."/lib/aidcron.php");

$tpl->assign('err', $current_Error);

// Load the game graphical user interface
initGUI("");
#if ($users[disabled] == 2)
#	endScript("Administrators cannot send aid to players!");

$rows = array();

if($_GET['prof_target'])
	$prof_target = $_GET['prof_target'];

function printRow ($type, $num='')
{
	global $users, $uera, $cansend, $convoy, $rows, $rows2;
	if($type == 'troop') {
		$owned = $users[troop][$num];
		$type = $type.$num;
		$rows[] = array(name	=> $uera[$type],
				type	=> $type,
				canSend	=> commas($cansend[$type]),
				owned	=> commas($owned),
				type	=> $type);
	}
	else {
		$owned = $users[$type];
		$rows2[] = array(name	=> $uera[$type],
			type	=> $type,
			canSend	=> commas($cansend[$type]),
			owned	=> commas($owned),
			type	=> $type);
	}
}


calcConvoy();

if ($do_sendaid) {
	$sendtroop = array();
	foreach($config[troop] as $num => $mktcost) {
		if(isset($max["troop$num"]))
			$sendtroop[$num] = 'max';
		else
			$sendtroop[$num] = $send["troop$num"];
	}
	foreach($send as $var => $value) {
		if(isset($max[$var]))
			$send[$var] = 'max';
	}
	fn_aid(array(   to	=> $msg_dest_num,
			troop	=> $sendtroop,
			cash	=> $send[cash],
			food	=> $send[food],
			runes	=> $send[runes])
		);

	echo $turnoutput;
	
	calcConvoy();
}


$warquery_array = array();


$warquery = "SELECT num, empire, land, disabled, clan FROM $playerdb WHERE land>0 AND disabled != 3 AND disabled !=2 AND turnsused>$config[protection] AND num != $users[num] AND land>0 ORDER BY rank";
$warquery_result = @mysql_safe_query($warquery);
while ($wardrop = @mysql_fetch_array($warquery_result)) {
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

if(empty($warquery_array))
	$notargets = true;

foreach($config[troop] as $num => $mktcost) {
	printRow(troop, $num);
}
printRow(cash);
printRow(runes);
printRow(food);

$a = $config[aidtroop];
$ah = "troop$a";
$an = $uera[$ah];
$ao = $users[troop][$a];
$tpl->assign('sendtroop', array('num' => $a, 'name' => $an, 'owned' => $ao, 'handle' => $ah));

$tpl->assign('row', $rows); // VITAL!
$tpl->assign('row2', $rows2); // VITAL!
$tpl->assign('convoy_nocomma', $convoy);
$tpl->assign('convoy', commas($convoy));
$tpl->assign('uera', $uera);
$tpl->assign('notargets', $notargets);
$tpl->assign('users', $users);
$tpl->assign('authstr', $authstr);
$tpl->assign('prof_target', $prof_target);
$tpl->assign('drop', $warquery_array); // VITAL!
$tpl->assign('cnd', $cnd);

$tpl->display('aid.tpl');
?>
