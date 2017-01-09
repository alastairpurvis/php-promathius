<br />
<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post">

<table width="100%" cellspacing="0" cellpadding="0" align="center">
<tr>
<td width=18% valign=top>
{Begin_Shadow}
	<table cellspacing="0" cellpadding="0" width="100%">
	<tr>
	<td class="row1">
			<table class="cp" cellspacing="0" width="100%">
                <tr><td><span class="gensmall"><b><center>Control Panel<br /><br /></td></tr>
                <tr><th><span class="gensmall"><b>Overview</th></tr>
                    <tr><td><b><a href="ucp.php" class="gensmall">Front Page</a></b></td></tr>
                <tr><th><span class="gensmall"><b>Profile</th></tr>
                    <tr><td><b><a href="ucp.php?mode=editprofile" class="gensmall">Profile</a></b></td></tr>
                    <tr><td><b><a href="ucp.php?mode=editsig" class="gensmall">Signature</a></b></td></tr>
                    <tr><td><b><a href="ucp.php?mode=editavatar" class="gensmall">Avatar</a></b></td></tr>
                    <tr><td class="gensmall"><b><a href="ucp.php?mode=editaccount" class="gensmall">Account Settings</a></b></td></tr>
                <tr><th><span class="gensmall"><b>Preferences</th></tr>
                    <tr><td><b><a href="ucp.php?mode=editprefs" class="gensmall">Forum Preferences</a></b></td></tr><td><tr>
                <!-- BEGIN switch_is_empire -->
                <tr><th><span class="gensmall"><b>Empire</th></tr>
                    <tr><td><b>Abandon</b></td></tr><td><tr>
                <!-- END switch_is_empire -->
			</table>
	</tr>
	</td>
	</tr>
	</table>
				{End_Shadow}
</td>






<td width=2%>
<td valign=top>
{ERROR_BOX} 
{Begin_Shadow}
<table cellpadding="4" cellspacing="0" width="100%" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>

		<td align="center" class="forumheader-mid"><b>Abandon your Empire</b></td>

	</tr></table></caption>
</thead>
<tbody>
	<tr> 
		<td class="row1" width="100%" style="padding: 5px"><span style="font-size: 11px">It is expected that if you decide to abandon your empire, you have a very legitimate reason to do so. This desertion will appear on your profile and will not be removable. <b>You will have to wait at least {L_ABANDON_DELAY} hours before you will be able to establish a new empire.</b> <br /><br />Note that your account will still remain as is with all your stats and you will still be able to establish as many new empires as you wish under the same account.<br /></span><br /></td>
	</tr>
	</tr>		<tr>
		<td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="Abandon" class="mainoption" /></td>
	</tr></tbody>
</table>
{End_Shadow}
</form>
</td>
</tr>
</table>


