<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');

/*
This tidbit sells all stocks and puts them in the Bank
include($game_root_path."/lib/stocks.php");
        
if ($users[turnsused] <= $config[protection])
        endScript("Cannot trade on the stock market while under protection!");
 
//config & load

$height = 400;
$width = 25;
$users[stocks] = explode("|", $users[stocks]);
$stocknames = array();
$symbols = array();
$prices = array();
$days1 = array();
$days2 = array();
$days3 = array();
        
$q = mysql_safe_query("SELECT * FROM $stockdb;");
while($stock = mysql_fetch_array($q)) {
        $id = $stock['id'];
        $stocknames[$id] = $stock['name'];
        $symbols[$id] = $stock['symbol'];
        $prices[$id] = floor($stock['price']/1000) + $stock['boost'];
        if($prices[$id] > 200)
                $prices[$id] = 200;
        if($prices[$id] < 1)
                $prices[$id] = 1;
        $days1[$id] = floor($stock['days1']/1000);
        $days2[$id] = floor($stock['days2']/1000);
        $days3[$id] = floor($stock['days3']/1000);
}

echo "<pre>";
$pn = mysql_query("SELECT num FROM $playerdb;");
while($p = mysql_fetch_array($pn)) {
	$n = $p[num];
	$user = loadUser($n);
	$st = explode("|", $user[stocks]);
	$earned = 0;
	foreach($st as $id => $amt) {
		$earned += $amt * $prices[$id+1];
	}
	print_r($st);
	echo $earned."\n\n";
	echo $user[savings]."\n\n";
	$user[savings] += $earned;
	echo $user[savings]."\n\n";
	$user[stocks] = "";
//	saveUserData($user, "savings stocks", true);
}
echo "</pre>";
exit;
*/


if ($users[num] != 1)
	endScript("You are not the root administrator!");

if(isset($_POST['do_reset'])) {
	$cur_admin_pass = sqlsafeeval("SELECT password FROM $playerdb WHERE num=1;");

	mysql_safe_query("DROP TABLE `$prefix"."_banned`, `$prefix"."_bounties`, `$prefix"."_clan`, `$prefix"."_clanmarket`, `$prefix"."_code`, `$prefix"."_cron`, `$prefix"."_forums`, `$prefix"."_lottery`, `$prefix"."_market`, `$prefix"."_messages`, `$prefix"."_misc`, `$prefix"."_news2`, `$prefix"."_players`, `$prefix"."_posts`, `$prefix"."_send_mails`, `$prefix"."_stockmarket`, `$prefix"."_topics`, `$prefix"."_users`;");
	include($game_root_path."/sql-setup.php");

	$root = loadUser(1);
	$root[password] = $cur_admin_pass;
	$lockdb = 0;		//to fool saveUserData
	saveUserData($root, "password");

	endScript("Server Reset!");
}

$tpl->display("dbadmin.tpl");
endScript("");
?>

