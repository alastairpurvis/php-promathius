 
<form action="{S_GROUPCP_ACTION}" method="post">

<table width="100%" cellspacing="2" cellpadding="2" align="center">
	<tr>
		<td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	</tr>
</table>

<table class="forumline" width="100%" cellspacing="0" cellpadding="4">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid">{L_GROUP_INFORMATION}</td>
	</tr></table></caption>
</thead>
<tbody>
	<tr> 
		<td class="row1" width="20%"><span class="gen">{L_GROUP_NAME}:</span></td>
		<td class="row2"><span class="gen"><b>{GROUP_NAME}</b></span></td>
	</tr>
	<tr> 
		<td class="row1" width="20%"><span class="gen">{L_GROUP_DESC}:</span></td>
		<td class="row2"><span class="gen">{GROUP_DESC}&nbsp;</span></td>
	</tr>
	<tr> 
		<td class="row1" width="20%"><span class="gen">{L_GROUP_MEMBERSHIP}:</span></td>
		<td class="row2"><span class="gen">{GROUP_DETAILS} &nbsp;&nbsp;
		<!-- BEGIN switch_subscribe_group_input -->
		<input class="mainoption" type="submit" name="joingroup" value="{L_JOIN_GROUP}" />
		<!-- END switch_subscribe_group_input -->
		<!-- BEGIN switch_unsubscribe_group_input -->
		<input class="mainoption" type="submit" name="unsub" value="{L_UNSUBSCRIBE_GROUP}" />
		<!-- END switch_unsubscribe_group_input -->
		</span></td>
	</tr>
	<!-- BEGIN switch_mod_option -->
	<tr> 
		<td class="row1" width="20%"><span class="gen">{L_GROUP_TYPE}:</span></td>
		<td class="row2"><table cellspacing="0" cellpadding="1"><tr>
			<td width="20"><span class="rbstyled"><input type="radio" name="group_type" value="{S_GROUP_OPEN_TYPE}" {S_GROUP_OPEN_CHECKED} /></span></td>
			<td><span class="gen">{L_GROUP_OPEN} &nbsp;&nbsp;</span></td>
			<td width="20"><span class="rbstyled"><input type="radio" name="group_type" value="{S_GROUP_CLOSED_TYPE}" {S_GROUP_CLOSED_CHECKED} /></span></td>
			<td><span class="gen">{L_GROUP_CLOSED} &nbsp;&nbsp;</span></td>
			<td width="20"><span class="rbstyled"><input type="radio" name="group_type" value="{S_GROUP_HIDDEN_TYPE}" {S_GROUP_HIDDEN_CHECKED} /></span></td>
			<td><span class="gen">{L_GROUP_HIDDEN} &nbsp;&nbsp;</span></td>
			<td><input class="mainoption" type="submit" name="groupstatus" value="{L_UPDATE}" /></td>
		</tr>
		</table></td>
	</tr>
	<!-- END switch_mod_option -->
</tbody>
</table>

{S_HIDDEN_FIELDS}

</form>

<br class="spacer" />

<form action="{S_GROUPCP_ACTION}" method="post" name="post">
<table width="100%" cellpadding="4" cellspacing="0" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid">{L_GROUP_MODERATOR}</td>
	</tr></table></caption>
