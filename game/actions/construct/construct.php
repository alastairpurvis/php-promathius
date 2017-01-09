<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

$rateincrease = getBuildRate();

function getBuildRate()
{
		global $users, $config, $perturn;
		$masons = gamefactor($users['wizards']);
		$masons += 1; // If nothing else, the player do some manual labor himself ;)
		
		echo $masons.' masons';
		
		$config['buildingrateincrease'] = .005;
		
		$rateincrease = 1;
		for($i = 1; $i < $masons; $i++)
		{
			$rateincrease += $config['buildingrateincrease'];
		}
		$turns = floor(50/$rateincrease);
		if($turns == 0)
			$turns = 1;
		$perturn = floor(1/(50/$rateincrease));
		echo '<br>Rate increase: ' . $rateincrease;
		echo '<br>One mason can build a barracks in ' . 50 . ' turns';
		if($perturn < 1)
			echo '<br>' . $masons . ' masons can build a barracks in ' . $turns . ' turns';
		else
			echo '<br>' . $masons . ' masons can build ' . $perturn . ' barracks per turn';
			
		return $rateincrease;
}

function printBuildingRow ($type, $num='') {
	global $users, $uera, $dbuild, $config, $canbuild, $buildrate, $buildrate_readable;
	
	$sid =  $type.'_'.$num;
	$type = $type.$num;
	
	if($uera[$type.'validfaction'])
	{
		$dbuild[] = array(
		'gid' => $num,
		'id' => $type,
		'nameplural' =>ucwords($uera[$type]),
		'namesingular' =>ucwords($uera[$type.'alt']),
		'description' => $uera[$type."description"],
		'cost' => $config['structure'][$num],
		'land' => $uera[$type."land"],
		'type' => $type, 
		'userAmount' => commas(buildingfactor($users[$sid])),
		'canBuild' => floor($canbuild[$num]),
		'buildrate' => $buildrate_readable[$num],
		'hardrate' => $uera[$type."rate"],
		'buildrate_effectuve' => $buildrate[$num]
		);
	}
}

$dbuild = array();
$userst = $users;

function gettotalbuildings() {
	global $users, $config, $structures;
	
	foreach ($structures as $id => $name)
    {
        $totalbuildings += $users['buildings'][$id];
	}
	return buildingfactor($totalbuildings);
}

function getBuildAmounts ($building, $num) {
	global $users, $config, $urace, $uera, $buildrate, $buildrate_readable, $canbuild, $totalbuildings, $rateincrease;

	$buildrate[$num] = $urace[bpt] * $uera[$building.$num."rate"] * $rateincrease;

	if($buildrate[$num] <= 0)
		$buildrate_readable[$num] = "Unbuildable";
	elseif($buildrate[$num] < 1)
		$buildrate_readable[$num] = ceil(1 / $buildrate[$num])." turns";	
	else
		$buildrate_readable[$num] = floor($buildrate[$num])." per turn";

	if($config['structure'][$num])
		$canbuild[$num] = floor(gamefactor($users[cash]) / $config['structure'][$num]); // limit by money
	else
		$canbuild[$num] = 9999999999;
	if ($canbuild[$num] * $uera[$building.$num."land"] > $users[freeland]) // by land
		$canbuild[$num] = $users[freeland]/$uera[$building.$num."land"];
	if ($canbuild[$num] > $buildrate[$num] * $users[turns]) // by turns
		$canbuild[$num] = $buildrate[$num] * $users[turns];
}

