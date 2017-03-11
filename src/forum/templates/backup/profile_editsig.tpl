
<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post">

<table width="100%" cellspacing="0" cellpadding="0" align="center">
<tr>
<td width=17% valign=top>

	<table cellspacing="0" cellpadding="0" width="100%">
	<tr>
	<td class="row1">
			<table cellspacing="0" cellpadding="2" width="100%">
			<tr><td class='catsmall'><span class="gen"><b><center>Control Panel</td></tr>
			<tr><td><span class="gensmall"><b>Profile</td></tr>
				<tr><td><b><a href="ucp.php?mode=editprofile" class="gensmall">> Profile</a></b></td></tr>
				<tr><td class="highlight"><b><a href="ucp.php?mode=editsig" class="gensmall">> Signature</a></b></td></tr>
				<tr><td><b><a href="ucp.php?mode=editavatar" class="gensmall">> Avatar</a></b></td></tr>
				<tr><td><b><a href="ucp.php?mode=editaccount" class="gensmall">> Account Settings</a></b></td></tr>
						<tr><td><span class="gensmall"><b>Preferences</td></tr>
				<tr><td><b><a href="ucp.php?mode=editprefs" class="gensmall">> Forum Preferences</a></b></td></tr><td><tr>
			</table>
	</tr>
	</td>
	</tr>
	</table>
</td>






<td width=1%>
<td>
{ERROR_BOX} 
<table cellpadding="3" cellspacing="0" width="100%" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="catBottom">
	<tr>

		<td align="center" class="catsmall"><b>Edit Signature</b></td>

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

</form>
</td>
</tr>
</table>


