<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
function getBuyCosts ($type, $num='') {
	global $users, $config, $urace, $costs, $canbuy;
	$ts = $type.$num;
	if($type == 'troop') {
		$umktmt = $users[pmkt][$num];
	}
	else {
		$umktmt = $users["pmkt_$type"];
	}
	$costbonus = 1 - ((1-$config[mktshops])*((getBuildings('tradeincome', $users)*$config['buildingoutput']) / $users[land]) + $config[mktshops]*((getBuildings('income_total', $users)*$config['buildingoutput']) / $users[land]));
	if ($type != 'troop')
		$costs[$ts] = $config[$ts."_buy"];
	else
	{
		$costs[$ts] = $config[troop][$num] * $costbonus;
		if ($costs[$ts] < $config[troop][$num] * .7)
			$costs[$ts] = $config[troop][$num] * .7;
		$costs[$ts] = round($costs[$ts] * $urace[mkt]);
	}
	$canbuy[$ts] = floor($users[cash] / $costs[$ts]);
	if ($canbuy[$ts] > $umktmt)
		$canbuy[$ts] = $umktmt;
}

function buyUnits ($type, $num='') {
	global $costs, $users, $uera, $buy, $canbuy, $msg, $config, $msg_error1;
	$ts = $type.$num;
	$tsalt = $type.$num.'alt';
	$amount = $buy[$ts];
	if($amount == 'max') {
		$amount = $canbuy[$ts];
	}
	else {
		fixInputNum($amount);
		$amount = invfactor($amount);
	}
	$cost = $amount * $costs[$ts];
	$umktmt = 0;
	if($type == 'troop') {
		$umktmt = $users[pmkt][$num];
	}
	else {
		$umktmt = $users["pmkt_$ts"];
	}
	if ($amount == 0)
		return;
	elseif ($amount < 0)
		$msg_error1 .= "Cannot hire a negative amount of $uera[$ts].";
	elseif ($amount > $umktmt)
		$msg_error1 .= "Not enough $uera[$ts] available.";
	elseif ($cost > $users[cash])
		$msg_error1 .= "Not enough money to hire ".commas(gamefactor($amount))." $uera[$ts].";
	else
	{
		$users[cash] -= $cost;
		if($type == 'troop') {
			$users[troop][$num] += $amount;
			$users[pmkt][$num] -= $amount;
		}
		else {
			$users[$type] += $amount;
			$users["pmkt_$ts"] -= $amount;
		}
		$canbuy[$ts] -= $amount;
		if($type != 'food' && $type != 'runes')
		{
			if(gamefactor($amount) == 1)
				$itemname = $uera[$ts.'alt'];
			else
				$itemname = $uera[$ts];
		}
		else
			$itemname = strtolower($uera[$ts]);
		$msg[] = commas(gamefactor($amount))." $itemname hired for ".commas(gamefactor($cost))." gold";
	}
}

foreach($config[troop] as $num => $mktcost) {
	getBuyCosts('troop', $num);
}
getBuyCosts("food");


/**
 * Expects args
 * troop0, troop1, ... , food, runes
**/
function bazaarbuy($args) {
	global $config, $users, $buy, $msg;
	$buy = $args;

	foreach($config[troop] as $num => $mktcost) {
		buyUnits(troop, $num);
	}
	buyUnits("food");
	buyUnits("runes");

	saveUserData($users,"networth cash troops food pvmarket pmkt_food");
	return $msg;
}

?>