function buildStructures ($type, $num, $buildable) {
	global $users, $userst, $uera, $config, $build, $canbuild, $turns, $turnst, $buildrate, $totalbuilt, $totalbuiltt, $totalspent, $totalspentt, $msg_error1, $totalucost, $totalucostt, $startingcash, $multiplestructures, $lastbuiltstructure;
	
	$type = $type.$num;
	$amount = $build[$type];
	
	if(!$uera[$type.'validfaction'] && $amount > 0)
	{
		$msg_error1 = "Your faction cannot build $uera[$type].";
	}
	else
	{
		$cost = $config['structure'][$num]/$config['game_factor'];
		$land = $uera[$type."land"];
		
		fixInputNum($amount);
		if ($amount < 0)
		{
			$msg_error1 = 'You cannot build a negative number of structures.';
		}
		else
		{
			$thisrecruit += $amount;
			$building_turns = $amount / $buildrate[$num];
			$turnstest += $building_turns;
			if ($buildrate[$num] <= 0) // e.g. no barracks?
			{
				$msg_error1 = 'You do not meet the prerequisites needed to build these structures.';
			}
			elseif ($turnstest > $users['turns'])
			{
				$msg_error1 = 'There are not enough turns to build that many structures.';
			}
			elseif ($thisrecruit > $buildable)
			{
				$msg_error1 = 'You can\'t build that many structures.';
			}
			elseif ($startingcash < $totalucost)
			{
				$msg_error1 = 'You do not have the funds needed to build these structuress.';
			}
			else
			{
				$totalspentt += $amount * $cost;
				$totalbuiltt += $amount;
				$turnst += $building_turns;
				$userst['buildings'][$num] += $amount/$config['game_factor'];
				$userst['cash'] -= ($amount * $cost); 
				$userst['freeland'] -= ($amount * $land); 
				if($amount > 0 && !$multiplestructures)
				{
					if ($amount > 1)
						$lastbuiltstructure = $uera[$type];
					else
						$lastbuiltstructure = $uera[$type."alt"];
					$multiplestructures = true;
				}
				else if ($amount != 0)
					$lastbuiltstructure = "structures";
				//echo $amount." ".$uera[$type]." will take ".$unit_turns." turns, costing ".($amount * $cost)*$config['game_factor']. " gold.<br>";
			}
		}
	}
}
function calculateBuildingCosts ($type, $num) {
	global $build, $totalucost, $config, $users;
	
	$type = $type.$num;
	$amount = $build[$type];
	if($amount != ''){
		$cost = $config['structure'][$num]/$config['game_factor'];
		$totalucost += $amount * $cost;
	}
}

foreach($structures as $num => $mktcost) 
{
	getBuildAmounts(structure, $num);
}
if ($build) 
{ 
	// nothing gets saved until later; if one has invalid input, it'll get caught and will prevent the recruitment
		$totalbuilt = $totalspent = 0;

		foreach($config[structure] as $num => $mktcost) 
		{
			calculateBuildingCosts(structure, $num);
		}
		$startingcash = $users['cash'];
		foreach($config[structure] as $num => $mktcost)
		{
			buildStructures(structure, $num, $canbuild[$num]);
		}
		
	if($turnst > 0 && !$msg_error1)
{
			$totalspent = $totalspentt;
			$totalbuilt = $totalbuiltt;
			$turns = $turnst;
			$users['buildings'] = $userst['buildings'];
			$users['freeland'] = $userst['freeland'];
			$users['cash'] = $userst['cash']; 
			$turns = ceil($turns);
			takeTurns($turns, build);
			saveUserData($users, "buildings freeland cash");

			foreach($structures as $num => $mktcost) 
			{
				getBuildAmounts(structure, $num);
			}
		}
		$users = loadUser($users['num']);
}

foreach($structures as $num => $cost) 
{
	printBuildingRow(structure, $num);
}

$tpl->assign('build', $dbuild);
$tpl->assign('cnd', $cnd);
$tpl->assign('authstr', $authstr);
$tpl->assign('do_build', do_build);
$tpl->assign('totalbuilt', $totalbuilt);
$tpl->assign('totalspent', gamefactor($totalspent));
$tpl->assign('turns', commas($turns));
$tpl->assign('err', $msg_error1);
$tpl->assign('freeland', $users['freeland']);
$tpl->assign('lastbuilt', $lastbuiltstructure);

// Load the game graphical user interface
$pagetype = 'construct';
initGUI("");
$tpl->display('actions/construct/construct.tpl'); 

?>
