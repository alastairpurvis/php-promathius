<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
	<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
	<meta http-equiv="Content-Style-Type" content="text/css">
	{META}
	<!-- BEGIN switch_in_forum -->
	{NAV_LINKS}
	
	<!-- END switch_in_forum -->
	<title>{SITENAME} | {PAGE_TITLE}</title>
	<link rel="stylesheet" href="{STYLES}" type="text/css">
    <link rel="icon" href="{PATH}../data/images/navicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="{PATH}../data/images/navicon.ico" type="image/x-icon">
	<script language="javascript" type="text/javascript" src="{PATH}scripts/scripts.js"></script>
	<script language="javascript" type="text/javascript" src="{PATH}scripts/formStyle.js"></script>
	<!-- BEGIN switch_image_preload -->
	{hover}
	<!-- END switch_image_preload -->
</head>
<body>
<table cellspacing="0" cellpadding="0" id="maintable" align="center" onselectstart="return false">
<td style="vertical-align:top">
		<table align="center" width="100%" cellspacing="0" cellpadding="0" id="buttonstable">
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
  	<div class="logotable"></div>
		
		<table width="984px" align="center" cellspacing="0" cellpadding="0" class="content">
			<tr>
				<td valign="top">
