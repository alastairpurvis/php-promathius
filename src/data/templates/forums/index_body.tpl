<table width="100%" cellspacing="0" cellpadding="2" align="center">
  <tr> 
	<td align="left" valign="bottom"><span class="gensmall">
	{CURRENT_TIME}<br /></span><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
	<td align="right" valign="bottom" class="gensmall">
		<!-- BEGIN switch_user_logged_in -->
		<a href="{U_SEARCH_NEW}" class="gensmall">{L_SEARCH_NEW}</a><br /><a href="{U_SEARCH_SELF}" class="gensmall">{L_SEARCH_SELF}</a><br />
		<!-- END switch_user_logged_in -->
		<a href="{U_SEARCH_UNANSWERED}" class="gensmall">{L_SEARCH_UNANSWERED}</a></td>
  </tr>
</table>

<!-- BEGIN catrow -->
{Begin_Shadow}
<table width="100%" cellpadding="2" cellspacing="0" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumhead">
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
<tr class="row1"> 
	<td onclick="location.href='{catrow.forumrow.U_VIEWFORUM}'" class="rowinv" align="center" valign="middle" style="padding: 5px; padding-left: 14px"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></td>
	<td onclick="location.href='{catrow.forumrow.U_VIEWFORUM}'" class="rowinv"  width="100%" style=" padding-top: 10px;padding-left: 18px"><span class="forumlink"> <script language="JavaScript">FolderStart('{catrow.forumrow.FORUM_FOLDER_IMG}');</script><a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink">{catrow.forumrow.FORUM_NAME}</a><script language="JavaScript">FolderEnd();</script><br />
	  </span> <span class="genmed">{catrow.forumrow.FORUM_DESC}<br />
	  </span><span class="gensmall">{catrow.forumrow.L_MODERATOR} {catrow.forumrow.MODERATORS}</span></td>
	<td onclick="location.href='{catrow.forumrow.U_VIEWFORUM}'" class="rowinv"  align="center" valign="middle"><span class="gensmall">{catrow.forumrow.TOPICS}</span></td>
	<td onclick="location.href='{catrow.forumrow.U_VIEWFORUM}'" class="rowinv"  align="center" valign="middle"><span class="gensmall">{catrow.forumrow.POSTS}</span></td>
	<td class="rowinv"  align="center" valign="middle" nowrap="nowrap" style="cursor: default"> <span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
</tr>
<!-- END forumrow -->
</tbody>
</table>
{End_Shadow}
<!-- END catrow -->

<table width="100%" cellspacing="0" align="center" cellpadding="2">
  <tr> 
	<td align="left">
 	<!-- BEGIN switch_user_logged_in -->
 		<span class="gensmall"><a href="{U_MARK_READ}" class="gensmall">{L_MARK_FORUMS_READ}</a></span>
 	<!-- END switch_user_logged_in -->
 	</td>
  </tr>
</table>

{Begin_Shadow}
<table width="100%" cellpadding="3" cellspacing="0" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid"><a href="{U_VIEWONLINE}">{L_WHO_IS_ONLINE}</a></td>
	</tr></table></caption>
</thead>
<tbody>
<tr> 
	<Td></td>
	<td class="row1" align="left" style="padding-bottom:10px;padding-top:10px"><span class="gensmall">{TOTAL_USERS_ONLINE} &nbsp; [ {L_WHOSONLINE_ADMIN} ] &nbsp; [ {L_WHOSONLINE_MOD} ]<br />{LOGGED_IN_USER_LIST}</span></td>
</tr>
<tr> 
	<td class="row1" align="center" valign="middle" rowspan="2" style="padding: 5px;"><img src="../data/images/forums/whosonline.gif" alt="{L_WHO_IS_ONLINE}" /></td>
	<td class="row1" align="left" width="100%"><span class="gensmall">{TOTAL_POSTS}&nbsp;&nbsp;|&nbsp;&nbsp;{TOTAL_USERS}&nbsp;&nbsp;|&nbsp;&nbsp;{NEWEST_USER}</span>
	</td>
</tr>
</tbody>
</table>
{End_Shadow}

<table width="100%" cellpadding="1" cellspacing="1">
<tr>
	<td align="left" valign="top"><span class="gensmall">{L_ONLINE_EXPLAIN}</span></td>
</tr>
</table>

<br clear="all" />

<table cellspacing="3" align="center" cellpadding="0">
  <tr> 
	<td width="20" align="center"><img src="../data/images/forums/folder_new_big.gif" alt="{L_NEW_POSTS}" /></td>
	<td><span class="gensmall">{L_NEW_POSTS}</span></td>
	<td>&nbsp;&nbsp;</td>
	<td width="20" align="center"><img src="../data/images/forums/folder_big.gif" alt="{L_NO_NEW_POSTS}" /></td>
	<td><span class="gensmall">{L_NO_NEW_POSTS}</span></td>
	<td>&nbsp;&nbsp;</td>
	<td width="20" align="center"><img src="../data/images/forums/folder_locked_big.gif" alt="{L_FORUM_LOCKED}" /></td>
	<td><span class="gensmall">{L_FORUM_LOCKED}</span></td>
  </tr>
</table>
