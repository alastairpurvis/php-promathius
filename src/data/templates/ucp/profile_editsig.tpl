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
                    <tr><td class="gensmall"><b>Signature</b></td></tr>
                    <tr><td><b><a href="ucp.php?mode=editavatar" class="gensmall">Avatar</a></b></td></tr>
                    <tr><td><b><a href="ucp.php?mode=editaccount" class="gensmall">Account Settings</a></b></td></tr>
                <tr><th><span class="gensmall"><b>Preferences</th></tr>
                    <tr><td><b><a href="ucp.php?mode=editprefs" class="gensmall">Forum Preferences</a></b></td></tr><td><tr>
                <!-- BEGIN switch_is_empire -->
                <tr><th><span class="gensmall"><b>Empire</th></tr>
                    <tr><td><b><a href="ucp.php?mode=delempire" class="gensmall">Abandon</a></b></td></tr><td><tr>
                <!-- END switch_is_empire -->
			</table>
	</tr>
	</td>
	</tr>
	</table>
				{End_Shadow}
</td>






<td width=2%>
<td>
{ERROR_BOX} 
{Begin_Shadow}
<table cellpadding="3" cellspacing="0" width="100%" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader"">
	<tr>

		<td align="center" class="forumheader-mid"><b>Edit Signature</b></td>

	</tr></table></caption>
</thead>
<tbody>
	<tr> 
	  <td class="row1" width=100%><span class="gensmall">{L_SIGNATURE_EXPLAIN}</td></tr>
	  <tr>
	  <td class="row2" align=center> 
		<textarea name="signature" style="width: 98%" rows="8" cols="30" class="post">{SIGNATURE}</textarea>
	  </td>
	</tr>
		<tr>
	<td class="row1" width=100% align=right><span class="gensmall">{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span></td></tr>
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr>
</tbody>
</table>
{End_Shadow}
</form>
</td>
</tr>
</table>


