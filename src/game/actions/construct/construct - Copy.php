<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

$dbuild = array();
$dbuildOld = array();

function printRow ($type) {
	global $users, $uera, $canbuild, $dbuild;
	$dbuild[] = array('name' => $uera[$type], 'type' => $type, 'userAmount' => commas($users[$type]), 'canBuild' => commas($canbuild), 'description' => $uera[$type.'_description']);
}
function printRowOld ($type) {
		global $users, $uera, $canbuild, $dbuildOld, $build;
			$dbuildOld[] = array('name' => $uera[$type], 'type' => $type, 'userAmount' => commas($users[$type] - $build[$type]), 'canBuild' => commas($canbuild), 'description' => $description[$type]);
			}

function getBuildAmounts () {
	global $users, $config, $urace, $buildcost, $buildrate, $canbuild;
	$buildcost = round($config[buildings] + ($users[land] * 0.1));
	$buildrate = $users[land] * 0.015 + 4;
	// if ($buildrate > 400)	$buildrate = 400;
	$buildrate = round($urace[bpt] * $config['buildspeed'] * $buildrate);
	if($buildrate < 1)
		$buildrate = 1;
	$canbuild = floor($users[cash] / $buildcost); // limit by money
	if ($canbuild > $buildrate * $users[turns]) // by turns
		$canbuild = $buildrate * $users[turns];
	if ($canbuild > $users[freeland]) // and by land
		$canbuild = $users[freeland];
}

function buildStructures ($type, $cost) {
	global $users, $build, $totalbuild, $totalspent, $max, $canbuild;
	$amount = $build[$type];
	fixInputNum($amount);
	if ($amount < 0)
	{
		printRow(homes);
		printRow(shops);
		printRow(barracks);
		printRow(industry);
		printRow(labs);
		printRow(farms);
		printRow(towers);
		$tpl->assign('cnd', $cnd);
		$tpl->assign('authstr', $authstr);
		$tpl->assign('build', $dbuild);
		$tpl->assign('freeland', commas($users[freeland]));
		$tpl->assign('canbuild', commas($canbuild));
		$tpl->assign('canbuildnocommas', $canbuild);
		$tpl->assign('buildrate', commas($buildrate));
		$tpl->assign('buildcost', commas($buildcost));
		$tpl->assign('turns', commas($turns));
		$tpl->assign('totalbuild', commas($totalbuild));
		$tpl->assign('totalspent', commas($totalspent));
		// Load the game graphical user interface
initGUI();
		$error = "It is not possible to build a negative number of structures.";
		$tpl->assign("err", $error);
		$tpl->display('build.tpl');
		endScript();
//		endScript("Cannot build a negative number of structures!");
	}
	if (isset($max[$type]))
		$amount = $canbuild;

	$users[$type] += $amount;
	$totalbuild += $amount;
	$users[freeland] -= $amount;
	$users[cash] -= $amount * $cost;
	$totalspent += $amount * $cost;
}
function buildStructuresOld ($type, $cost) {
	global $users, $build, $totalbuild, $totalspent, $max, $canbuild;
	$amount = $build[$type];
	fixInputNum($amount);
	if (isset($max[$type]))
		$amount = $canbuild;

	$totalbuild -= $amount;
	$users[freeland] += $amount;
	$users[cash] += $amount * $cost;
	$totalspent -= $amount * $cost;
}

