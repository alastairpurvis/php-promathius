
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
				<tr><td class="highlight"><b><a href="ucp.php?mode=editprofile" class="gensmall">> Profile</a></b></td></tr>
				<tr><td><b><a href="ucp.php?mode=editsig" class="gensmall">> Signature</a></b></td></tr>
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

		<td align="center" class="catsmall"><b>Edit Profile</b></td>

	</tr></table></caption>
</thead>
<tbody>
	<tr>
	  <td class="row2" colspan="2"><span class="gensmall">Please note that this information will be viewable to other members. Be careful when including any personal details. Any fields marked with a * must be completed.</span></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_ICQ_NUMBER}:</span></td>
	  <td class="row2"> 
		<input type="text" name="icq" class="post" style="width: 100px"  size="10" maxlength="15" value="{ICQ}" />
	  </td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_AIM}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post" style="width: 150px"  name="aim" size="20" maxlength="255" value="{AIM}" />
	  </td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_MESSENGER}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post" style="width: 150px"  name="msn" size="20" maxlength="255" value="{MSN}" />
	  </td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_YAHOO}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post" style="width: 150px"  name="yim" size="20" maxlength="255" value="{YIM}" />
	  </td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">Jabber address:</span></td>
	  <td class="row2"> 
		<input type="text" class="post" style="width: 150px"  name="jim" size="20" maxlength="255" value="{JIM}" />
	  </td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_WEBSITE}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post" style="width: 200px"  name="website" size="25" maxlength="255" value="{WEBSITE}" />
	  </td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_LOCATION}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post" style="width: 200px"  name="location" size="25" maxlength="100" value="{LOCATION}" />
	  </td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_OCCUPATION}:</span></td>
	  <td class="row2"> 
		<input type="text" class="post" style="width: 200px"  name="occupation" size="25" maxlength="100" value="{OCCUPATION}" />
	  </td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_INTERESTS}:</span></td>
	  <td class="row2"> 
		<textarea type="text" class="post" style="width: 58%" rows="3" cols="20" maxlength="50"  name="interests" />{INTERESTS}</textarea>
	  </td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr>
</tbody>
</table>

</form>
</td>
</tr>
</table>


