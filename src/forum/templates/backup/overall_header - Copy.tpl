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
	<link rel="stylesheet" href="{PATH}templates/prom/{T_HEAD_STYLESHEET}" type="text/css">
	<link rel="icon" href="{PATH}../data/images/forums/favicon.ico" />
	<script language="javascript" type="text/javascript" src="{PATH}scripts/scripts.js"></script>
	<script language="javascript" type="text/javascript" src="{PATH}scripts/formStyle.js"></script>
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
	<!-- BEGIN switch_image_preload -->
<script type="text/javascript">

<!-- // 

//check if browser is capable, NS3+, IE4+ 

if (document.images) { 

//preload images 

//base image 

img1N= new Image(62,57); 

img1N.src= 'images/symbols/athens.gif' ; 

//hover or rollover image 

img1H= new Image(62,57); 

img1H.src= 'images/symbols/hover/athens.gif' ; 

img2N= new Image(62,57); 

img2N.src= 'images/symbols/corinth.gif' ; 

//hover or rollover image 

img2H= new Image(62,57); 

img2H.src= 'images/symbols/hover/corinth.gif' ; 

img3N= new Image(62,57); 

img3N.src= 'images/symbols/sparta.gif' ; 

//hover or rollover image 

img3H= new Image(62,57); 

img3H.src= 'images/symbols/hover/sparta.gif' ; 

img4N= new Image(62,57); 

img4N.src= 'images/symbols/thebes.gif' ; 

//hover or rollover image 

img4H= new Image(62,57); 

img4H.src= 'images/symbols/hover/thebes.gif' ; 

img5N= new Image(62,57); 

img5N.src= 'images/symbols/epirus.gif' ; 

//hover or rollover image 

img5H= new Image(62,57); 

img5H.src= 'images/symbols/hover/epirus.gif' ; 

img6N= new Image(62,57); 

img6N.src= 'images/symbols/illyria.gif' ; 

//hover or rollover image 

img6H= new Image(62,57); 

img6H.src= 'images/symbols/hover/illyria.gif' ; 

img7N= new Image(62,57); 

img7N.src= 'images/symbols/macedon.gif' ; 

//hover or rollover image 

img7H= new Image(62,57); 

img7H.src= 'images/symbols/hover/macedon.gif' ; 

img8N= new Image(62,57); 

img8N.src= 'images/symbols/thrace.gif' ; 

//hover or rollover image 

img8H= new Image(62,57); 

img8H.src= 'images/symbols/hover/thrace.gif' ; 

img9N= new Image(62,57); 

img9N.src= 'images/symbols/armenia.gif' ; 

//hover or rollover image 

img9H= new Image(62,57); 

img9H.src= 'images/symbols/hover/armenia.gif' ; 

img10N= new Image(62,57); 

img10N.src= 'images/symbols/egypt.gif' ; 

//hover or rollover image 

img10H= new Image(62,57); 

img10H.src= 'images/symbols/hover/egypt.gif' ; 

img11N= new Image(62,57); 

img11N.src= 'images/symbols/persia.gif' ; 

//hover or rollover image 

img11H= new Image(62,57); 

img11H.src= 'images/symbols/hover/persia.gif' ; 

img12N= new Image(62,57); 

img12N.src= 'images/symbols/pontus.gif' ; 

//hover or rollover image 

img12H= new Image(62,57); 

img12H.src= 'images/symbols/hover/pontus.gif' ; 

function myOn(myImgName) { 

//we need to name the image in the BODY 

//so we can use its name here 

document[myImgName].src=eval(myImgName+ 'H' ).src; 

} 

function myOut(myImgName) { 

document[myImgName].src=eval(myImgName+ 'N' ).src; 

} 

} //end of if document.images 

//-->

</script>
	<!-- END switch_image_preload -->
</head>
<body>
	<a name="top"></a><img id="formStyleTestImage" alt="" src="{PATH}../data/images/forums/spacer.gif" />
	<table align="center" width="775" cellspacing="0" cellpadding="0" id="maintable">
		<tr>
			<td valign="top" class="content-row">
				<table width="775" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center" width="775" height="88" class="logotable"></td>
					</tr>
				</table>

		<table width="775" cellspacing="0" cellpadding="0" id="buttonstable">
			<tr>
				<td align="left" valign="middle" id="header-buttons">
					&nbsp;&nbsp;&nbsp;<a href="{PATH}{U_LOGIN_LOGOUT}">{L_LOGIN_LOGOUT}</a>&nbsp&nbsp &bull; &nbsp
					<!-- BEGIN switch_user_logged_in -->
					<a href="{ROOT}{U_PRIVATEMSGS}">{PM_STATUS}</a>
					<!-- END switch_user_logged_in -->
					<!-- BEGIN switch_user_logged_out --> 
					<a href="{ROOT}{U_REGISTER}">Register</a>
					<!-- END switch_user_logged_out --> 
				</td>
				<td align="right" valign="middle" id="header-buttons">
					<!-- BEGIN switch_new_empire -->
					<a href="{PATH}../game.php">Establish Empire</a>
					<!-- END switch_new_empire --> 
					<!-- BEGIN switch_return_empire -->
					<a href="{PATH}../game.php">Return to Empire</a>
					<!-- END switch_return_empire --> 
					<!-- BEGIN switch_user_logged_in -->
					&nbsp &bull; &nbsp
					<!-- END switch_user_logged_in -->
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
					<a href="{U_PROFILE}">Control Panel</a>&nbsp;&nbsp;&nbsp;
					<!-- END switch_user_logged_in --> 
					<!-- BEGIN switch_user_logged_out --> 
					&nbsp;&nbsp;&nbsp;
					<!-- END switch_user_logged_out --> 
				</td>
			</tr>
		</table>
		
		<table width="775" cellspacing="0" cellpadding="0" class="content">
			<tr>
				<td class="content" valign="top">
