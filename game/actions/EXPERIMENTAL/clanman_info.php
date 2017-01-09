<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI();
if (($uclan[founder] != $users[num]) && ($uclan[asst] != $users[num]))
	endScript("Sorry, this page is only availiable to clan administrators.");

// this function generates the drop down box for ally and war lists
function listopt ($item)
{
	global $clandb, $uclan;
?>
<select name="<?=$item?>" size="1">
<option value="0"<?if ($uclan[$item] == 0) print " selected";?>>None</option>
<?
	$list = mysql_safe_query("SELECT num,name,tag FROM $clandb WHERE members>0 ORDER BY num DESC;");
	while ($clan = mysql_fetch_array($list))
	{
?>
<option value="<?=$clan[num]?>"<?if ($clan[num] == $uclan[$item]) print " selected";?>><?=$clan[tag]?>: <?=$clan[name]?></option>
<?
	}
?>
</select>
<?
}

function clanids()
{
	global $uclan, $shadowdata;
?>
<table cellspacing="0" cellpadding="0" width=360>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:9px;padding-bottom:15px; padding-left: 16px; padding-right: 16px">
<table>
<tr><th>Change Password:</th>
    <td style="text-align:right">New password: <input type="password" name="new_password" size="10"><br />
                        Verify password: <input type="password" name="new_password_verify" size="10"></td>
    <td style="text-align:left"><input type="submit" class="mainoption" name="do_changepass" value="Change"></td></tr>
<tr><th>Clan Name:</th>
    <td style="text-align:right"><input type="text" name="new_name" value="<?=$uclan[name]?>" size="26" maxlength="32"></td>
    <td style="text-align:left"><input type="submit" name="do_changename" class="mainoption" value="Change"></td></tr>
<tr><th>Flag URL:</th>
    <td style="text-align:right"><input type="text" name="new_flag" value="<?=$uclan[pic]?>" size="26"></td>
    <td style="text-align:left"><input type="submit" name="do_changeflag" class="mainoption" value="Change"></td></tr>
<tr><th>Site URL:</th>
    <td style="text-align:right"><input type="text" name="new_url" value="<?=$uclan[url]?>" size="26"></td>
    <td style="text-align:left"><input type="submit" name="do_changeurl" class="mainoption" value="Change"></td></tr>
</table>
</td>
<?=$shadowdata['end']?>
<?
}

function motd()
{
	global $uclan;
?>
Clan MOTD (Message of the Day, all members see on Main Menu, displayed exactly as seen below, NO HTML):<br />
<textarea rows="6" cols="60" name="new_motd"><?=$uclan[motd]?></textarea><br />
Clan Crier News (Viewable by everyone):<br />
<textarea class="mainoption" rows="6" cols="60" name="new_crier"><?=$uclan[criernews]?></textarea><br />
<input type="submit" name="do_changemotd" value="Change MOTD">
<?
}

function playeropts()
{
	global $uclan, $playerdb, $users, $authstr, $uera;
?>
<?
	$dblist = mysql_safe_query("SELECT empire,num,forces,rank,networth FROM $playerdb WHERE clan=$uclan[num];");
	while ($listclan = mysql_fetch_array($dblist))
	{
?>

<?
	}
?>
<?
	if ($users[num] == $uclan[founder])
	{
?>
<?
	}
?>

<?
}

function relations()
{
?>

<?
}

if ($users[clan] == 0)
	endScript("You are not in a clan!");

$uclan = loadClan($users[clan]);

if (($uclan[founder] != $users[num]) && ($uclan[fa1] != $users[num]) && ($uclan[fa2] != $users[num]) && ($uclan[asst] != $users[num]))
	endScript("You do not have administrative authority in your clan!");

if ($do_removeempire)
{
$enemy = loadUser($modify_empire);
	if ($enemy[clan] != $uclan[num])
		endScript("That ".$uera[empire]." is not in your clan!");
	if ($enemy[num] == $uclan[founder])
		endScript("The leader must formally disband the clan.");
	$enemy[clan] = 0;

                        // Remove from any positions of power.
                        $posarray = array('asst','fa1','fa2');
                        foreach($posarray as $pos) {
                        if ($uclan[$pos] == $enemy[num])
                        	$uclan[$pos] = 0;
                        }
	saveUserData($enemy,"clan");
	addNews(114, array(id1=>$enemy[num], clan1=>$uclan[num], id2=>$users[num]));
	$uclan[members]--;
	saveClanData($uclan,"members asst fa1 fa2");
	endScript("You have removed <b>$enemy[empire] <a class=proflink href=?profiles&num=$enemy[num]$authstr>(#$enemy[num])</a></b> from your clan.");
}

if($do_clanopen) {
	if($uclan[open])
		$uclan[open] = 0;
	else
		$uclan[open] = 1;

	saveClanData($uclan, "open", true);
}

