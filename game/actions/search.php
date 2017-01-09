<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI();
if ($do_search) {
	$query = "";

	$search_string = preg_replace('/[^a-zA-Z0-9 ]/', '', $search_string);
	fixInputNum($search_num);
	fixInputNum($search_clan);
	if ($search_type == "string")
		$query .= " empire LIKE '%$search_string%'";
	elseif ($search_type == "num")
		if ($search_num)
			$query .= " num=$search_num";
		else
			endScript("No ".$uera[empire]." number specified!");
	elseif ($search_type == "clan")
		$query .= " clan=$search_clan";
	//elseif ($search_type == "online")
		//$query .= " online=1";
	else
		endScript("No search type specified!");

	fixInputNum($search_era);
	if ($search_era > 0)
		$query .= " AND era=$search_era";

	fixInputNum($search_race);
	if ($search_race > 0)
		$query .= " and race=$search_race";

	fixInputNum($search_max_nw);
	if ($search_max_nw > 0)
		$query .= " and networth<=$search_max_nw";

	fixInputNum($search_min_nw);
	if ($search_min_nw > 0)
		$query .= " and networth>=$search_min_nw";

	if ($search_dead)
		$query .= " and land!=0";


	$order_by = preg_replace('/[^a-z]/', '', $order_by);
	$valid_orders = array('networth', 'num', 'empire', 'clan', 'rank');
	if(!in_array($order_by, $valid_orders))
		$order_by = 'rank';

	fixInputNum($searchlimit);
	if ($searchlimit == 0)
		$searchlimit = 25;

	$dbstr = mysql_safe_query("SELECT rank,empire,num,land,networth,clan,race,era,online,disabled,turnsused,vacation,offsucc,offtotal,defsucc,deftotal,kills 
				FROM $playerdb WHERE $query ORDER BY $order_by LIMIT $searchlimit;");


	if ($numrows = @mysql_num_rows($dbstr)) {

		?>
<span class="mprotected">Protected/Vacation</span>, <span class="mdead">Dead</span>, <span class="mally">Ally</span>, <span class="mdisabled">Disabled</span>, <span class="madmin">Administrator</span>, <span class="mself">You</span><br /><br />
<table class="scorestable">
<?php
		printSearchHeader($users[region]);
		while ($enemy = mysql_fetch_array($dbstr))
		printSearchLine(0);
//printSearchHeader($users[region]);

		?>
</table>
<?php
		if ($numrows > $searchlimit)
			print "<br />Search limit reached.<br /><br />\n";
		else print "<br />Found $numrows ".$uera[empire]."s matching your criteria.<br /><br />\n";
	} else print "No empires found.<br /><br />\n";
} 

$clanlist = mysql_safe_query("SELECT num,name,tag FROM $clandb WHERE members>0 ORDER BY num;");
while ($clan = mysql_fetch_array($clanlist)) {
		$clansel[] = array(num	=> $clan[num],
				tag	=> $clan[tag],
				name	=> $clan[name]);
} 

foreach($rtags as $id => $race) {
		$factsel[] = array(id	=> $id,
				race	=> $race);
} 

foreach($etags as $id => $era) {
		$locationsel[] = array(id	=> $id,
				era	=> $era);
} 

if ($search_max_nw) $searchmax = $search_max_nw;
else $searchmax = 10 * round((floor($users[networth] * 10)) /($config['greatness_roundoff']  ^ 10), $config['greatness_roundoff']);

if ($search_min_nw) $searchmin = $search_min_nw;
else $searchmin = commas(round((floor($users[networth] * 10)) /($config['greatness_roundoff']  ^ 10), $config['greatness_roundoff']) / 10);

if ($search_nw_max) $chk_searchmax = " checked";
if ($search_nw_min) $chk_searchmin = " checked";

if ($searchlimit) $search_limit = $searchlimit;
$search_limit = 25;

$tpl->assign('locationsel', $locationsel);
$tpl->assign('factsel', $factsel);
$tpl->assign('clansel', $clansel);
$tpl->assign('uera', $uera);
$tpl->assign('search_limit', $search_limit);
$tpl->assign('search_max', $searchmax);
$tpl->assign('search_min', $searchmin);
$tpl->assign('chk_search_max', $chk_searchmax);
$tpl->assign('chk_search_min', $chk_searchmax);
$tpl->display('search.tpl'); 
?>
