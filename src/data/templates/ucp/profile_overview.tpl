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
                    <tr><td class="gensmall"><b>Front Page</b></td></tr>
                <tr><th><span class="gensmall"><b>Profile</th></tr>
                    <tr><td><b><a href="ucp.php?mode=editprofile" class="gensmall">Profile</a></b></td></tr>
                    <tr><td><b><a href="ucp.php?mode=editsig" class="gensmall">Signature</a></b></td></tr>
                    <tr><td><b><a href="ucp.php?mode=editavatar" class="gensmall">Avatar</a></b></td></tr>
                    <tr><td><b><a href="ucp.php?mode=editaccount" class="gensmall">Account Settings</a></b></td></tr>
                <tr><th><span class="gensmall"><b>Preferences</th></tr>
                    <tr><td><b><a href="ucp.php?mode=editprefs" class="gensmall">Forum Preferences</a></b></td></tr><td><tr>
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
<td valign=top>
{ERROR_BOX} 
{Begin_Shadow}
<table cellpadding="4" cellspacing="0" width="100%" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>

		<td align="center" class="forumheader-mid"><b>Front Page</b></td>

	</tr></table></caption>
</thead>
<tbody>
	<tr> 
		<td class="row1" width="100%" style="padding: 5px" align="center" colspan="2"><span style="font-size: 11px">Welcome to the Control Panel. From here you can monitor, view and update your profile and preferences.<br /></span><br /></td>
	</tr>
	</tr>
      <tr> 
	<th class="forum" width="50%">Account</th>
	<th class="forum" width=50%>Game</th>
  </tr>
   <tr> 
	<td class="row1" valign="top"><table width="100%" cellspacing="1" cellpadding="3">
		<tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">Joined:</span></td>
		  <td valign="middle"><b><span class="gen">{JOINED}</span></b></td>
		</tr>
		<tr> 
		  <td valign="top" nowrap="nowrap" align="right"><span class="gen">Total forum posts:</span></td>
		  <td valign="top"><b><span class="gen">{POSTS}</span></b><br /><span class="genmed">[{POST_PERCENT_STATS} / {POST_DAY_STATS}]</span> <br /><span class="genmed"><a href="{U_SEARCH_USER}" class="genmed">Find all posts by me</a></span></td>
		</tr>
		<tr>
		<td height="3"></td>
		</tr>
	  </table>

		<td class="row1" valign="top"><table width="100%" cellspacing="1" cellpadding="3">
        <!-- BEGIN switch_empire -->
       <tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">Empire:</span></td>
		  <td valign="middle"><b><span class="gen">{EMPIRE_NAME}</span></b></td>
		</tr>
       <tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">Empire Rank:</span></td>
		  <td valign="middle"><b><span class="gen">#{EMPIRE_RANK}</span></b></td>
		</tr>
        <!-- END switch_empire -->
        <!-- BEGIN switch_noempire -->
       <tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen"><I>You have no empire</I></span></td>
		</tr>       
        <!-- END switch_noempire -->
       <tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">Ruled:</span></td>
		  <td valign="middle"><b><span class="gen">{EMPIRES_RULED}</span></b></td>
		</tr>
               <tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">Abandoned:</span></td>
		  <td valign="middle"><b><span class="gen">{EMPIRES_ABANDONED}</span></b></td>
		</tr>
       <tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">Destroyed:</span></td>
		  <td valign="middle"><b><span class="gen">2</span></b></td>
		</tr>
       <tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen">Max Greatness:</span></td>
		  <td valign="middle"><b><span class="gen">{MAX_GREATNESS}</span></b></td>
		</tr>
        <tr> 
		  <td valign="bottom" nowrap="nowrap" align="right"><img src="data/images/spacer.gif" height=4px /></td>
		</tr>
        <tr> 
		  <td valign="bottom" nowrap="nowrap" align="right"><span class="gen">Player Rating:</span></td>
		  <td valign="bottom"><b><i><span style="font-size: 16px">{RATING}</span></b></td>
		</tr>
		</tr>
		</table>
	</td>
  </tr>
  		<tr>
		<td class="catBottom" colspan="2" align="center" height="28"></td>
	</tr>
</tbody>
</table>
{End_Shadow}
</form>
</td>
</tr>
</table>


