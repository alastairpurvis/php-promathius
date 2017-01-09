<table width="100%" cellspacing="0" cellpadding="2" align="center">
  <tr> 
	<td align="left" valign="bottom"><span class="gensmall">
	<!-- BEGIN switch_user_logged_in -->
	{LAST_VISIT_DATE}<br />
	<!-- END switch_user_logged_in -->
	{CURRENT_TIME}<br /></span><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
	<td align="right" valign="bottom" class="gensmall">
		<!-- BEGIN switch_user_logged_in -->
		<a href="{U_SEARCH_NEW}" class="gensmall">{L_SEARCH_NEW}</a><br /><a href="{U_SEARCH_SELF}" class="gensmall">{L_SEARCH_SELF}</a><br />
		<!-- END switch_user_logged_in -->
		<a href="{U_SEARCH_UNANSWERED}" class="gensmall">{L_SEARCH_UNANSWERED}</a></td>
  </tr>
</table>

<!-- BEGIN catrow -->
<table width="100%" cellpadding="2" cellspacing="0" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid"><a href="{catrow.U_VIEWCAT}">{catrow.CAT_DESC}</a></td>
	</tr></table></caption>
</thead>
<tbody>
<tr> 
	<th class="forum" colspan="2">{L_FORUM}</th>
	<th class="forum" width="50">{L_TOPICS}</th>
	<th class="forum" width="50">{L_POSTS}</th>
	<th class="forum">{L_LASTPOST}</th>
</tr>
<!-- BEGIN forumrow -->
<tr> 
	<td class="row1" align="center" valign="middle" style="padding: 5px;"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" width="25" height="25" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></td>
	<td class="row1" width="100%"><span class="forumlink"> <script language="JavaScript">FolderStart('{catrow.forumrow.FORUM_FOLDER_IMG}');</script><a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink">{catrow.forumrow.FORUM_NAME}</a><script language="JavaScript">FolderEnd();</script><br />
	  </span> <span class="genmed">{catrow.forumrow.FORUM_DESC}<br />
	  </span><span class="gensmall">{catrow.forumrow.L_MODERATOR} {catrow.forumrow.MODERATORS}</span></td>
	<td class="row2" align="center" valign="middle"><span class="gensmall">{catrow.forumrow.TOPICS}</span></td>
	<td class="row2" align="center" valign="middle"><span class="gensmall">{catrow.forumrow.POSTS}</span></td>
	<td class="row2" align="center" valign="middle" nowrap="nowrap"> <span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
</tr>
<!-- END forumrow -->
</tbody>
</table>
<br class="spacer" />
<!-- END catrow -->

<table width="100%" cellspacing="0" align="center" cellpadding="2">
  <tr> 
	<td align="left">
 	<!-- BEGIN switch_user_logged_in -->
 		<span class="gensmall"><a href="{U_MARK_READ}" class="gensmall">{L_MARK_FORUMS_READ}</a></span>
 	<!-- END switch_user_logged_in -->
 	</td>
	<td align="right"><span class="gensmall">{S_TIMEZONE}</span></td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="0" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid"><a href="{U_VIEWONLINE}">{L_WHO_IS_ONLINE}</a></td>
	</tr></table></caption>
</thead>
<tbody>
<tr> 
	<td class="row1" align="center" valign="middle" rowspan="2" style="padding: 5px;"><img src="../data/images/forums/whosonline.gif" alt="{L_WHO_IS_ONLINE}" width="25" height="25" /></td>
	<td class="row1" align="left" width="100%"><span class="gensmall">{TOTAL_POSTS}<br />{TOTAL_USERS}<br />{NEWEST_USER}</span>
	</td>
</tr>
<tr> 
	<td class="row1" align="left"><span class="gensmall">{TOTAL_USERS_ONLINE} &nbsp; [ {L_WHOSONLINE_ADMIN} ] &nbsp; [ {L_WHOSONLINE_MOD} ]<br />{RECORD_USERS}<br />{LOGGED_IN_USER_LIST}</span></td>
</tr>
</tbody>
</table>

<table width="100%" cellpadding="1" cellspacing="1">
<tr>
	<td align="left" valign="top"><span class="gensmall">{L_ONLINE_EXPLAIN}</span></td>
</tr>
</table>

<!-- BEGIN switch_user_logged_out -->
<form method="post" action="{S_LOGIN_ACTION}">
  <table width="100%" cellpadding="2" cellspacing="0" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid"><a name="login"></a>{L_LOGIN_LOGOUT}</td>
	</tr></table></caption>
</thead>
<tbody>
	<tr> 
	  <td class="row1" align="center" valign="middle"><table cellspacing="0" cellpadding="1">
	  <tr>
		<td><span class="gensmall">{L_USERNAME}:</span></td>
		<td><input class="post" type="text" name="username" size="10" /></td>
		<td><span class="gensmall">&nbsp;&nbsp;&nbsp;{L_PASSWORD}:</span>
		<td><input class="post" type="password" name="password" size="10" maxlength="32" /></td>
		<!-- BEGIN switch_allow_autologin -->
		<td><span class="gensmall">&nbsp;&nbsp; &nbsp;&nbsp;{L_AUTO_LOGIN}</span></td>
		<td width="20"><span class="cbstyled"><input type="checkbox" name="autologin" /></span></td>
		<!-- END switch_allow_autologin -->
		<td><span class="gensmall">&nbsp;&nbsp;&nbsp;</span></td>
		<td><input type="submit" class="mainoption" name="login" value="{L_LOGIN}" /></td>
	  </tr>
	  </table></td>
	</tr>
   </tbody>
  </table>
</form>
<!-- END switch_user_logged_out -->

<br clear="all" />

<table cellspacing="3" align="center" cellpadding="0">
  <tr> 
	<td width="20" align="center"><img src="../data/images/forums/folder_new_big.gif" alt="{L_NEW_POSTS}" width="25" height="25" /></td>
	<td><span class="gensmall">{L_NEW_POSTS}</span></td>
	<td>&nbsp;&nbsp;</td>
	<td width="20" align="center"><img src="../data/images/forums/folder_big.gif" alt="{L_NO_NEW_POSTS}" width="25" height="25" /></td>
	<td><span class="gensmall">{L_NO_NEW_POSTS}</span></td>
	<td>&nbsp;&nbsp;</td>
	<td width="20" align="center"><img src="../data/images/forums/folder_locked_big.gif" alt="{L_FORUM_LOCKED}" width="25" height="25" /></td>
	<td><span class="gensmall">{L_FORUM_LOCKED}</span></td>
  </tr>
</table>
