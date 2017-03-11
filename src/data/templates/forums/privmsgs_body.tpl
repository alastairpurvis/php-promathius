<table cellspacing="0" cellpadding="0" align="center" width="100%">
  <tr> 
	<td valign="top" align="left" width="100%"> 
	  <table height="40" cellspacing="2" cellpadding="2">
		<tr valign="middle"> 
		  <td><span class="gensmall">{INBOX} &nbsp;</span></td>
		  <td><span class="gensmall">{OUTBOX} &nbsp;</span></td>
		  <td><span class="gensmall">{SENTBOX} &nbsp;</span></td>
		  <td><span class="gensmall">{SAVEBOX} &nbsp;</span></td>

		</tr>
	  </table>
	</td>
	<td align="right" style="padding-top: 7px; padding-right: 25px;"> 
	  <!-- BEGIN switch_box_size_notice -->
	  {Begin_Shadow}
	  <table width="175" cellspacing="0" cellpadding="2" class="forumline">
		<tr> 
		  <td colspan="3" width="175" class="row1" nowrap="nowrap" align="center"><span class="gensmall">{BOX_SIZE_STATUS}</span></td>
		</tr>

	  </table>
	{End_Shadow}
	  <!-- END switch_box_size_notice -->
	</td>
	  <td align="right" ><span class="nav">{POST_PM_IMG}</span></td>
  </tr>
</table>

<br clear="all" />
<form method="post" name="privmsg_list" action="{S_PRIVMSGS_ACTION}">
   <table width="100%" cellspacing="2" align="center" cellpadding="2">
	<tr> 
	  <td align="left" valign="middle" width="100%"><span class="nav">{PAGE_NUMBER}</span></td>
	  <td align="right" valign="top" nowrap="nowrap"><span class="nav">{PAGINATION}<br /></span></td>
	</tr>
  </table>
{Begin_Shadow}
  <table cellpadding="3" cellspacing="0" width="100%" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumhead">
	<tr>
		<td align="center" class="forumheader-mid">{BOX_NAME}</td>
	</tr></table></caption>
</thead>
<tbody>
	<tr> 
	  <th class="forum" width="5%" height="25" class="thCornerL" nowrap="nowrap">&nbsp;Read&nbsp;</th>
	  <th class="forum" width="55%" class="thTop" nowrap="nowrap">&nbsp;&nbsp;</th>
	  <th class="forum" width="15%" class="thTop" nowrap="nowrap">&nbsp;{L_DATE}&nbsp;</th>
	  <th class="forum" width="5%" class="thCornerR" nowrap="nowrap">&nbsp;{L_MARK}&nbsp;</th>
	</tr>
	<!-- BEGIN listrow -->
	<tr class=row1> 
	  <td width="5%" onclick="location.href='{listrow.U_READ}'" align="center" valign="middle"><img src="{listrow.PRIVMSG_FOLDER_IMG}" width="16" height="16" alt="{listrow.L_PRIVMSG_FOLDER_ALT}" title="{listrow.L_PRIVMSG_FOLDER_ALT}" /></td>
	  <td width="55%" onclick="location.href='{listrow.U_READ}'" valign="middle" style="padding-top: 8px; padding-bottom:14px"><span><script language="JavaScript">FolderStart('{listrow.PRIVMSG_FOLDER_IMG}');</script><a href="{listrow.U_FROM_USER_PROFILE}"><b>{listrow.FROM}</b></a><Br>{listrow.SUBJECT}<script language="JavaScript">FolderEnd();</script></span></td>
	  <td width="20%" onclick="location.href='{listrow.U_READ}'" align="center" valign="middle"><span class="postdetails">{listrow.DATE}</span></td>
	  <td width="5%" align="center" valign="middle" style="cursor: default"><span class="cbstyled"> 
		<input type="checkbox" name="mark[]2" value="{listrow.S_MARK_ID}" />
		</span></td>
	</tr>
	<!-- END listrow -->
	<!-- BEGIN switch_no_messages -->
	<tr> 
	  <td class="row1" colspan="5" align="center" valign="middle"><span class="gen">{L_NO_MESSAGES}<br /><br /></span></td>
	</tr>
	<!-- END switch_no_messages -->
	<tr> 
	  <td class="catBottom" colspan="5" height="28" align="right"> {S_HIDDEN_FIELDS} 
		<input type="submit" name="save" value="Save" class="mainoption" />
		&nbsp; 
		<input type="submit" name="delete" value="Delete" class="liteoption" />
		&nbsp; 
		<input type="submit" name="deleteall" value="Delete All" class="liteoption" />
	  </td>
	</tr>
   </tbody>
  </table>
  {End_Shadow}

  <table width="100%" cellspacing="2" align="center" cellpadding="2">
	<tr> 
	  <td align="left" valign="middle"><span class="nav">{POST_PM_IMG}</span></td>
	  <td align="left" valign="middle" width="100%"><span class="nav">{PAGE_NUMBER}</span></td>
	  <td align="right" valign="top" nowrap="nowrap"><span class="nav">{PAGINATION}<br /></span></td>
	</tr>
  </table>
</form>

<table width="100%">
  <tr> 
			<!-- BEGIN switch_in_forum -->
	<td align="right" valign="top">{JUMPBOX}</td>
			<!-- END switch_in_forum -->

  </tr>
</table>