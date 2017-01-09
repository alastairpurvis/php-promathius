<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

include($game_root_path.'/header.php');
if($php_block == "No") $do_mission = 0;

include($game_root_path."/lib/magicfun.php");

?> <a href="?guide&amp;section=magic&amp;era=<?=$users[region]?><?=$authstr?>"><?=$gamename?> Guide: Missions</a><br />
<form name="magic_form" method="post" action="?magic<?=$authstr?>" onSubmit="
if(document.magic_form.mission_num.options[document.magic_form.mission_num.selectedIndex].value==<?=$spnumbyname['missionkill']?>) {
	temp = window.confirm('Performing Seppuku will destroy ALL of your troops and peasants as well as a portion of your <?=$uera[wizards]?>. Do you still want to perform this mission?');
	if(temp==1) {
		document.forms.magic_form.jsenabled.value = 'jsenabled';
		document.forms.magic_form.submit();
	}
	else {
		return false;
	}
		
}
else
	document.forms.magic_form.submit();
">
<table class="inputtable">
<tr><td><select name="mission_num" size="1" class="dkbg">
        <option value="0">Select a Mission</option>
<?
for ($i = 1; $i <= $missions; $i++)
	if ($sptype[$i] == 'd')
		printMRow($i);
?>
        </select></td></tr>
<tr><td class="acenter">How many times: <input type="text" name="num_times" value="1" length="3"></td></tr>
<input type="hidden" name="jsenabled" value="">
<tr><td class="acenter"><input type="submit" name="do_mission" value="Perform Mission"></td></tr>
<tr><td><input type="checkbox" name="hide_turns"<?=$cnd?>> Condense Turns?</td></tr>

</table>
</form>
<?
if ($users[shield] > $time)
	print "<i>We currently have a patrol around our ".$uera[empire].", which will last for ".round(($users[shield]-$time)/3600,1)." more hours.</i><br />\n";
if ($users[gate] > $time)
	print "<i>We currently have troops prepared for attack which will last for ".round(($users[gate]-$time)/3600,1)." more hours.</i><br />\n";
endScript("");
?>