getBuildAmounts();
if ($do_build) { // nothing gets saved until later; if one has invalid input, it'll get caught and will prevent the build
	$totalbuild = $totalspent = 0;
	buildStructures(homes, $buildcost);
	buildStructures(shops, $buildcost);
	buildStructures(industry, $buildcost);
	buildStructures(barracks, $buildcost);
	buildStructures(labs, $buildcost);
	buildStructures(farms, $buildcost);
	buildStructures(towers, $buildcost);
	if($totalbuild == 0)
	{
		$uri = urldecode($_SERVER['REQUEST_URI']);
		$action = substr($uri, strpos($uri, '?') + 1);
		header("Location: ?" . $action); 
	}
	if ($totalbuild > $canbuild) // this takes into account turns, money, AND free land all at once
	{
		buildStructuresOld(homes, $buildcost);
		buildStructuresOld(shops, $buildcost);
		buildStructuresOld(industry, $buildcost);
		buildStructuresOld(barracks, $buildcost);
		buildStructuresOld(labs, $buildcost);
		buildStructuresOld(farms, $buildcost);
		buildStructuresOld(towers, $buildcost);
		printRowOld(shops);
		printRowOld(homes);
		printRowOld(barracks);
		printRowOld(industry);
		printRowOld(labs);
		printRowOld(farms);
		printRowOld(towers);
		$tpl->assign('cnd', $cnd);
		$tpl->assign('authstr', $authstr);
		$tpl->assign('build', $dbuildOld);
		$tpl->assign('freeland', commas($users[freeland]));
		$tpl->assign('canbuild', commas($canbuild));
		$tpl->assign('canbuildnocommas', $canbuild);
		$tpl->assign('buildrate', commas($buildrate));
		$tpl->assign('buildcost', commas($buildcost));
		$tpl->assign('turns', commas($turns));
		$tpl->assign('totalbuild', $totalbuild);
		$tpl->assign('totalspent', commas($totalspent));
		// Load the game graphical user interface
initGUI();
		$error = "To raise these buildings with our meager resources at this time would require_once that you be a god, good king.";
		$tpl->assign("err", $error);
		$tpl->display('build.html');
		endScript();
//		endScript("You can't build that many!");
	}
	if ($users[cash] < 0) // in case we decide to add variable building costs
	{
		buildStructuresOld(homes, $buildcost);
		buildStructuresOld(shops, $buildcost);
		buildStructuresOld(industry, $buildcost);
		buildStructuresOld(barracks, $buildcost);
		buildStructuresOld(labs, $buildcost);
		buildStructuresOld(farms, $buildcost);
		buildStructuresOld(towers, $buildcost);
		printRowOld(shops);
		printRowOld(homes);
		printRowOld(barracks);
		printRowOld(industry);
		printRowOld(labs);
		printRowOld(farms);
		printRowOld(towers);
		$tpl->assign('cnd', $cnd);
		$tpl->assign('authstr', $authstr);
		$tpl->assign('build', $dbuild);
		$tpl->assign('freeland', commas($users[freeland]));
		$tpl->assign('canbuild', commas($canbuild));
		$tpl->assign('canbuildnocommas', $canbuild);
		$tpl->assign('buildrate', commas($buildrate));
		$tpl->assign('buildcost', commas($buildcost));
		$tpl->assign('turns', commas($turns));
		$tpl->assign('totalbuild', commas($totalbuild));
		$tpl->assign('totalspent', commas($totalspent));
		// Load the game graphical user interface
initGUI();
		$error = "We do not have the gold to commence this contruction project.";
		$tpl->assign("err", $error);
		$tpl->display('build.html');
		endScript();
//		endScript("You don't have enough money!");
	}
	$turns = ceil($totalbuild / $buildrate);

	takeTurns($turns, build);
	saveUserData($users, "homes shops industry barracks labs farms towers freeland cash");

	getBuildAmounts();
}
	printRow(homes);
	printRow(shops);
	printRow(barracks);
	printRow(industry);
	printRow(labs);
	printRow(farms);
	printRow(towers);

$tpl->assign('cnd', $cnd);
$tpl->assign('authstr', $authstr);
$tpl->assign('do_build', do_build);
$tpl->assign('build', $dbuild);
$tpl->assign('freeland', commas($users[freeland]));
$tpl->assign('canbuild', commas($canbuild));
$tpl->assign('canbuildnocommas', $canbuild);
$tpl->assign('buildrate', commas($buildrate));
$tpl->assign('buildcost', commas($buildcost));
$tpl->assign('turns', commas($turns));
$tpl->assign('totalbuild', commas($totalbuild));
$tpl->assign('totalspent', commas($totalspent));
// Load the game graphical user interface
initGUI();
	echo $turnoutput;
$tpl->display('actions/construct/construct.tpl');

$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$finish = $time;
$totaltime = ($finish - $start);
printf ("Page generated in %f seconds.", $totaltime);

?>
