<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

function printRow ($type, $num='') {
	global $users, $uera, $drecruit, $config, $canrecruit, $recruitrate, $recruitrate_readable;
	
	$type = $type.$num;
	
	
	if($uera[$type.'validfaction'] )
	{
		$drecruit[] = array(
		'id' => $type,
		'name' => ucwords($uera[$type]),
		'description' => $uera[$type."description"],
		'cost' => $config['troop'][$num],
		'meetsPrerequisites' => unitMeetsRequirements($uera, $users, $type),
		'requires' => $uera[$type."requires"],
		'requiresamount' => $uera[$type."requiresamnt"],
		'type' => $type, 'userAmount' => commas($users[$type]),
		'canTrain' => floor($canrecruit[$num]),
		'trainrate' => $recruitrate_readable[$num],
		'hardrate' => $uera[$type."rate"],
		'trainrate_effectuve' => $recruitrate[$num]
		);
	}
}

$drecruit = array();
$userst = $users;
function getTotalTroops() {
	global $users, $config;
	
	for ($i = 1; $i <= 	$config['trooptotal']; $i++)
    {
        $totaltroops += $users["unit_".$config['troopindex'][$i]];
	}
	return gamefactor($totaltroops);
}

function getMaxRecruitablePopulation() {
	global $users, $config;
	
	$maxpop = floor(($users[peasants] * $config['PopulationRecruitLimit']/100) - getTotalTroops());
	if($maxpop < 0)
	{
		$maxpop = 0;
	}
		
	return $maxpop;
}

function getRecruitAmounts ($unit, $num) {
	global $users, $config, $urace, $uera, $recruitrate, $recruitrate_readable, $canrecruit, $totaltroops;

	$factory = $uera[$unit.$num.'requires'];
	$factorybuilding = 'factory'.$factory;
	if(unitMeetsRequirements($uera, $users, $unit.$num)){
		$recruitrate[$num] = $urace[rcrt] * $uera[$unit.$num."rate"] * getBuildings($factorybuilding, $users);
	}
	if($recruitrate[$num] <= 0 || !unitMeetsRequirements($uera, $users, $unit.$num))
		$recruitrate_readable[$num] = "Untrainable";
	elseif($recruitrate[$num] < 1)
		$recruitrate_readable[$num] = ceil(1 / $recruitrate[$num])." turns each";	
	else
		$recruitrate_readable[$num] = floor($recruitrate[$num])." per turn";
	
	$canrecruit[$num] = floor(gamefactor($users[cash]) / $config['troop'][$num]); // limit by money
	if ($canrecruit[$num] > $recruitrate[$num] * getMaxRecruitablePopulation()) // by population limit
		$canrecruit[$num] = $recruitrate[$num] * getMaxRecruitablePopulation();
	if ($canrecruit[$num] > $recruitrate[$num] * $users[turns]) // by turns
		$canrecruit[$num] = $recruitrate[$num] * $users[turns];
}

function recruitUnits ($type, $num, $recruitable) {
	global $users, $userst, $uera, $config, $recruit, $canrecruit, $turns, $turnst, $recruitrate, $totalrecruit, $totalrecruitt, $totalspent, $totalspentt, $msg_error1, $lastrecruitedunit, $totalucost, $startingcash;
	
	$type = $type.$num;
	$amount = $recruit[$type];
	if(!$uera[$type.'validfaction'] && $amount > 0)
	{
		$msg_error1 = "Your faction cannot recruit $uera[$type].";
	}
	else
	{
		$cost = $config['troop'][$num]/$config['game_factor'];
		
		fixInputNum($amount);
		if ($amount < 0)
		{
			$msg_error1 = 'You cannot build a negative number of units.';
		}
		else
		{
			$thisrecruit += $amount;
			if ($recruitrate[$num]) $unit_turns = $amount / $recruitrate[$num];
			$turnstest += $unit_turns;
			if (!unitMeetsRequirements($uera, $users, $type)) 
			{
				$msg_error1 = 'You do not have the prerequisite buildings needed to recruit these troops.';
			}
			elseif ($recruitrate[$num] <= 0) 
			{
				$msg_error1 = 'You do not meet the prerequisites needed to recruit these troops.';
			}
			elseif ($turnstest > $users['turns'])
			{
				$msg_error1 = 'There are not enough turns to recruit that many soldiers.';
			}
			elseif ($thisrecruit > $recruitable)
			{
				$msg_error1 = 'You can\'t recruit that many soldiers.';
			}
			elseif ($startingcash < $totalucost)
			{
				$msg_error1 = 'You do not have the funds needed to recruit these units.';
			}
			else
			{
				$totalspentt += $amount * $cost;
				$totalrecruitt += $amount;
				$turnst += $unit_turns;
				$userst['troop'][$num] += $amount/$config['game_factor'];
				$userst['peasants'] -= $amount;
				$userst['cash'] -= ($amount * $cost); 
				if($amount > 0 && !$multipleunits)
				{
					if ($amount > 1)
						$lastrecruitedunit = $uera[$type];
					else
						$lastrecruitedunit = $uera[$type."alt"];
					$multipleunits= true;
				}
				else if ($amount != 0)
					$lastrecruitedunit = "units";
				//echo $amount." ".$uera[$type]." will take ".$unit_turns." turns, costing ".($amount * $cost)*$config['game_factor']. " gold.<br>";
			}
		}
	}
}
function calculateUnitCosts ($type, $num) {
	global $recruit, $totalucost, $config, $users;
	
	$type = $type.$num;
	$amount = $recruit[$type];
	if($amount != ''){
		$cost = $config['troop'][$num]/$config['game_factor'];
		$totalucost += $amount * $cost;
	}
}

foreach($config[troop] as $num => $mktcost) 
{
	getRecruitAmounts(troop, $num);
}
if ($recruit) { // nothing gets saved until later; if one has invalid input, it'll get caught and will prevent the recruitment
	$totalrecruit = $totalspent = 0;

	foreach($config[troop] as $num => $mktcost) 
	{
		calculateUnitCosts(troop, $num);
	}
	$startingcash = $users['cash'];
	foreach($config[troop] as $num => $mktcost) 
	{
		if ($recruit['troop'.$num])
			recruitUnits(troop, $num, $canrecruit[$num]);
	}
	
if($turnst > 0 && !$msg_error1){
		$totalspent = $totalspentt;
		$totalrecruit = $totalrecruitt;
		$turns = $turnst;
		$users['troop'] = $userst['troop'];
		$users['peasants'] = $userst['peasants'];
		$users['cash'] = $userst['cash']; 
		$turns = ceil($turns);
		takeTurns($turns, recruit);
		saveUserData($users, "troops peasants cash");

		foreach($config[troop] as $num => $mktcost) 
		{
			getRecruitAmounts(troop, $num);
		}
	}
}

foreach($config[troop] as $num => $mktcost) 
{
	printRow(troop, $num);
}

$tpl->assign('types', $drecruit);
$tpl->assign('cnd', $cnd);
$tpl->assign('authstr', $authstr);
$tpl->assign('do_recruit', do_recruit);
$tpl->assign('totalrecruit', $totalrecruit);
$tpl->assign('totalspent', gamefactor($totalspent));
$tpl->assign('turns', commas($turns));
$tpl->assign('err', $msg_error1);
$tpl->assign('lastrecruited', $lastrecruitedunit);

// Load the game graphical user interface
$pagetype = 'military';
initGUI("");
$tpl->display('actions/recruit/recruit.tpl'); 

?>
