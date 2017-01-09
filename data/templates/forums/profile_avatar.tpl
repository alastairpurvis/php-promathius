
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
				<tr><td class="highlight"><b><a href="ucp.php?mode=editavatar" class="gensmall">> Avatar</a></b></td></tr>
				<tr><td><b><a href="ucp.php?mode=editaccount" class="gensmall">> Account Settings</a></b></td></tr>
						<tr><td><span class="gensmall"><b>Preferences</td></tr>
				<tr><td><b><a href="ucp.php?mode=editprefs" class="gensmall">> Forum Preferences</a></b></td></tr><td><tr>
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

		<td align="center" class="catsmall"><b>Edit Avatar</b></td>

	</tr></table></caption>
</thead>
<tbody>
	<!-- BEGIN switch_avatar_block -->
		<td class="row1" colspan="2"><table width="70%" cellspacing="2" cellpadding="0" align="center">
			<tr> 
				<td width="65%"><span class="gensmall">{L_AVATAR_EXPLAIN}</span></td>
				<td align="center"><span class="gensmall">{L_CURRENT_IMAGE}</span><br />
					<div style="padding: 2px;">{AVATAR}</div>
					<table cellspacing="0" cellpadding="0"><tr>
						<td width="20"><span class="cbstyled"><input type="checkbox" name="avatardel" /></span></td>
						<td><span class="gensmall">{L_DELETE_AVATAR}</span></td>
					</tr>
					</table></td>
			</tr>
		</table></td>
	</tr>
	<!-- BEGIN switch_avatar_local_upload -->
	<tr> 
		<td class="row1"><span class="gen">{L_UPLOAD_AVATAR_FILE}:</span></td>
		<td class="row2"><input type="hidden" name="MAX_FILE_SIZE" value="{AVATAR_SIZE}" /><input type="file" name="avatar" class="post" style="width:200px" /></td>
	</tr>
	<!-- END switch_avatar_local_upload -->
	<!-- BEGIN switch_avatar_remote_upload -->
	<tr> 
		<td class="row1"><span class="gen">{L_UPLOAD_AVATAR_URL}:</span><br /><span class="gensmall">{L_UPLOAD_AVATAR_URL_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="avatarurl" size="40" class="post" style="width:200px" /></td>
	</tr>
	<!-- END switch_avatar_remote_upload -->
	<!-- BEGIN switch_avatar_remote_link -->
	<tr> 
		<td class="row1"><span class="gen">{L_LINK_REMOTE_AVATAR}:</span><br /><span class="gensmall">{L_LINK_REMOTE_AVATAR_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="avatarremoteurl" value="{URL}" size="40" class="post" style="width:200px" /></td>
	</tr>
	<!-- END switch_avatar_remote_link -->
	<!-- BEGIN switch_avatar_local_gallery -->
	<tr> 
		<td class="row1"><span class="gen">{L_AVATAR_GALLERY}:</span></td>
		<td class="row2"><input type="submit" name="avatargallery" value="{L_SHOW_GALLERY}" class="liteoption" /></td>
	</tr>
	<!-- END switch_avatar_local_gallery -->
	<!-- END switch_avatar_block -->
		<tr>
		<td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr></tbody>
</table>

</form>
</td>
</tr>
</table>