if ($do_changepass)
{
	if ($new_password == $new_password_verify)
	{
		$uclan[password] = md5($new_password);
		saveClanData($uclan,"password", true);
		endScript("Clan password changed.");
	}
	else	endScript("Passwords don't match!");
}
if ($do_changeflag)
{
	$uclan[pic] = HTMLEntities($new_flag, ENT_QUOTES);;
	saveClanData($uclan,"pic", true);
	endScript("Clan flag changed.");
}
if ($do_changename)
{
	if (!$new_name)
		endScript("No new name specified!");
	$uclan[name] = trim(HTMLEntities($new_name));
	saveClanData($uclan,"name", true);
	endScript("Clan name changed.");
}
if ($do_changeurl)
{
	$uclan[url] = HTMLEntities($new_url, ENT_QUOTES);
	saveClanData($uclan,"url", true);
	endScript("Clan URL changed.");
}
if ($do_changemotd)
{
	$uclan[motd] = swear_filter($new_motd);
	$uclan[criernews] = swear_filter($new_crier);
	saveClanData($uclan,"motd criernews", true);
	endScript("Clan news changed.");
}
if ($do_makefounder)
{
	if ($users[num] != $uclan[founder])
		endScript("Only the clan leader can change the leader.");
	$newfounder = loadUser($modify_empire);
	if ($newfounder[clan] == $users[clan])
	{
		$uclan[founder] = $newfounder[num];
		saveClanData($uclan,"founder", true);
		addNews(115, array(id1=>$newfounder[num], clan1=>$uclan[num], id2=>$users[num]), true);
		endScript("<b>$newfounder[empire] <a class=proflink href=?profiles&num=$newfounder[num]$authstr>(#$newfounder[num])</a></b> is now the leader of <b>$uclan[name]</b>.");
	}
	else	endScript("That ".$uera[empire]." is not a member of your clan!");
}
function rempos($pos)
{
	global $uclan, $users;
	$oldpos = loadUser($uclan[$pos]);
	if ($oldpos[num])
	{
		$uclan[$pos] = 0;
		saveClanData($uclan,"$pos", true);
		addNews(119, array(id1=>$oldpos[num], clan1=>$uclan[num], id2=>$users[num]), true);
		return "<b>$oldpos[empire] <a class=proflink href=?profiles&num=$oldpos[num]$authstr>(#$oldpos[num])</a></b> has been removed from authority for <b>$uclan[name]</b>.";
	}
	else	return "That position is already empty!";
}
function changepos($pos)
{
	global $modify_empire, $users, $uclan;
	$newpos = loadUser($modify_empire);
	if (($newpos[num] == $uclan[fa1]) || ($newpos[num] == $uclan[fa2]) || ($newpos[num] == $uclan[asst]))
		endScript("That ".$uera[empire]." already has a position of authority.");
	if ($newpos[clan] == $users[clan])
	{
		rempos($pos);
		$uclan[$pos] = $newpos[num];
		saveClanData($uclan,"$pos", true);
		addNews(118, array(id1=>$newpos[num], clan1=>$uclan[num], id2=>$users[num]), true);
		if ($pos == "asst")
			endScript("<b>$newpos[empire] <a class=proflink href=?profiles&num=$newpos[num]$authstr>(#$newpos[num])</a></b> is now the Assistant Leader for <b>$uclan[name]</b>.");
		else
			endScript("<b>$newpos[empire] <a class=proflink href=?profiles&num=$newpos[num]$authstr>(#$newpos[num])</a></b> is now a Minister of Foreign Affairs for <b>$uclan[name]</b>.");
	}
	else	endScript("That ".$uera[empire]." is not a member of your clan!");
}
if ($do_makeasst)
	changepos(asst);
if ($do_makefa1)
	changepos(fa1);
if ($do_makefa2)
	changepos(fa2);
if ($do_remasst)
	endScript(rempos(asst));
if ($do_makeasst)
	changepos(asst);
if ($do_remfa1)
	endScript(rempos(fa1));
if ($do_remfa2)
	endScript(rempos(fa2));
if ($do_changerelations)
{
	if($ally1 == $uclan[num] || $ally2 == $uclan[num] || $ally3 == $uclan[num] || $ally4 == $uclan[num] || $ally5 == $uclan[num])
		endScript("Can't ally yourself to your own clan!");
	if($war1 == $uclan[num] || $war2 == $uclan[num] || $war3 == $uclan[num] || $war4 == $uclan[num] || $war5 == $uclan[num])
		endScript("Can't set your own clan to war!");
	$uclan[ally1] = $ally1;
	$uclan[ally2] = $ally2;
	$uclan[ally3] = $ally3;
	$uclan[ally4] = $ally4;
	$uclan[ally5] = $ally5;
	$uclan[war1] = $war1;
	$uclan[war2] = $war2;
	$uclan[war3] = $war3;
	$uclan[war4] = $war4;
	$uclan[war5] = $war5;
	saveClanData($uclan,"ally1 ally2 ally3 ally4 ally5 war1 war2 war3 war4 war5");
	endScript("You have changed the relations for your clan.");
}

?>
<?if (($uclan[founder] == $users[num]) || ($uclan[asst] == $users[num])){?><span style="font-size: 10px"><a href="?clanmanage<?=$authstr?>">News</a> | <a href="?clanman_members<?=$authstr?>">Members</a> | <a href="?clanman_relations<?=$authstr?>">Relations</a> | <b>Clan Info</b></span><br /><?}?>
<br />

<form method="post" action="?clanman_info<?=$authstr?>">
<div>
<?if (($uclan[founder] == $users[num]) || ($uclan[asst] == $users[num])) clanids();?>
</div>
</form>

<form method='post'>
<?
?>
</form>