<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');

// Load the game graphical user interface
initGUI();

if ($mark_news) {
	$users[newstime] = $time;
	saveUserData($users,"newstime");
        header(str_replace('&amp;', '&', "Location: ?main$authstr"));
        die();
}

if($do_nsort_rev) {
	if($users[newssort] == 0)
		$users[newssort] = 1;
	else
		$users[newssort] = 0;
	saveUserData($users, "newssort");
}

if ($users[turnsused] > $config[protection] || $userdata['empires_owned'] > 1)
echo '<h3>Welcome to your empire, '.$userdata[username].'</h1>';
else
echo '<h3>Welcome to Promathius, first time player!</h1><br />You may want to read the <a href="?guide&section=Introduction">Introduction</a> to get started<br /><br />';
//printMainStats($users,$urace,$uera);
if ($users[turnsused] <= $config[protection])
{
echo '<br /><br />';
?>
<Br /><span class="mprotected">Under New Player Protection for <?=$config[protection]?> turns</span><br />
<?
}

?>
<br />
You get <?=$turnsper?> <?=plural($turnsper,turns,turn)?> every <?=$perminutes?> <?=plural($perminutes,minutes,minute)?>, 
<?
if ($lockdb)
	print "Turns are currently stopped.<br /><br />\n";
else
{
	?>
		next <?=plural($turnsper,turns,turn)?> in <span id="ttimer"><?if ($nextturnmin >= 1){?><?=$nextturnmin?> <?=plural($nextturnmin,minutes,minute)?> and <?} ?><?=$nextturnseconds?> seconds</span><Br><br /><br /><br />
	<?
}
if ($users[clan])
{
	$uclan = loadClan($users[clan]);


			

	if ($uclan[motd])
	{
?>
<table class="inputtable" style="width:90%; padding:0px" cellspacing=0>
<tr><td></td></tr>
<tr><td class=caption4><?=$uclan[name]?> News</td></tr>
<tr class="tbCel1"><td class="caption1" ><?=bbcode_parse($uclan[motd])?></td></tr>
<tr><td></td></tr>

<br /><br />
<?
	}
}

if($do_nsort_rev)
	print "News Sorting Reversed! &middot; ";
//print "<a href=?main&do_nsort_rev=1$authstr>Reverse News Sorting</a><br />\n";

if ($all_news)
	$users[newstime] = $time - 86400*7;			// show all news under 1wk old

if($all_history)
	$users[newstime] = 0;
$hasnews = printNews($users);
if ($all_news)
{
	if (!$hasnews)
		print "<b>No archived news</b><br />\n";
}
else
{
	print "<img src='images/spacer.gif' height=7><table cellpadding=0 cellspacing=0 style='padding:0px'";
	if ($hasnews)
		print " width=100%";
	else
		print " width=80%";
	print "><br /><td style=\"text-align:right\" class=caption3><span class=header>";
	if ($hasnews)
		print "<a href=\"$config[main]?main&amp;mark_news=yes$authstr\">Mark Read</a> &#8226; ";
	else	print "<b>No new happenings</b> &#8226; ";
	print "<a href=\"$config[main]?main&amp;all_news=yes$authstr\">View Last 7 Days</a> &#8226; ";
	print "<a href=\"$config[main]?main&amp;all_history=yes$authstr\">View News Archive</a> ";
	print "</table>";
}
endScript("");
?>
