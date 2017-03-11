<?php /* Smarty version 2.6.0, created on 2009-07-17 14:29:16
         compiled from header.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
		<?php echo '<style type="text/css">
			html, body {
				-moz-user-select: none;
				-khtml-user-select: none;
				cursor: default;
			}
	</style>'; ?>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['styles']; ?>
">
    <title>Promathius | Govern</title>
    <base href="<?php echo $this->_tpl_vars['basehref']; ?>
">
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['scripts']; ?>
"></script>
    <link rel="icon" href="data/images/navicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="data/images/navicon.ico" type="image/x-icon">
</head>

<body onLoad="loadScripts()" onbeforeunload="prepareExit()" <?php echo 'onUnload="unloadScripts()"'; ?>
>
<table cellspacing="0" cellpadding="0" id="maintable" align="center" onselectstart="return false">
<td style="vertical-align:top">
    <table align="center" width="100%" cellspacing="0" cellpadding="0" id="buttonstable">

      	        <td valign="middle" id="header-buttons" style="text-align:left">&nbsp;&nbsp;&nbsp;
        <a href="?logout">Log out [ <?php echo $this->_tpl_vars['username']; ?>
 ]</a>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp;&nbsp;
        <a href="privmsg.php"><?php echo $this->_tpl_vars['pm_status']; ?>
</a>
        
                <td align="right" valign="middle" id="header-buttons">
        <a href="?scores" >Rankings</a>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp;&nbsp;
        <a href="?guide" >Help</a>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp;&nbsp;
        <a href="forum" >Forum</a>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp;&nbsp;
        <a href="ucp.php">Control Panel</a>&nbsp;</td>

    </table>
	  	<div class="logotable"></div>