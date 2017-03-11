<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post">

{ERROR_BOX}

<table cellspacing="0" cellpadding="0" width=96% align="center" style="padding:0px;">
			<tr>
			<td align="center" rowspan=2 width=100%>
<table cellpadding="3" cellspacing="0" width="100%" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid">Register an Account</td>
	</tr></table></caption>
</thead>
<tbody>
<tr>
<td align=center class="rowinv" width="50%" style="padding-top:6px; padding-bottom:18px;padding-left:6px" colspan="2"><span class="gensmall">All fields of this form must be filled in. A confirmation email will be sent to your email address once you have registered.<br /><br /></span>
</td>
</tr>

	<tr> 
	<tr> 
		<td class="rowinv" width="50%" style="padding-top:24px; padding-bottom:24px;padding-left:6px">
<table border=0 cellspacing="0" cellpadding="0" width=100% style="padding-left: 15px">
<tr>
<td width=40% align=left>
<span class="gen"><b>Player Name </b></span>{U_ERROR}</td>
<td style="padding-left:15" align=left>
<table cellspacing="0" cellpadding="0" width="214" align=left>
<tr>
<td align=left>
<input type="text" class="{STYLE_PBORDER_U}" style="width:190px" name="username" size="25" maxlength="25" value="{USERNAME}" />
</td>
<td align=left>
{IMG_CROSS_U}
</td><tr></table>
</td>
</tr>
</table>
</td>
		<td class="rowinv" style="padding-left:6px">
<table border=0 cellspacing="0" cellpadding="0" width=100%>
<tr>
<td width=40% align=left>
<span class="gen"><b>{L_EMAIL_ADDRESS}</b></span>{E_ERROR}</td>
<td align=left>
<table cellspacing="0" cellpadding="0" width="214" align=left>
<tr>
<td align=left>
<input type="text" class="{STYLE_PBORDER_E}" style="width:190px" name="email" size="25" maxlength="255" value="{EMAIL}" />
</td>
<td align=left>
{IMG_CROSS_E}
</td><tr></table>
</td>
</td>
</tr>
</table>
</td>
	</tr>

	<tr> 
	  <td class="rowinv" width=50% style="padding-top:3px; padding-bottom:3px;padding-left:6px">
<table border=0 cellspacing="0" cellpadding="0" width=100% style="padding-left: 15px">
<tr>
<td width=40% align=left>
<span class="gen"><b>{L_NEW_PASSWORD} </b>{P_ERROR}</span></td>
<td style="padding-left:15">
<table cellspacing="0" cellpadding="0" width="184" align=left>
<tr>
<td align=left>
	<input type="password" class="{STYLE_PBORDER_P}" style="width: 160px" name="new_password" size="25" maxlength="16" value="{NEW_PASSWORD}"/>
</td>
<td align=left>
{IMG_CROSS_P}
</td><tr></table>

</td>
</tr>
<tr height=12>
<tr>
<td width=40% align=left>
<span class="gen"><b>{L_CONFIRM_PASSWORD} </b></span></td>
<td style="padding-left:15">
<table cellspacing="0" cellpadding="0" width="184" align=left>
<tr>
<td align=left>
<input type="password" class="{STYLE_PBORDER_P}" style="width: 160px" name="password_confirm" size="25" maxlength="16" value="{PASSWORD_CONFIRM}" />
</td>
<td align=left>
{IMG_CROSS_P}
</td><tr></table>
</td>
</tr>
</table>
	  </td>
		<td class="rowinv" align="center"><br />{CONFIRM_IMG}<br /><span class="gensmall"></span><br /></td>
	</tr>
	<!-- Visual Confirmation -->
	<!-- BEGIN switch_confirm -->
	<tr> 
	  <td class="rowinv" colspan="1" style="padding-top:30px; padding-bottom:36px;padding-left:20px"><span class="gensmall">{L_CONFIRM_CODE_EXPLAIN}</span></td>
<td class="rowinv" style="padding-left:6px">
<table border=0 cellspacing="0" cellpadding="0" width=100% >
<tr>
<td width=40% align=left style="padding-bottom:26px">
<span class="gen"><b>{L_CONFIRM_CODE}</b></span>
<td>
<table cellspacing="0" cellpadding="0" width="184" align=left style="padding-bottom:26px">
<tr>
<td align=left>
<input type="text" class="{STYLE_PBORDER_C}" style="width: 160px" name="confirm_code" size="6" maxlength="6" value=""/>
</td>
<td align=left>
{IMG_CROSS_C}
</td><tr></table>
</td></tr></table></td>
	</tr>
	<!-- END switch_confirm -->
	<tr> 
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="Create Account" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr>
</tbody>
</table>
{End_Shadow}
</form>

