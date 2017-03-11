 
<table width="100%" cellspacing="2" cellpadding="2" align="center">
  <tr> 
	<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
  </tr>
</table>

<table class="forumline" width="100%" cellspacing="0" cellpadding="3" align="center">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid">{L_VIEWING_PROFILE}</td>
	</tr></table></caption>
</thead>
<tbody>
  <tr> 
	<th class="forum" width="40%">{L_AVATAR}</th>
	<th class="forum" width=60%>{L_ABOUT_USER}</th>
  </tr>
  <tr> 
	<td class="row1" height="6" valign="top" align="center">{AVATAR_IMG}
	<!-- BEGIN switch_no_avatar -->
	<span class="genmed">No avatar</span>
	<!-- END switch_no_avatar -->
	<br /><span class="postdetails">{POSTER_RANK}<br />{RANK_IMAGE}</span><br /></td>
	<td class="row1" rowspan="1" valign="top"><table width="100%" cellspacing="1" cellpadding="3">
		<tr> 
		  <td valign="middle" align="right" nowrap="nowrap"><span class="gen">{L_JOINED}:&nbsp;</span></td>
		  <td width="100%"><b><span class="gen">{JOINED}</span></b></td>
		</tr>
		<tr> 
		  <td valign="top" align="right" nowrap="nowrap"><span class="gen">{L_TOTAL_POSTS}:&nbsp;</span></td>
		  <td valign="top"><b><span class="gen">{POSTS}</span></b><br /><span class="genmed">[{POST_PERCENT_STATS} / {POST_DAY_STATS}]</span> <br /><span class="genmed"><a href="{U_SEARCH_USER}" class="genmed">{L_SEARCH_USER_POSTS}</a></span></td>
		</tr>
		<!-- BEGIN switch_has_location -->
		<tr> 
		  <td valign="middle" align="right" nowrap="nowrap"><span class="gen">{L_LOCATION}:&nbsp;</span></td>
		  <td><b><span class="gen">{LOCATION}</span></b></td>
		</tr>
		<!-- END switch_has_location -->
		<!-- BEGIN switch_has_website -->
		<tr> 
		  <td valign="middle" align="right" nowrap="nowrap"><span class="gen">{L_WEBSITE}:&nbsp;</span></td>
		  <td><span class="gen"><b>{WWW}</b></span></td>
		</tr>
		<!-- END switch_has_website -->
		<!-- BEGIN switch_has_occ -->
		<tr> 
		  <td valign="middle" align="right" nowrap="nowrap"><span class="gen">{L_OCCUPATION}:&nbsp;</span></td>
		  <td><b><span class="gen">{OCCUPATION}</span></b></td>
		</tr>
		<!-- END switch_has_occ -->
		<!-- BEGIN switch_has_interests -->
		<tr> 
		  <td valign="top" align="right" nowrap="nowrap"><span class="gen">{L_INTERESTS}:&nbsp;</span></td>
		  <td> <b><span class="gen">{INTERESTS}</span></b></td>
		</tr>
		<!-- END switch_has_aim -->
	  </table>
	</td>
  </tr>
  <tr> 
	<th class="forum" width=40%>{L_CONTACT} {USERNAME}</th>
	<th class="forum" width=60%>Promethius</th>
  </tr>
  <tr> 
	<td class="row1" valign="top"><table width="100%" cellspacing="1" cellpadding="3">
	<!-- BEGIN switch_has_email -->
		<tr> 
		  <td valign="middle" align="right" nowrap="nowrap"><span class="gen">{L_EMAIL_ADDRESS}:</span></td>
		  <td valign="middle" width="100%"><b><span class="gen">{EMAIL_IMG}</span></b></td>
		</tr>
	<!-- END switch_has_email -->
		<tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">{L_PM}:</span></td>
		  <td valign="middle" width="100%"><b><span class="gen">{PM_IMG}</span></b></td>
		</tr>
		<!-- BEGIN switch_has_msn -->
		<tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">{L_MESSENGER}:</span></td>
		  <td valign="middle"><span class="gen">{MSN}</span></td>
		</tr>
		<!-- END switch_has_msn -->
		<!-- BEGIN switch_has_yim -->
		<tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">{L_YAHOO}:</span></td>
		  <td valign="middle"><span class="gen">{YIM}</span></td>
		</tr>
		<!-- END switch_has_yim -->
		<!-- BEGIN switch_has_aim -->
		<tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">{L_AIM}:</span></td>
		  <td valign="middle"><span class="gen">{AIM}</span></td>
		</tr>
		<!-- END switch_has_aim -->
		<!-- BEGIN switch_has_icq -->
		<tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">{L_ICQ_NUMBER}:</span></td>
		  <td valign="middle"><span class="gen">{ICQ}</span></td>
		</tr>
		<!-- END switch_has_icq -->
		<!-- BEGIN switch_has_jim -->
		<tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">Jabber Address:</span></td>
		  <td valign="middle"><span class="gen">{JIM}</span></td>
		</tr>
		<!-- END switch_has_jim -->
		<tr>
		<td height="3"></td>
		</tr>
	  </table>

		<td class="row1" valign="top"><table width="100%" cellspacing="1" cellpadding="3">
        			<tr> 
		  <td valign="middle" align="right" nowrap="nowrap"><span class="gen">Player Rating:&nbsp;</span></td>
		  <td width="100%"><b><span class="gen">{PLAYER_SCORE}</span></b></td>
		</tr>
			<tr> 
		  <td valign="middle" align="right" nowrap="nowrap"><span class="gen">Empire:&nbsp;</span></td>
								<!-- BEGIN switch_user_logged_in -->
		  <td width="100%"><b><span class="gen">{CURRENT_EMPIRE_LINK}</span></b></td>
		  		  					<!-- END switch_user_logged_in -->
								<!-- BEGIN switch_user_logged_out -->
		  <td width="100%"><b><span class="gen">{CURRENT_EMPIRE}</span></b></td>
		  		  					<!-- END switch_user_logged_out -->
		  		</tr>
		  					<tr> 
		  <td valign="middle" align="right" nowrap="nowrap"><span class="gen">Empire Rank:&nbsp;</span></td>
		  <td width="100%"><b><span class="gen">#{CURRENT_RANK}</span></b></td>
		</tr>
									<!-- BEGIN switch_user_logged_in -->
			{CLAN_LINK}
				  		  					<!-- END switch_user_logged_in -->
									<!-- BEGIN switch_user_logged_out -->
			{CLAN}
				  		  					<!-- END switch_user_logged_out -->
			<tr> 
		  <td valign="middle" align="right" nowrap="nowrap"><span class="gen">Empires Ruled:&nbsp;</span></td>
		  <td width="100%"><b><span class="gen">{EMPIRES_OWNED}</span></b></td>
		</tr>
			<tr> 
		  <td valign="middle" align="right" nowrap="nowrap"><span class="gen">Empires Abandoned:&nbsp;</span></td>
		  <td width="100%"><b><span class="gen">{EMPIRES_ABANDONED}</span></b></td>
		</tr>
			<tr> 
		  <td valign="middle" align="right" nowrap="nowrap"><span class="gen">Max Greatness Ever Achieved:&nbsp;</span></td>
		  <td width="100%"><b><span class="gen">{GREATEST_SCORE}</span></b></td>
		</tr>
		</table>
	</td>
  </tr>
</tbody>
</table>

<table width="100%" cellspacing="0" cellpadding="0" align="center">
  <tr> 
	<td align="right"><span class="nav"><br />{JUMPBOX}</span></td>
  </tr>
</table>
