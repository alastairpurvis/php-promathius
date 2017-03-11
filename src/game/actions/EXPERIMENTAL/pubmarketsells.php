<?
require_once($game_root_path."/header.php");
include($game_root_path."/lib/marketcron.php");
	// Load the game graphical user interface
initGUI("");
if ($lockdb)
{
	endScript("Public market currently disabled!");
	}

if(!defined('CLAN'))
	define('CLAN', 0);
if(!defined('SCRIPT'))
	define('SCRIPT', 'pubmarketbuy');
if(!defined('SCRIPT2'))
	define('SCRIPT2', 'pubmarketsell');
	define('msg_error1', '');

$trooplst = array();
foreach($config[troop] as $num => $mktcost)
	$trooplst[] = "troop$num";
$trooplst[] = 'food';

$commission = 0;
if($users[networth] < 10000000)
	$commission = 0.9;
else if($users[networth] < 20000000)
	$commission = 0.85;
else if($users[networth] < 50000000)
	$commission = 0.8;
else if($users[networth] < 100000000)
	$commission = 0.75;
else
	$commission = 0.7;


foreach($config[troop] as $num => $mktcost)
	getCosts("troop$num", $num);
getCosts(food);



function printRow ($type, $num=-1)
{
	global $users, $uera, $costs, $basket;
	if($num != -1) {
		$owned = $users[troop][$num];
		$type = "troop$num";
	} else
		$owned = $users[$type];
?>
<tr><td style="font-size:9px"><?=$uera[$type]?></td>
    <td class="aright" style="font-size:9px"><?=commas(gamefactor($owned))?></td>
    <td class="aright" style="font-size:9px"><?=commas(gamefactor($basket[$type]))?></td>
    <td class="aright" style="font-size:9px"><input type="text" name="sellprice[<?=$type?>]" value="<?=$costs[$type]?>" size="4"></td>
    <td class="aright" style="font-size:9px"><input type="text" name="sell[<?=$type?>]" value="0" size="3"></td>
<?
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

function calcBasket ($type, $percent, $num=0)
{
	global $marketdb, $users, $uera, $basket, $config, $time, $authstr;
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
?>
<tr><td style="font-size:9px"><?=$uera[$ts]?></td>
    <td class="aright" style="font-size:9px"><?=commas(gamefactor($market[amount]))?></td>
    <td class="aright" style="font-size:9px">$<?=commas($market[price])?></td>
    <td class="aright" style="font-size:9px"><?
		if (($market[time] -= $time) < 0)
		{
			?>On Sale for <?=round($market[time]/-3600,1)?> hour(s) - <a href="?<?=SCRIPT2?>&amp;do_removeunits=yes&amp;remove_id=<?=$market[id]?><?=$authstr?>">Remove</a><?
		}
		else
		{
			$bwidth = round($market[time]/3600,1)*10;
			if($bwidth > 50)
				$bwidth = 50;
			$gwidth = 50 - $bwidth;
			$factor = 3;
			$bwidth *= $factor; $gwidth *= $factor;
			echo "<table width='150' cellpadding='0' cellspacing='0'><tr><td>
	<img src='images/greenfade1.gif' height='15' width='$gwidth' border='0' align='middle'><img src='images/redfade.gif' height='15' width='$bwidth' border='0' align='middle'>
			      </td></tr></table>";
		}
?></td></tr>
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
if ($do_sell)
{
	foreach($config[troop] as $num => $mktcost)
		sellUnits('troop', $num);
	sellUnits('food');

	saveUserData($users,"networth troops food");
}

function sellUnits ($type, $num=-1) {
	global $marketdb, $users, $uera, $sell, $sellprice, $config, $basket, $time, $max;
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
	global $costs;
	if (($amount == 0) || ($price == 0))
		return;
	if ($amount < 0){
		$msg_error1 = "It is impossible to sell a negative number of " . $uera[$type] . ".";
				echo "<span class='error-font'><b>" . $msg_error1 . "</b></span><br /><br /><br />";}
	elseif ($amount > $basket[$type]){
		$msg_error1 = "It is not possible to sell this many " . $uera[$type] . ".";
				echo "<span class='error-font'><b>" . $msg_error1 . "</b></span><br /><br /><br />";}
	elseif ($price < $minprice){
		$msg_error1 = "It is unprofitable to sell " . $uera[$type] .  " for a price so ridiculously cheap.";
				echo "<span class='error-font'><b>" . $msg_error1 . "</b></span><br /><br /><br />";}
	elseif ($price > $maxprice){
		$msg_error1 = "It is unreasonable to sell " . $uera[$type] . " for a price as high as this.";
				echo "<span class='error-font'><b>" . $msg_error1 . "</b></span><br /><br /><br />";}
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
?>
<tr><td><?=$uera[$type]?></td>
    <td class="aright"><?=commas(gamefactor($amount))?></td>
    <td class="aright">$<?=commas($price)?></td>
    <td class="aright"><?
			$bwidth = 50;
			$gwidth = 50 - $bwidth;
			$factor = 3;
			$bwidth *= $factor; $gwidth *= $factor;
			echo "<table width='1' cellpadding='0' cellspacing='0'><tr><td><nobr>
				<img src='img/greenfade.gif' height='15' width='$gwidth' border='0'>
				</td><td>
				<img src='img/redfade.gif' height='15' width='$bwidth' border='0'>
			      </nobr></td></tr></table>";
		?></td></tr><?
	}
}

function removeUnits ($id)
{
	global $marketdb, $users, $uera, $commission;
	fixInputNum($id);
	$market = @mysql_fetch_array(mysql_safe_query("SELECT * FROM $marketdb WHERE id=$id AND clan=".CLAN.";"));
	if ($market[seller] != $users[num])
		print "No such shipment!<br />\n";
	else
	{
		$amount = $market[amount];
		$type = $market[type];
		@mysql_safe_query("DELETE FROM $marketdb WHERE id=$id AND clan=".CLAN.";");
		$ts = $type;
		if(strlen($type) >= 6 && substr($type, 0, 5) == 'troop') {
			$type = substr($type, 5, 1);
			$users[troop][$type] += floor($market[amount] * $commission);
		}
		else
			$users[$type] += floor($market[amount] * $commission);
		print "You have removed ".commas(gamefactor($amount))." $uera[$ts] from the market.<br />\n";
		saveUserData($users,"networth troops food");
	}
}

if ($users[turnsused] <= $config[protection])
	endScript("Cannot trade on the public market while under protection!");

?>

<script language="JavaScript">

function checkAll (check){
	var path = document.pvmb;
	for (var i=0;i<path.elements.length;i++) {
		e = path.elements[i];
		checkname = "maxall";
		if(check==2) checkname = "maxall2";
		if( (e.name!=checkname)  && (e.type=="checkbox") ) {
			 e.checked = path.maxall.checked;
			 if(check==2) e.checked = path.maxall2.checked;
		}
	 }
}

</script>

<?php if (CLAN == 0)
{?>
<table class="invisible" cellspacing=0 cellpadding=0 border=0 width=93%><tr><td width=10%>&nbsp;</td><td class="acenter" style="vertical-align:top">
<span style="font-size: 10px"><a href="?pvtmarketsell<?=$authstr?>"><?=$config['lang']['pvtmarket']?></a> | 
<b><?=$config['lang']['pubmarket']?></b></span></td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section=pubmaretsell" title="<?=$config[lang][helpbutton]?>" tabindex="4"><img src="images/spacer.gif" width=100% height=100% alt="<?=$config[lang][helpbutton]?>"></img></a></td></tr></a></table></td>
<?php }
else
{?>
<b><?=$uclan['name']?> Market</b></span>
<?php }?>
<table width=420>
<?php if (CLAN == 0)
{?>
<tr><td style="text-align: left"><a href="?pubmarketbuy<?=$authstr?>"><?=$config['lang']['buygoods']?></a></td>
<?php }
else
{?>
<tr><td style="text-align: left"><a href="?clanmarketbuy<?=$authstr?>"><?=$config['lang']['buygoods']?></a></td>
<?php }?>
    <td style="text-align: right"><b><?=$config['lang']['sellgoods']?></b></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" width=420>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:6px; padding-bottom:8px;">
<form method="post" action="?<?=SCRIPT2?><?=$authstr?>" name="pvmb">
<table class="font" width="380" border=0>
<tr><th class="aleft">Unit</th>
    <th class="aright">Owned</th>
    <th class="aright">Can Sell</th>
    <th class="aright">Price</th>
    <th class="aright">Sell</th>
<?
ob_start();
foreach($config[troop] as $num => $mktcost)
	calcBasket('troop',0.9, $num);
calcBasket(food,0.100);
ob_end_clean();

foreach($config[troop] as $num => $mktcost)
	printRow(troop, $num);
printRow(food);

?>
<tr><td colspan="7" style="text-align:right; padding-top: 7pt"><input type="submit" name="do_sell" value="Sell Goods" class="mainoption"></td></tr>
</table>
</td>
<?php echo $shadowdata['end'];?>
</form>
<span style="font-size: 10px">It will take <?=$config[market]?> hours for your goods to reach the market.<br /><br /></span>
<?
if ($do_removeunits)
	removeUnits($remove_id);
?>
<table class="inputtable">
<tr><td colspan="4" style="font-size: 10px"><center>On the market or on the way we have:</center></td></tr>
<tr><th class="aleft" style="font-size:9px">Unit</th>
    <th class="aright" style="font-size:9px">Quantity</th>
    <th class="aright" style="font-size:9px">Price</th>
    <th class="aright" style="font-size:9px">Status</th></tr>
<?
foreach($config[troop] as $num => $mktcost)
	calcBasket('troop',0.9, $num);
calcBasket(food,0.100);
?>


    <tr><td colspan="4"></td></tr>
</table>
<?
endScript("");
?>
