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
                    <tr><td class="gensmall"><b>Account Settings</b></td></tr>
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
<table cellpadding="4" cellspacing="0" width="100%" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>

		<td align="center" class="forumheader-mid"><b>Edit Account Settings</b></td>

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
{End_Shadow}
</form>
</td>
</tr>
</table>


