<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
function sendUnits ($type) {
	global $users, $uera, $enemy, $eera, $cansend, $send, $config;

	$amount = $send[$type];
	
	if ($amount == 0)
		return;
	elseif ($amount < 0)
	{
			mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Cannot send a negative amount of $uera[$type].' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}
	elseif ($amount > $users[$type]) {
		switch($type) {
			case cash:{			$aid_error="You do not have that much gold.";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript(); 
	break;}
			case food:{
						$aid_error="You do not have that much ".strtolower( $uera[food]).".";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript(); 
	break;}
			case runes:{
			$aid_error="You don't have that many ".strtolower($uera[runes]).".";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript(); 
	break;}
			default:{$aid_error="You do not have that many ".strtolower($uera[$type]).".";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript(); 
	break;}
		}
	}
	elseif ($amount > $cansend[$type]) {
		switch($type) {
			case cash:{	$aid_error="You cannot send more than 20% of your gold.";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript(); 
	break;}
			case food:{	$aid_error="You cannot send more than 20% of your ".strtolower($uera[food]).".";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript(); 
	break;}
			case runes:{$aid_error="You cannot send more than 20% of your ".strtolower($uera[runes]).".";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript(); 
	break;}
			default:{$aid_error="You cannot send more than 20% of your ".strtolower($uera[$type]).".";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript(); 
	break;}
		}

		$aid_error="You cannot send more than 20% of your ".strtolower($uera[$type]).".";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript(); 
	break;
	}
	else {
		$users[$type] -= $amount;
		$enemy[$type] += $amount;
	}
}
function doAidPage($error){
		global $tpl, $users, $uera, $enemy, $eera, $cansend, $send, $config;
		$tpl->assign("err", $error);
		echo "<span class='error-font'><b>" . $error . "</b></span><br /><br /><br />";
		endScript('');
	}

function calcConvoy() {
	global $convoy, $cansend, $users, $config;
	$tn = $config[aidtroop];

	$convoy = floor((12 * $users[networth] / 10000) * $config[troop][0] / $config[troop][$tn] * (500/$config[troop][0]));
	$convoy = invfactor(gamefactor($convoy));	// ROUNDING -- IMPORTANT!

	foreach($config[troop] as $num => $mktcost) {
		$cansend["troop$num"] = round(0.20 * $users[troop][$num]);
	}
	$cansend[cash] = round($users[cash] * .20);
	$cansend[runes] = round($users[runes] * .20);
	$cansend[food] = round($users[food] * .20);
}



/**
 * expected args:
 * to, troop array, cash, food, runes
**/
function fn_aid($args) {
	global $users, $uera, $config, $all_races, $urace, $enemy, $send, $tpl;
	$tn = $config[aidtroop];
	calcConvoy();
	global $convoy, $cansend;

	$users[aidcred]--;
	
	if ($users[turnsused] <= $config[protection])
	{
	$tpl->display('aid.tpl');
		$error = "Aid cannot be sent while your empire is in protection.";
				doAidPage($error);
		}
	if(!isset($args['to']))
	{
					mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='You must specify who you wish to send aid to.' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}
	if ($users[turns] < 2)
	{
	$tpl->display('aid.tpl');
	{
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='There are not enough turns availiable to send aid.' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
				}
		}

	$dest = $args[to];
	fixInputNum($dest);

	if($dest == 0)
		{
					mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='You must specify who you wish to send aid to.' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}
	if ($dest == $users[num])
	{
					mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='Unless you are a god, you cannot send aid to yourself.' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}
	if ($users[troop][$tn] < $convoy)
	{
		$aid_error="You do not have that many ".strtolower($uera["troop$tn"]).".";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}

	$send = array(	cash   => $args[cash],
			food   => $args[food],
			runes  => $args[runes]);

	foreach($args[troop] as $num => $sendamt) {
		$send["troop$num"] = $sendamt;
	}

	foreach($send as $type => $amt) {
		if($send[$type] == 'max')
			$send[$type] = $cansend[$type];
		else
			$send[$type] = invfactor($amt);
		fixInputNum($send[$type]);
	}

	if ($send["troop$tn"] < $convoy)
	{
		$aid_error="You must send at least ".commas(gamefactor($convoy))." ".strtolower($uera["troop$tn"]).".";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
}

	$enemy = loadUser($dest);
	$eera = loadRegion($enemy[region], $enemy[race]);

	if ($enemy[num] != $dest)
	{
		$aid_error="No such $uera[empire].";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}
	if ($enemy[land] == 0){
		$aid_error="That $uera[empire] was destroyed.";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}
	if (($enemy[region] != $users[region]) && ($enemy[gate] <= $time) && ($users[gate] <= $time)){
		$aid_error="In order to send aid to this far away $uera[empire], you need to prepare ".strtolower($uera[wizards])." first.";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}
	if ($enemy[disabled] >= 2){
		$aid_error="You cannot send aid to a disabled/admin $uera[empire].";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}
	if ($enemy[turnsused] <= $config[protection]){
		$aid_error="These peoples are under protection, and cannot have aid sent to them.";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}
	if ($enemy[vacation] > $config[vacationdelay]){
		$aid_error="This $uera[empire] is under protection.";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}
	if ($enemy[networth] > $users[networth] * 3){
		$aid_error="That ".$uera[empire]." is far too large to require_once your aid.";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}
	if ($users[warset] == $enemy[num] || $enemy[warset] == $users[num]){
		$aid_error="You cannot send aid to warring ".$uera[empire]."s!";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}

	if($config['dual_game'])
		if($all_races[$enemy[race]][type] != $urace[type])
		{
			$aid_error="That ".$uera[empire]." is on the opposite side.";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}

	$uclan = loadClan($users[clan]);
	if ($enemy[clan] != 0 && $users[clan] != 0) {
		if (	
			($uclan[war1] == $enemy[clan]) ||
			($uclan[war2] == $enemy[clan]) ||
			($uclan[war3] == $enemy[clan]) ||
			($uclan[war4] == $enemy[clan]) ||
			($uclan[war5] == $enemy[clan])
			)
			{
			$aid_error="Your Generals laugh at the idea of sending aid to your enemies.";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
			}
		if (	
			($uclan[ally1] == $enemy[clan]) ||
			($uclan[ally2] == $enemy[clan]) ||
			($uclan[ally3] == $enemy[clan]) ||
			($uclan[ally4] == $enemy[clan]) ||
			($uclan[ally5] == $enemy[clan]) ||
			$uclan[num] == $enemy[clan])
			$users[aidcred]++;	// unlimited aid to allies
	}

	if ($users[peaceset] == $enemy[num])
		$users[aidcred]++;	// unlimited aid to allies

	if ($users[aidcred] < 0)
	{
			$aid_error="You cannot send any more aid.";
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='$aid_error' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
		}

	foreach($config[troop] as $num => $mktcost) {
		$users["troop$num"] = $users[troop][$num];
		$enemy["troop$num"] = $enemy[troop][$num];
	}

	foreach($config[troop] as $num => $mktcost) {
		sendUnits("troop$num");
	}
	sendUnits(cash);
	sendUnits(runes);
	sendUnits(food);

	foreach($config[troop] as $num => $mktcost) {
		$users[troop][$num] = $users["troop$num"];
		$enemy[troop][$num] = $enemy["troop$num"];
	}

	$cash = $send[cash];	unset($send[cash]);
	$runes = $send[runes];	unset($send[runes]);
	$food = $send[food];	unset($send[food]);
	$troops = join("|", $send);

	addNews(102, array(id1=>$enemy[num], clan1=>$enemy[clan], cash1=>$cash, troops1=>$troops, food1=>$food, runes1=>$runes, id2=>$users[num], clan2=>$users[clan]));
	saveUserData($users,"networth troops cash runes food aidcred");
	saveUserData($enemy,"networth troops cash runes food");
	takeTurns(2,aid);
		if($send["troop$tn"] == 0)
	ThePrint('<span class="success-font">~ A shipment has been sent to <a class=proflink href=?profiles&num='.$enemy[num].$authstr.'>'.$enemy[empire].'</a> ~</span><br /><br /><br />');
	else
	ThePrint('<span class="success-font">~ '.commas(gamefactor($send["troop$tn"])).' '.$uera["troop$tn"].' have departed with shipment to <a class=proflink href=?profiles&num='.$enemy[num].$authstr.'>'.$enemy[empire].'</a> ~</span><br /><br /><br />');
		calcConvoy();
}
?>
