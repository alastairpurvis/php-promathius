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
	  <td align="right" ><span class="nav">{REPLY_PM_IMG}</span></td>
  </tr>
</table>

<br clear="all" />

<form method="post" action="{S_PRIVMSGS_ACTION}">
   <table width="100%" cellspacing="2" align="center" cellpadding="2">
	<tr> 
	  <td align="left" valign="middle" width="100%"><span class="nav">&nbsp</span></td>
	</tr>
  </table>
{Begin_Shadow}
<table cellpadding="4" cellspacing="0" width="100%" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumhead">
	<tr>
		<td align="center" class="forumheader-mid">{POST_SUBJECT}</td>
	</tr></table></caption>
</thead>
<tbody>
	<tr>
		<th class="forum" class="thLeft" width="150" height="26" nowrap="nowrap">{MESSAGE_FROM}</th>
		<th class="forum" colspan=3 class="thRight" nowrap="nowrap"></th>
	</tr>
	<tr> 
		<td width=17% align="center" valign="top" class="row1"><span class="gen">
			<br />
			{POSTER_AVATAR}<br /><br />

		</span></td>
	  <td valign="top" colspan="3" class="row1" style="padding: 15px;"><span class="postbody">{MESSAGE}</span></td>
	</tr>
	<tr> 
		  <tr> 
		<td class="posterprofile" align="center" valign="middle" nowrap="nowrap">{POST_DATE}</td>
			<td width=100% valign="middle" nowrap="nowrap">{PROFILE_IMG} {PM_IMG} {EMAIL_IMG} 
			  {WWW_IMG} {AIM_IMG} {YIM_IMG} {MSN_IMG}</td><td>&nbsp;</td><td valign="top" nowrap="nowrap"><script language="JavaScript" type="text/javascript"><!-- 

		if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 && navigator.userAgent.indexOf('6.') == -1 )
			document.write('{ICQ_IMG}');
		else
			document.write('<div style="position:relative"><div style="position:absolute">{ICQ_IMG}</div><div style="position:absolute;left:3px">{ICQ_STATUS_IMG}</div></div>');
		  
		  //--></script><noscript>{ICQ_IMG}</noscript></td>
	  </td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="4" height="28" align="right"> {S_HIDDEN_FIELDS} 
		<input type="submit" name="save" value="Save" class="liteoption" />
		&nbsp; 
		<input type="submit" name="delete" value="Delete" class="liteoption" />
	  </td>
	</tr>
	</tbody>
  </table>
    {End_Shadow}
</form>

<table width="100%" cellspacing="2" align="center" cellpadding="2">
  <tr> 
			<!-- BEGIN switch_in_forum -->
	<td valign="top" align="right"><span class="gensmall">{JUMPBOX}</span></td>
			<!-- END switch_in_forum -->

  </tr>
</table>
