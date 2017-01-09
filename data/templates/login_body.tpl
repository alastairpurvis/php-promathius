<br />
<form action="{S_LOGIN_ACTION}" method="post" target="_top">

<table width="100%" cellspacing="5" cellpadding="5" align="center">
  <tr><td>&nbsp;</td>
  </tr>
</table>

<table cellspacing="0" cellpadding="0" width=80% align="center">
			<tr>
			<td align="center" rowspan=2 width=100%>
<table width=100%" cellpadding="0" cellspacing="0" class="forumline" align="center">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid">Log in to PROMATHIUS</td>
	</tr></table></caption>
</thead>
<tbody>
  <tr> 
<td width=50%>
<table cellpadding="3" cellspacing="1" width="100%">
<tr>
<td width=25%>&nbsp;
</td>
	<td><table cellpadding="2" cellspacing="1" width="100%">
		  <tr> 
			<td colspan="2" align="center">&nbsp;</td>
		  </tr>
		  <tr> 
			<td width="30%" align="left" valign="top"><span class="gensmall"><b>{L_USERNAME}</b></span></td>
			<td> 
			  <input type="text" class="post" name="username" size="25" maxlength="40" value="{USERNAME}" tabindex="1"/><br />
			<span class="gensmall"><a href="register.php?mode=register" class="gentiny">Register</a></span></td>
		  </tr>
		  <tr> 
			<td align="left" valign=top><span class="gensmall"><b>{L_PASSWORD}<b></span></td>
			<td> 
			  <input type="password" class="post" name="password" size="25" maxlength="32" tabindex="2"/><br />
			<span class="gensmall"><a href="{U_SEND_PASSWORD}" class="gentiny">{L_SEND_PASSWORD}</a></span></td>
		  
		  </tr>
		<!-- BEGIN switch_allow_autologin -->
		  <tr>
			<td colspan="2"><table cellspacing="0" cellpadding="0"><tr><td>
<td><span class="cbstyled"><input type="checkbox" name="autologin" tabindex="3"/></td><td><span class="gensmall">&nbsp;Remember me&nbsp;</span></td></tr></table></td>
		  </tr>
		<!-- END switch_allow_autologin -->
				  <tr> 
			<td colspan="2" align="center">&nbsp;</td>
		  </tr>

		</table></td>
	<tr>
		<td colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="login" tabindex="4" class="mainoption" value="{L_LOGIN}"/></td>
	</tr>
  </tr>
 </tbody>
</table>
</form>


</table>
{End_Shadow}
<table width="100%" cellspacing="22" cellpadding="22" align="center">
  <tr><td>&nbsp;</td>
  </tr>
</table>