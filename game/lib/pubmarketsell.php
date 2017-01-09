<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
function printRow ($type, $num=-1)
{
	global $users, $uera, $costs, $basket, $rowdata;
	if($num != -1) {
		$owned = $users[troop][$num];
		$type = "troop$num";
	} else
		$owned = $users[$type];
		$rowdata[] = array(name	=> ucwords($uera[$type]), 
						type => $type, 
						owned => gamefactor($owned), 
						basket => gamefactor($basket[$type]), 
						cost => $costs[$type]);
}

function getCosts ($type, $num=0)
{
	global $marketdb, $config, $users, $costs, $time;
	sqlQuotes($type);
	$market = mysql_fetch_array(mysql_safe_query("SELECT * FROM $marketdb WHERE type='$type' AND seller!=$users[num] AND time<=$time AND clan=".CLAN." 
		ORDER BY price ASC, time ASC LIMIT 1;"));
	if ($market[price])
		$costs[$type] = $market[price];
	else {
		if(strlen($type) >= 6 && substr($type, 0, 5) == 'troop')
			$costs[$type] = $config[troop][$num];
		else
			$costs[$type] = $config[$type."_sell"];
	}
}

function calcBasket ($type, $percent, $num=0, $show)
{
	global $marketdb, $users, $uera, $basket, $config, $time, $authstr, $basketdata, $tpl, $tpl_var;
	$ts = $type;
	if($type == 'troop')
		$ts = "troop$num";
	$onsale = 0;
	sqlQuotes($ts);
	$goods = mysql_safe_query("SELECT * FROM $marketdb WHERE type='$ts' AND seller=$users[num] ORDER BY amount DESC;");
	while ($market = mysql_fetch_array($goods))
	{
		$onsale += $market[amount];
		if($market[clan] == CLAN) {
		// Calculate the size of the status bar
			$market[time] -= $time;
			$bwidth = 100 *round(($market['time']/3600)/$config[market],2);
			if($bwidth > 100)
				$bwidth = 100;
			$gwidth = 100 - $bwidth;

			if($show == 1)
			{
				$basketdata[] = array(name	=> $uera[$ts], 
						amount => gamefactor($market[amount]), 
						price => $market[price], 
						'time' => $market[time], 
						timecondition => ($market[time]),
						timeonmarket => (round($market[time]/-3600,1)),
						id => $market[id],
						greenwidth => $gwidth,
						redwidth => $bwidth);
			}

?>
<?
		}
	}
	if($type == 'troop')
		$basket[$ts] = round(($users[troop][$num] + $onsale) * $percent) - $onsale;
	else
		$basket[$type] = round(($users[$type] + $onsale) * $percent) - $onsale;
	$type = $ts;
	if ($basket[$type] < 0)
		$basket[$type] = 0;

}

function sellUnits ($type, $num=-1) {
	global $marketdb, $users, $uera, $sell, $sellprice, $config, $basket, $time, $max, $msg_error1, $msg;
	if($num != -1)
		$type = $type.$num;
	if($num != -1) {
		$minprice = $config[troop][$num] * 0.2;
		$maxprice = $config[troop][$num] * 2.5;
	} else {
		$minprice = $config[$type] * 0.2;
		$maxprice = $config[$type] * 2.5;
	}
	
	$amount = $sell[$type];
	fixInputNum($amount);
	$amount = invfactor($amount);

	if(isset($max[$type]))
		$amount = $basket[$type];

	$price = $sellprice[$type];
	fixInputNum($price);
	$users[sales] = sqlsafeeval("SELECT COUNT(*) FROM $marketdb WHERE seller = '$users[num]';");

	global $costs;
	if (($amount == 0) || ($price == 0))
		return;
	if ($amount < 0){
		$msg_error1 = "It is impossible to sell a negative number of " . $uera[$type] . ".";
			//	echo "<span class='error-font'><b>" . $msg_error1 . "</b></span><br /><br /><br />";
			}
	elseif ($amount > $basket[$type]){
		$msg_error1 = "It is not possible to sell this many " . $uera[$type] . ".";
			//	echo "<span class='error-font'><b>" . $msg_error1 . "</b></span><br /><br /><br />";
			}
	elseif ($price < $minprice){
		$msg_error1 = "It is unprofitable to sell " . $uera[$type] .  " for a price so ridiculously cheap.";
			//	echo "<span class='error-font'><b>" . $msg_error1 . "</b></span><br /><br /><br />";
			}
	elseif ($price > $maxprice){
		$msg_error1 = "It is unreasonable to sell " . $uera[$type] . " for a price as high as this.";
			//s	echo "<span class='error-font'><b>" . $msg_error1 . "</b></span><br /><br /><br />";
				}
	elseif ($users[sales] > $config[maxsales]){
		$msg_error1 = "You cannot have more than " . $config[maxsales] . " items for sale at a single time.";
			//s	echo "<span class='error-font'><b>" . $msg_error1 . "</b></span><br /><br /><br />";
				}
	else
	{
		if($num != -1) {
			$users[troop][$num] -= $amount;
			$basket[$ts] -= $amount;
		} else {
			$users[$type] -= $amount;
			$basket[$type] -= $amount;
		}
		sqlQuotes($type);
		fixInputNum($amount);
		fixInputNum($price);
		mysql_safe_query("INSERT INTO $marketdb (type,seller,amount,price,time,clan) VALUES ('$type',$users[num],$amount,$price,$time+3600*$config[market],".CLAN.");");

		

		if($type != 'food' && $type != 'runes')
		{
			if(gamefactor($amount) == 1)
				$itemname = $uera[$type.'alt'];
			else
				$itemname = $uera[$type];
		}
		else
			$itemname = strtolower($uera[$type]);
		$msg[] = commas(gamefactor($amount))." $itemname will be sent for sale at a price of ".$price." gold";
		
		
		saveUserData($users,"sales");
	}
}

function removeUnits ($id)
{
	global $marketdb, $users, $uera, $commission, $msg, $msg_error1, $msg2, $config, $goods;
	fixInputNum($id);
	$market = @mysql_fetch_array(mysql_safe_query("SELECT * FROM $marketdb WHERE id=$id AND clan=".CLAN.";"));
	if ($market[seller] != $users[num])
	{
		$msg_error1 = "There is no such shipment.";
	}
	else
	{
		$amount = $market[amount];
		$type = $market[type];
		@mysql_safe_query("DELETE FROM $marketdb WHERE id=$id AND clan=".CLAN.";");
		$ts = $type;
		if(strlen($type) >= 6 && substr($type, 0, 5) == 'troop') {
			$type = substr($type, 5, 1);
			$users[troop][$type] += floor($market[amount]);
		}
		else
			$users[$type] += floor($market[amount]);

		if($ts != 'food' && $ts != 'runes')
		{
			if(gamefactor($amount) == 1)
				$itemname = $uera[$ts.'alt'];
			else
				$itemname = $uera[$ts];
		}
		else
		$itemname = strtolower($uera[$ts]);
		$msg[] = "You have removed ".commas(gamefactor($amount))." $itemname from the market";
		if($config['sellcommission'] > 0)
		{
			$commissionloss = round((gamefactor($market[amount]) * $market[price]) * (1-$commission));
			$users[cash] -= $commissionloss/$config[game_factor];
			$msg2 = "You were charged a total of ".$commissionloss." gold in the effort.";
		}
		$users[sales]--;
		saveUserData($users,"networth troops food cash sales");
	}
}

function cancelShipment ($id)
{
	global $marketdb, $users, $uera, $commission, $commissioncancel, $msg, $msg_error1, $config, $msg2, $goods;
	fixInputNum($id);
	$market = @mysql_fetch_array(mysql_safe_query("SELECT * FROM $marketdb WHERE id=$id AND clan=".CLAN.";"));
	if ($market[seller] != $users[num])
	{
		$msg_error1 = "There is no such shipment.";
	}
	else
	{
		$amount = $market[amount];
		$type = $market[type];
		@mysql_safe_query("DELETE FROM $marketdb WHERE id=$id AND clan=".CLAN.";");
		$ts = $type;
		if(strlen($type) >= 6 && substr($type, 0, 5) == 'troop') {
			$type = substr($type, 5, 1);
			$users[troop][$type] += floor($market[amount]);
		}
		else
			$users[$type] += floor($market[amount]);
		
		if($ts != 'food' && $ts != 'runes')
		{
			if(gamefactor($amount) == 1)
				$itemname = $uera[$ts.'alt'];
			else
				$itemname = $uera[$ts];
		}
		else
		$itemname = strtolower($uera[$ts]);
		
		$msg[] = "You cancelled your shipment of ".commas(gamefactor($amount))." $itemname to the market";
		if($config['cancelcommission'] > 0)
		{
			$commissionloss = round((gamefactor($market[amount]) * $market[price]) * (1-$commissioncancel));
			$users[cash] -= $commissionloss/$config[game_factor];
			$msg2 = "You were charged a total of ".$commissionloss." gold in the effort.";
		}
		$users[sales]--;
		saveUserData($users,"networth troops food cash sales");
	}
}
?>