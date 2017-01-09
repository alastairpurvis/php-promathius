<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI("");
if ($users[disabled] != 2)
	endScript("You are not an administrator!");

if ($do_modify == 1)
{
	reset($modify);
	while (list(,$modify_num) = each($modify))
	{
		fixInputNum($modify_num);
		fixInputNum($adminclan);
		if ($modify_setdisabledmulti)
		{
			$modify_setmulti = 1;
			$modify_setdisabled = 1;
		}
		if ($modify_clrdisabledmulti)
		{
			$modify_clrmulti = 1;
			$modify_clrdisabled = 1;
		}
		if ($modify_setmulti)
		{
			print "<span class=success-font><b>$modify_num marked as multi!</b></span><br /><br /><br />\n";
			mysql_safe_query("UPDATE $playerdb SET ismulti=1 WHERE num=$modify_num;");
		}
		if ($modify_clrmulti)
		{
			print "<span class='success-font'><b>$modify_num no longer marked as multi!</b></span><br /><br /><br />\n";
			mysql_safe_query("UPDATE $playerdb SET ismulti=0 WHERE num=$modify_num;");
		}
		if ($modify_setdisabled)
		{
			print "<span class='success-font'><b>$modify_num disabled!</b></span><br /><br /><br />\n";
			mysql_safe_query("UPDATE $playerdb SET disabled=3 WHERE num=$modify_num;");
		}
		if ($modify_clrdisabled)
		{
			print "<span class='success-font'><b>$modify_num no longer disabled!</b></span><br /><br /><br />\n";
			mysql_safe_query("UPDATE $playerdb SET disabled=0,idle=$time WHERE num=$modify_num;");
		}
		if ($modify_admin)
		{
			print "<span class='success-font'><b>Granting $modify_num administrative privileges!</b></span><br /><br /><br />\n";
			mysql_safe_query("UPDATE $playerdb SET disabled=2 WHERE num=$modify_num;");
		}
		if ($modify_delete)
		{
			print "<span class='success-font'>Deleting $modify_num!</b><br /><br /><br />\n";
			mysql_safe_query("UPDATE $playerdb SET land=0,disabled=4 WHERE num=$modify_num;");
			mysql_safe_query("UPDATE ".$config[forum_prefix]."usersusers SET is_empire=0 WHERE empire_num=$modify_num;");
			$users[kills]++;
		}
		if ($putclan)
		{
			print "<span class='success-font'>Putting $modify_num in clan $adminclan!</b><br /><br /><br />\n";
			mysql_safe_query("UPDATE $playerdb SET clan=$adminclan WHERE num=$modify_num;");
			mysql_safe_query("UPDATE $clandb SET members=members+1 WHERE num=$adminclan;");
		}
	}
	saveUserData($users,"kills");
}

if (!$sortby)
	$sortby = "ip";
sqlQuotes($sortby);
$multis = mysql_safe_query("SELECT num,empire,clan,ip,name,username,email,idle,signedup,disabled,turnsused,land,ismulti FROM $playerdb WHERE ip!='0.0.0.0' AND disabled!=1 AND land!=1 ORDER BY $sortby, num ASC;");
$ctags = loadClanTags();
?>
<form method="post" action="?useradmin<?=$authstr?>">
<table border=0 cellspacing=0 cellpadding=3 width=380">
<tr><td class="caption4"><a href="?useradmin&amp;sortby=num<?=$authstr?>">Num</a></td>
      <td class="caption4"><a href="?useradmin&amp;sortby=empire<?=$authstr?>"><?=$uera[empireC]?></a></td>
    <td class="caption4"><a href="?useradmin&amp;sortby=clan<?=$authstr?>">Clan</a></td>
    <td class="caption4"><a href="?useradmin&amp;sortby=ip<?=$authstr?>">IP</a></td>
    <td class="caption4"><a href="?useradmin&amp;sortby=name<?=$authstr?>">Name</a></td>
    <td class="caption4">Status</th>
    <td class="caption4">Modify</th></tr>
<?
while ($multi = mysql_fetch_array($multis))
{
	$idle = $time - $multi[idle];
	if ($multi[$sortby] == $lastsort)
		if ($multi[ismulti])
			if ($multi[disabled] == 3)
				print '<tr class="cbad">'."\n";
			else	print '<tr class="cgood">'."\n";
		else	print '<tr class="cwarn">'."\n";
	else	print "<tr>\n";
?>
	<tr class="shlarge">
    <th class="aleft" style="padding-top: 4px; padding-bottom: 4px"><?=$multi[num]?></th>
    <td class="aleft" style="padding-top: 4px; padding-bottom: 4px"><?=$multi[empire]?></td>
    <td class="acenter" style="padding-top: 4px; padding-bottom: 4px"><?=$ctags["$multi[clan]"]?></td>
    <td class="aright" style="padding-top: 4px; padding-bottom: 4px"><?=$multi[ip]?></td>
    <td class="acenter style="padding-top: 4px; padding-bottom: 4px""><u><span title="Email: <?=$multi[email]?>"><?=$multi[name]?></u></</td>

    <td class="aright"><?
	switch ($multi[disabled])
	{
	case 0:	if ($multi[land] == 0)
			print "Dead&nbsp;(uninformed)";
		elseif ($multi[ismulti])
			print "Multi&nbsp;(legal)";
		elseif ($multi[turnsused] > $config[protection])
			print "New&nbsp;account";
		else	print "Normal";
		break;
	case 1: if ($multi[land] == 0)
			print "Dead&nbsp;(informed)";
		break;
	case 2:	print "Admin";
		break;
	case 3:	if ($multi[ismulti])
			print "Multi&nbsp;(disabled)";
		else	print "Cheater";
		break;
	case 4:	print "Deleted";
		break;
	}
?></td>
    <td class="acenter"><input class=cb type="checkbox" name="modify[]" value="<?=$multi[num]?>"<?if ($multi[num] == $users[num]) print " disabled";?>></td></tr>
<?
	
	$lastsort = $multi[$sortby];
}
?>
<tr><th colspan="10" class="aright"><br />
        <input type="hidden" name="do_modify" value="1">
        <input type="hidden" name="sortby" value="<?=$sortby?>">
	<select name="adminclan" size="1">
		<option value="0" selected>None: Unallied <?=$uera[empireC]?>s</option>
	<?
	        $clanlist = mysql_safe_query("SELECT num,name,tag FROM $clandb WHERE members>0 ORDER BY num DESC;");
	        while ($clan = mysql_fetch_array($clanlist))
	        {
	?>
	<option value="<?=$clan[num]?>"><?=$clan[tag]?>: <?=$clan[name]?></option>
	<?
	        }
	?>
	</select>
	<input type="submit" class="mainoption" name="putclan" value="Put in Clan"><br />

        Multi Account (Cheating): <input class="mainoption" type="submit" name="modify_setmulti" value="Set"> / <input class="mainoption" type="submit" name="modify_clrmulti" value="Clear"><br />
        Disabled: <input class="mainoption" type="submit" name="modify_setdisabled" value="Set"> / <input class="mainoption" type="submit" name="modify_clrdisabled" value="Clear"><br />
        Disable Multi: <input class="mainoption" type="submit" name="modify_setdisabledmulti" value="Set"> / <input class="mainoption" type="submit" name="modify_clrdisabledmulti" value="Clear"><br />
        Delete Account: <input class="mainoption" type="submit" name="modify_delete" value="NUKE"><br />
        Make Admin (Clear Disabled to undo): <input class="mainoption" type="submit" name="modify_admin" value="ADMIN"></th></tr>
</table>
</form>
<?
endScript('');
?>
