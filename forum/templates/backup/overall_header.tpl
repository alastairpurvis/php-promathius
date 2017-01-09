<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
	<meta http-equiv="Content-Style-Type" content="text/css">
	{META}
	<!-- BEGIN switch_in_forum -->
	{NAV_LINKS}
	
	<!-- END switch_in_forum -->
	<title>{SITENAME} - {PAGE_TITLE}</title>
	<link rel="stylesheet" href="{PATH}../data/stylesheet.css" type="text/css">
	<link rel="icon" href="{PATH}../images/favicon.ico" />
	<script language="javascript" type="text/javascript" src="{PATH}scripts/scripts.js"></script>
	<script language="javascript" type="text/javascript" src="{PATH}scripts/formStyle.js"></script>
	<!-- BEGIN switch_image_preload -->
	{hover}
	<!-- END switch_image_preload -->
	<!-- BEGIN switch_enable_pm_popup -->
	<script language="Javascript" type="text/javascript">
	<!--
		if ( {PRIVATE_MESSAGE_NEW_FLAG} )
		{
		/*	window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400'); */
		}
	//-->
	</script>
	<!-- END switch_enable_pm_popup -->
</head>
<body>
	<table align="center" cellspacing="0" cellpadding="0" height=100% id="maintable">
		<tr>
			<td valign="top" class="content-row">
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td align="center" height="88" class="logotable"><a name="top"></a><img id="formStyleTestImage" alt="" src="{PATH}../data/images/forums/spacer.gif" width="0" height="0" /></td>
					</tr>
				</table>

		<table width="100%" cellspacing="0" cellpadding="0" id="buttonstable">
			<tr>
				<td valign="middle" id="header-buttons" style="text-align:left">
					&nbsp;&nbsp;&nbsp;<a href="{PATH}{U_LOGIN_LOGOUT}">{L_LOGIN_LOGOUT}</a>&nbsp&nbsp &bull; &nbsp
					<!-- BEGIN switch_user_logged_in -->
					<a href="{ROOT}{U_PRIVATEMSGS}">{PM_STATUS}</a>
					<!-- END switch_user_logged_in -->
					<!-- BEGIN switch_user_logged_out --> 
					<a href="{ROOT}{U_REGISTER}">Register</a>
					<!-- END switch_user_logged_out --> 
				</td>
				<td align="right" valign="middle" id="header-buttons">
					<!-- BEGIN switch_enable_emplink -->
					{EMPIRE_LINK}
					&nbsp &bull; &nbsp
					<!-- END switch_enable_emplink -->
					<!-- BEGIN switch_admin -->
					<a href="{PATH}{U_ADMIN_CP}">Admin CP</a>&nbsp &bull; &nbsp
					<!-- END switch_admin -->
					<!-- BEGIN switch_in_forum -->
					<a href="{PATH}{U_SEARCH}">{L_SEARCH}</a>
					<!-- END switch_in_forum -->
					<!-- BEGIN switch_user_logged_in_forum -->
					&nbsp &bull; &nbsp<a href="{PATH}{U_MEMBERLIST}">{L_MEMBERLIST}</a>
					<!-- END switch_user_logged_in_forum -->
					<!-- BEGIN switch_not_in_forum -->
					<a href="{PATH}index.php">Forum</a>
					<!-- END switch_not_in_forum -->
					<!-- BEGIN switch_user_logged_in -->
						&nbsp &bull; &nbsp 
					<!-- END switch_user_logged_in -->
					<!-- BEGIN switch_user_logged_in_forum -->
					<!-- END switch_user_logged_in_forum -->
					<!-- BEGIN switch_user_logged_in -->
					<a href="{U_PROFILE}">Control Panel</a>&nbsp;
					<!-- END switch_user_logged_in --> 
					<!-- BEGIN switch_user_logged_out --> 
					&nbsp;
					<!-- END switch_user_logged_out --> 
				</td>
			</tr>
		</table>
<table cellspacing="0" cellpadding="0" width=100%>
<tr>
<td style="text-align:left; vertical-align:top" class="shadow-bottom" height=8>
</td></tr>
</table>
		
		<table width="100%" cellspacing="0" cellpadding="0" class="content">
			<tr>
				<td class="content" valign="top">
