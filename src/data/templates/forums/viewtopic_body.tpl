
<table width="100%" cellspacing="2" cellpadding="2">
  <tr> 
	<td align="left" valign="bottom" colspan="2"><a class="maintitle" href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a><br />
	  &nbsp; </span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2">
  <tr> 
	<td align="left" valign="bottom" nowrap="nowrap"><span class="nav"><a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a></span></td>
	<td align="left" valign="middle" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> 
	  &raquo; <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></span></td>
	 <td align="right" valign="middle" nowrap="nowrap"><b>{PAGINATION}</b>
	  &nbsp;</td>
  </tr>
</table>

{Begin_Shadow}
<table class="forumline" width="100%" cellspacing="0" cellpadding="3">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumhead">
	<tr>
		<td align="center" class="forumheader-mid"><a href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a></td>
	</tr></table></caption>
</thead>
<tbody>
	{POLL_DISPLAY} 
	<!-- BEGIN postrow -->
	<tr>
		<th class="forum" class="thLeft" width="150" height="26" nowrap="nowrap">{postrow.POSTER_NAME}</th>
		<th class="forum" class="thRight" nowrap="nowrap">{postrow.POST_SUBJECT}</th>
	</tr>
	<tr> 
		<td width=17% align="center" valign="top" class="row1"><span class="gen">
			<span class="posterrank">{postrow.POSTER_RANK}<br /></span>
			{postrow.RANK_IMAGE}{postrow.POSTER_AVATAR}<br /><br />
			<table cellspacing="0" cellpadding="2" width="95%">
			<tr>
				<td align="left" class="posterprofile">{postrow.POSTER_JOINED}<br />{postrow.POSTER_POSTS}<br />
				{postrow.POSTER_EMPIRE}<br /></td>
			</tr>
			</table></span><br />
		</span></td>
		<td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="top"><table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%" style="padding: 3px 0;"></td>
				<td valign="top" nowrap="nowrap">{postrow.QUOTE_IMG} {postrow.EDIT_IMG} {postrow.DELETE_IMG} {postrow.IP_IMG}</td>
			</tr>
			<tr>
				<td colspan="2" class="postbody">{postrow.MESSAGE}<br />{postrow.SIGNATURE}<span class="gensmall">{postrow.EDITED_MESSAGE}</span></td>
			</tr>
		</table></td>
	</tr>
	<tr> 
		<td class="posterprofile" align="center" valign="middle" nowrap="nowrap">{postrow.POST_DATE}</td>
		<td class="posterprofile" width="100%" valign="middle" nowrap="nowrap">{postrow.PM_IMG} {postrow.EMAIL_IMG}</td>
	</tr>
	<!-- END postrow -->
	<tr align="center"> 
		<td class="catBottom" colspan="2" height="28"><table cellspacing="0" cellpadding="0">
			<tr></tr>
		</table></td>
	</tr>
</tbody>
</table>
{End_Shadow}

<table width="100%" cellspacing="2" cellpadding="2" align="center">
  <tr> 
	<td align="left" valign="middle" nowrap="nowrap"><span class="nav"><a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a></span></td>
	<td align="left" valign="middle" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> 
	  &raquo; <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></span></td>
	<td align="right" valign="top" nowrap="nowrap"><span class="nav">{PAGINATION}</span> 
	  </td>
  </tr>
  <tr>
	<td align="left" colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" align="center">
  <tr> 
	<td width="40%" valign="top" nowrap="nowrap" align="left"><span class="gensmall">{S_WATCH_TOPIC}</span><br />
	  &nbsp;<br />
	  {S_TOPIC_ADMIN}</td>
	<td align="right" valign="top" nowrap="nowrap">{JUMPBOX}</td>
  </tr>
</table>
