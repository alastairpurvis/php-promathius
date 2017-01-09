<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
if(howmanytimes(lasttime('markets'), $perminutes)) {
	// condense market items:
	$mkt = mysql_safe_query("SELECT * FROM $marketdb WHERE time<$time;");
	while ($market = mysql_fetch_array($mkt)) {
		$market = mysql_fetch_array(mysql_safe_query("SELECT * FROM $marketdb WHERE id=$market[id];"));
		$id = $market[id];
		$amount = $market[amount];
		$price = $market[price];
		$unit = $market[type];
		$seller = $market[seller];
		$clan = $market[clan];
		$mktdoubles = mysql_safe_query("SELECT * FROM $marketdb WHERE time<$time AND price=$price AND type='$unit' AND seller=$seller AND clan=$clan AND id!=$id;");
		if($mktdoubles)
		while ($mktsame = mysql_fetch_array($mktdoubles)) {
			$amount += $mktsame[amount];
			mysql_safe_query("DELETE FROM $marketdb WHERE id=$mktsame[id];");
		} 
		mysql_safe_query("UPDATE $marketdb SET amount=$amount WHERE id=$id");
	}
	justRun('markets', $perminutes);
}
?>
