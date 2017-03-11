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
                    <tr><td><b><a href="ucp.php?mode=editaccount" class="gensmall">Account Settings</a></b></td></tr>
                <tr><th><span class="gensmall"><b>Preferences</th></tr>
                    <tr><td class="gensmall"><b>Forum Preferences</b></td></tr><td><tr>
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

		<td align="center" class="forumheader-mid"><b>Edit Forum Preferences</b></td>

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
	  <td class="row1"><span class="gen">Show my current empire on posts:</span></td>
	  <td class="row2"><table cellspacing="0" cellpadding="1">
	  <tr>	
		<td width="20"><span class="rbstyled"><input type="radio" name="showempire" value="1" {ALWAYS_SHOWEMPIRE_YES} /></span></td>
		<td><span class="gen">{L_YES}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
		<td width="20"><span class="rbstyled"><input type="radio" name="showempire" value="0" {ALWAYS_SHOWEMPIRE_NO} /></span></td>
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
	  <td class="row1"><span class="gen">Notify me of replies</span><br />
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
	  <td class="row1"><span class="gen">Attach my signature by default:</span></td>
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
	  <td class="row1"><span class="gen">Allow BBCode:</span></td>
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
	  <td class="row1"><span class="gen">Enable Smilies:</span></td>
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
		<td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr>
</tbody>
</table>
{End_Shadow}
</form>
</td>
</tr>
</table>