</thead>
<tbody>
	<tr> 
	  <th class="forum" class="thCornerL" height="25">{L_PM}</th>
	  <th class="forum" class="thTop">{L_USERNAME}</th>
	  <th class="forum" class="thTop">{L_POSTS}</th>
	  <th class="forum" class="thTop">{L_FROM}</th>
	  <th class="forum" class="thTop">{L_EMAIL}</th>
	  <th class="forum" class="thTop">{L_WEBSITE}</th>
	  <th class="forum" class="thCornerR">{L_SELECT}</th>
	</tr>
	<tr> 
	  <td class="catSides" colspan="8"><span class="cattitle">{L_GROUP_MODERATOR}</span></td>
	</tr>
	<tr> 
	  <td class="row1" align="center">&nbsp;{MOD_PM_IMG}&nbsp;</td>
	  <td class="row1" align="center"><span class="gen"><a href="{U_MOD_VIEWPROFILE}" class="gen">{MOD_USERNAME}</a></span></td>
	  <td class="row1" align="center" valign="middle"><span class="gen">{MOD_POSTS}</span></td>
	  <td class="row1" align="center" valign="middle"><span class="gen">{MOD_FROM}&nbsp;</span></td>
	  <td class="row1" align="center" valign="middle"><span class="gen">&nbsp;{MOD_EMAIL_IMG}&nbsp;</span></td>
	  <td class="row1" align="center">&nbsp;{MOD_WWW_IMG}&nbsp;</td>
	  <td class="row1" align="center">&nbsp;</td>
	</tr>
	<tr> 
	  <td class="catSides" colspan="8"><span class="cattitle">{L_GROUP_MEMBERS}</span></td>
	</tr>
	<!-- BEGIN member_row -->
	<tr> 
	  <td class="{member_row.ROW_CLASS}" align="center">&nbsp;{member_row.PM_IMG}&nbsp;</td>
	  <td class="{member_row.ROW_CLASS}" align="center"><span class="gen"><a href="{member_row.U_VIEWPROFILE}" class="gen">{member_row.USERNAME}</a></span></td>
	  <td class="{member_row.ROW_CLASS}" align="center"><span class="gen">{member_row.POSTS}</span></td>
	  <td class="{member_row.ROW_CLASS}" align="center"><span class="gen">{member_row.FROM}&nbsp;</span></td>
	  <td class="{member_row.ROW_CLASS}" align="center" valign="middle"><span class="gen">&nbsp;{member_row.EMAIL_IMG}&nbsp;</span></td>
	  <td class="{member_row.ROW_CLASS}" align="center">&nbsp;{member_row.WWW_IMG}&nbsp;</td>
	  <td class="{member_row.ROW_CLASS}" align="center">
	  <!-- BEGIN switch_mod_option -->
	  <span class="cbstyled"><input type="checkbox" name="members[]" value="{member_row.USER_ID}" /></span>
	  <!-- END switch_mod_option -->
	  </td>
	</tr>
	<!-- END member_row -->

	<!-- BEGIN switch_no_members -->
	<tr> 
	  <td class="row1" colspan="7" align="center"><span class="gen">{L_NO_MEMBERS}</span></td>
	</tr>
	<!-- END switch_no_members -->

	<!-- BEGIN switch_hidden_group -->
	<tr> 
	  <td class="row1" colspan="7" align="center"><span class="gen">{L_HIDDEN_MEMBERS}</span></td>
	</tr>
	<!-- END switch_hidden_group -->

	<!-- BEGIN switch_mod_option -->
	<tr>
		<td class="catBottom" colspan="8" align="right">
			<span class="cattitle"><input type="submit" name="remove" value="{L_REMOVE_SELECTED}" class="mainoption" /></span>
		</td>
	</tr>
	<!-- END switch_mod_option -->
</tbody>
</table>

<table width="100%" cellspacing="2" align="center" cellpadding="2">
	<tr>
		<td align="left" valign="top">
		<!-- BEGIN switch_mod_option -->
		<span class="genmed"><input type="text"  class="post" name="username" maxlength="50" size="20" /> <input type="submit" name="add" value="{L_ADD_MEMBER}" class="mainoption" /> <input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></span><br /><br />
		<!-- END switch_mod_option -->
		<span class="nav">{PAGE_NUMBER}</span></td>
		<td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span></td>
	</tr>
</table>

{PENDING_USER_BOX}

{S_HIDDEN_FIELDS}</form>

<table width="100%" cellspacing="2" align="center">
  <tr> 
	<td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>
