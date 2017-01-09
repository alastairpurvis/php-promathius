
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
				<tr><td><b><a href="ucp.php?mode=editsig" class="gensmall">> Signature</a></b></td></tr>
				<tr><td><b><a href="ucp.php?mode=editavatar" class="gensmall">> Avatar</a></b></td></tr>
				<tr><td class="highlight"><b><a href="ucp.php?mode=editaccount" class="gensmall">> Account Settings</a></b></td></tr>
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

		<td align="center" class="catsmall"><b>Edit Account Settings</b></td>

	</tr></table></caption>
</thead>
<tbody>
	<!-- BEGIN switch_namechange_disallowed -->
	<tr> 
		<td class="row1" width="38%"><span class="gen">{L_USERNAME}: </span></td>
		<td class="row2"><input type="hidden" name="username" value="{USERNAME}" /><span class="gen"><b>{USERNAME}</b></span></td>
	</tr>
	<!-- END switch_namechange_disallowed -->
	<!-- BEGIN switch_namechange_allowed -->
	<tr> 
		<td class="row1" width="38%"><span class="gen">{L_USERNAME}: </span></td>
		<td class="row2"><input type="text" class="post" style="width:200px" name="username" size="25" maxlength="25" value="{USERNAME}" /></td>
	</tr>
	<!-- END switch_namechange_allowed -->
	<tr> 
		<td class="row1"><span class="gen">{L_EMAIL_ADDRESS}: </span></td>
		<td class="row2"><input type="text" class="post" style="width:200px" name="email" size="25" maxlength="255" value="{EMAIL}" /></td>
	</tr>
	<!-- BEGIN switch_edit_profile -->
	<tr> 
	  <td class="row1"><span class="gen">{L_CURRENT_PASSWORD}: </span><br />
		<span class="gensmall">{L_CONFIRM_PASSWORD_EXPLAIN}</span></td>
	  <td class="row2"> 
		<input type="password" class="post" style="width: 200px" name="cur_password" size="25" maxlength="32" value="{CUR_PASSWORD}" />
	  </td>
	</tr>
	<!-- END switch_edit_profile -->
	<tr> 
	  <td class="row1"><span class="gen">{L_NEW_PASSWORD}: </span><br />
		<span class="gensmall">{L_PASSWORD_IF_CHANGED}</span></td>
	  <td class="row2"> 
		<input type="password" class="post" style="width: 200px" name="new_password" size="25" maxlength="32" value="{NEW_PASSWORD}" />
	  </td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_CONFIRM_PASSWORD}:  </span><br />
		<span class="gensmall">{L_PASSWORD_CONFIRM_IF_CHANGED}</span></td>
	  <td class="row2"> 
		<input type="password" class="post" style="width: 200px" name="password_confirm" size="25" maxlength="32" value="{PASSWORD_CONFIRM}" />
	  </td>
	</tr>		<tr>
		<td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr></tbody>
</table>

</form>
</td>
</tr>
</table>


