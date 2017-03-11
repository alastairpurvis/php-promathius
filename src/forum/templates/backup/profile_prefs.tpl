
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
				<tr><td><b><a href="ucp.php?mode=editaccount" class="gensmall">> Account Settings</a></b></td></tr>
						<tr><td><span class="gensmall"><b>Preferences</td></tr>
				<tr><td class="highlight"><b><a href="ucp.php?mode=editprefs" class="gensmall">> Forum Preferences</a></b></td></tr><td><tr>
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

		<td align="center" class="catsmall"><b>Edit Forum Preferences</b></td>

	</tr></table></caption>
</thead>
<tbody>
	<tr> 
	  <td class="row1"><span class="gen">{L_PUBLIC_VIEW_EMAIL}:</span></td>
	  <td class="row2"><table cellspacing="0" cellpadding="1">
	  <tr>	
		<td width="20"><span class="rbstyled"><input type="radio" name="viewemail" value="1" {VIEW_EMAIL_YES} /></span></td>
		<td><span class="gen">{L_YES}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
		<td width="20"><span class="rbstyled"><input type="radio" name="viewemail" value="0" {VIEW_EMAIL_NO} /></span></td>
		<td><span class="gen">{L_NO}</span></td>
	  </tr>
	  </table></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_HIDE_USER}:</span></td>
	  <td class="row2"><table cellspacing="0" cellpadding="1">
	  <tr>	
		<td width="20"><span class="rbstyled"><input type="radio" name="hideonline" value="1" {HIDE_USER_YES} /></span></td>
		<td><span class="gen">{L_YES}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
		<td width="20"><span class="rbstyled"><input type="radio" name="hideonline" value="0" {HIDE_USER_NO} /></span></td>
		<td><span class="gen">{L_NO}</span></td>
	  </tr>
	  </table></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_NOTIFY_ON_REPLY}:</span><br />
		<span class="gensmall">{L_NOTIFY_ON_REPLY_EXPLAIN}</span></td>
	  <td class="row2"><table cellspacing="0" cellpadding="1">
	  <tr>	
		<td width="20"><span class="rbstyled"><input type="radio" name="notifyreply" value="1" {NOTIFY_REPLY_YES} /></span></td>
		<td><span class="gen">{L_YES}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
		<td width="20"><span class="rbstyled"><input type="radio" name="notifyreply" value="0" {NOTIFY_REPLY_NO} /></span></td>
		<td><span class="gen">{L_NO}</span></td>
	  </tr>
	  </table></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_NOTIFY_ON_PRIVMSG}:</span></td>
	  <td class="row2"><table cellspacing="0" cellpadding="1">
	  <tr>	
		<td width="20"><span class="rbstyled"><input type="radio" name="notifypm" value="1" {NOTIFY_PM_YES} /></span></td>
		<td><span class="gen">{L_YES}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
		<td width="20"><span class="rbstyled"><input type="radio" name="notifypm" value="0" {NOTIFY_PM_NO} /></span></td>
		<td><span class="gen">{L_NO}</span></td>
	  </tr>
	  </table></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_ALWAYS_ADD_SIGNATURE}:</span></td>
	  <td class="row2"><table cellspacing="0" cellpadding="1">
	  <tr>	
		<td width="20"><span class="rbstyled"><input type="radio" name="attachsig" value="1" {ALWAYS_ADD_SIGNATURE_YES} /></span></td>
		<td><span class="gen">{L_YES}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
		<td width="20"><span class="rbstyled"><input type="radio" name="attachsig" value="0" {ALWAYS_ADD_SIGNATURE_NO} /></span></td>
		<td><span class="gen">{L_NO}</span></td>
	  </tr>
	  </table></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_BBCODE}:</span></td>
	  <td class="row2"><table cellspacing="0" cellpadding="1">
	  <tr>	
		<td width="20"><span class="rbstyled"><input type="radio" name="allowbbcode" value="1" {ALWAYS_ALLOW_BBCODE_YES} /></span></td>
		<td><span class="gen">{L_YES}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
		<td width="20"><span class="rbstyled"><input type="radio" name="allowbbcode" value="0" {ALWAYS_ALLOW_BBCODE_NO} /></span></td>
		<td><span class="gen">{L_NO}</span></td>
	  </tr>
	  </table></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_HTML}:</span></td>
	  <td class="row2"><table cellspacing="0" cellpadding="1">
	  <tr>	
		<td width="20"><span class="rbstyled"><input type="radio" name="allowhtml" value="1" {ALWAYS_ALLOW_HTML_YES} /></span></td>
		<td><span class="gen">{L_YES}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
		<td width="20"><span class="rbstyled"><input type="radio" name="allowhtml" value="0" {ALWAYS_ALLOW_HTML_NO} /></span></td>
		<td><span class="gen">{L_NO}</span></td>
	  </tr>
	  </table></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_SMILIES}:</span></td>
	  <td class="row2"><table cellspacing="0" cellpadding="1">
	  <tr>	
		<td width="20"><span class="rbstyled"><input type="radio" name="allowsmilies" value="1" {ALWAYS_ALLOW_SMILIES_YES} /></span></td>
		<td><span class="gen">{L_YES}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
		<td width="20"><span class="rbstyled"><input type="radio" name="allowsmilies" value="0" {ALWAYS_ALLOW_SMILIES_NO} /></span></td>
		<td><span class="gen">{L_NO}</span></td>
	  </tr>
	  </table></td>
	</tr>

	<tr> 
	  <td class="row1"><span class="gen">{L_TIMEZONE}:</span></td>
	  <td class="row2"><span class="gensmall">{TIMEZONE_SELECT}</span></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_DATE_FORMAT}:</span><br />
		<span class="gensmall">{L_DATE_FORMAT_EXPLAIN}</span></td>
	  <td class="row2"> 
		<input type="text" name="dateformat" value="{DATE_FORMAT}" maxlength="14" class="post" />
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


