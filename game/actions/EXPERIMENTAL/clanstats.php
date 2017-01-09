<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI();
$theuser = $users;
if(empty($sort_type))
	$sort_type = 'totalgreat';

$minmembers = 3;
$members = array(); $totalgreat = array(); $avggreat = array();

$allusers = mysql_safe_query("SELECT clan,networth FROM $playerdb WHERE land>0;");
$unallied = $utotal = 0;
while ($users = mysql_fetch_array($allusers)) {
	if ($n = $users[clan]) {
		$members[$n]++;
		$totalgreat[$n] += $users[networth];
		$avggreat[$n] = commas(round($totalgreat[$n] / $members[$n]));
	}
	else	$unallied++;
	$utotal++;
}

foreach($totalgreat as $id => $great) {
	$totalgreat[$id] = commas($great);
}

if ($unallied == $utotal) {
	$users = $theuser;
	endScript("No clans currently exist!");
}

$sortd = '';
switch ($sort_type) {
case 'members':
	$sortd = "Total Members";
	$sortby = $members;
	break;
case 'avggreat':
	$sortd = "Average ".$config[lang]['greatness'];
	$sortby = $avggreat;
	break;
case 'totalgreat':
	$sortd = "Total ".$config[lang]['greatness'];
	$sortby = $totalgreat;
	break;
}
arsort($sortby);
reset($sortby);
while (list($key,$val) = each($sortby))
	$clan[] = $key;
reset($sortby);
reset($clan);

$tpl->assign('sortd', $sortd);
$tpl->assign('minm', $minmembers);

$clans = array();

$cunlisted = $ctotal = 0;
while (list(,$num) = each($clan)) {
	$uclan = loadClan($num);
	if ($uclan[members] >= $minmembers) {
		if($uclan[url])
			$uclan[name] = "<a href=\"$uclan[url]\" target=\"_blank\">$uclan[name]</a>";

		$uclan['avggreat'] = $avggreat[$uclan['num']];
		$uclan['totalgreat'] = $totalgreat[$uclan['num']];

		$clans[] = $uclan;
	}
	else {
		$cunlisted++;
	}
	$ctotal++;
}


$tpl->assign('clans', $clans);
$tpl->assign('empire_name', $uera[empire]);

$notmade = "$cunlisted/$ctotal (".round($cunlisted/$ctotal*100)."%)";
$indeps = "$unallied/$utotal (".round($unallied/$utotal*100)."%)";

$tpl->assign('notmade', $notmade);
$tpl->assign('indeps', $indeps);

$tpl->display('clanstats.tpl');
?>
