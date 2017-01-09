<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	{* Tell IE8 render like IE7 *}
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
	{* Do not allow users without JS
	<noscript> 
		<meta http-equiv="refresh" content="0; URL=http://mydomain.com/nextlevel.php" /> 
	</noscript> *}
	{literal}<style type="text/css">
			html, body {
				-moz-user-select: none;
				-khtml-user-select: none;
				cursor: default;
			}
	</style>{/literal}
    <link rel="stylesheet" type="text/css" href="{$styles}">
    <title>Promathius | Govern</title>
    <base href="{$basehref}">
    <script type="text/javascript" src="{$scripts}"></script>
    <link rel="icon" href="data/images/navicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="data/images/navicon.ico" type="image/x-icon">
</head>

<body onLoad="loadScripts()" onbeforeunload="prepareExit()" {literal}onUnload="unloadScripts()"{/literal}>
<table cellspacing="0" cellpadding="0" id="maintable" align="center" onselectstart="return false">
<td style="vertical-align:top">
    <table align="center" width="100%" cellspacing="0" cellpadding="0" id="buttonstable">

      	{* Left Header Links *}
        <td valign="middle" id="header-buttons" style="text-align:left">&nbsp;&nbsp;&nbsp;
        <a href="?logout">Log out [ {$username} ]</a>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp;&nbsp;
        <a href="privmsg.php">{$pm_status}</a>
        
        {* Right Header Links *}
        <td align="right" valign="middle" id="header-buttons">
        <a href="?scores" >Rankings</a>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp;&nbsp;
        <a href="?guide" >Help</a>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp;&nbsp;
        <a href="forum" >Forum</a>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp;&nbsp;
        <a href="ucp.php">Control Panel</a>&nbsp;</td>

    </table>
	  	<div class="logotable"></div>