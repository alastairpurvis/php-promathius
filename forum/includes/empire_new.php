<?php
/***************************************************************************
*                            usercp_register.php
*                            -------------------
*   begin                : Saturday, Feb 13, 2001
*   copyright            : (C) 2001 The phpBB Group
*   email                : support@phpbb.com
*
*   $Id: usercp_register.php,v 1.20.2.78 2006/12/17 10:51:27 acydburn Exp $
*
*
***************************************************************************/

/***************************************************************************
*
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version.
*
*
***************************************************************************/

/*

This code has been modified from its original form by psoTFX @ phpbb.com
Changes introduce the back-ported phpBB 2.2 visual confirmation code. 

NOTE: Anyone using the modified code contained within this script MUST include
a relevant message such as this in usercp_register.php ... failure to do so 
will affect a breach of Section 2a of the GPL and our copyright

png visual confirmation system : (c) phpBB Group, 2003 : All Rights Reserved

*/

if (!defined('IN_PHPBB'))
{
    die ("Hacking attempt");
    exit;
}


function sqlsafeeval($query)
{
	return sqleval($query);/* SAFE -- root call */
}
function sqleval($query)
{/* SAFE -- root declaration */
	/* Safe because it's up to the caller to do proper checking */
	$data = @mysql_fetch_array(mysql_safe_query($query));
	return $data[0];
}


$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
$unhtml_specialchars_replace = array('>', '<', '"', '&');

// ---------------------------------------
// Load agreement template since user has not yet
// agreed to registration conditions/coppa
//
function show_coppa()
{
    global $userdata, $template, $lang, $phpbb_root_path, $phpEx;

    $template->set_filenames(array('body' =>
        '../../../data/templates/introduction.tpl'));

    $template->assign_vars(array('REGISTRATION' => $lang['Registration'],
        'AGREEMENT' => $lang['Reg_agreement'], "AGREE_OVER_13" => $lang['Agree_over_13'],
        "AGREE_UNDER_13" => $lang['Agree_under_13'], 'DO_NOT_AGREE' => $lang[
        'Agree_not'], "U_AGREE_OVER13" => append_sid("create_empire.$phpEx?mode=newplayer&amp;agreed=true"),
        "U_AGREE_UNDER13" => append_sid("register.$phpEx?mode=newplayer&amp;agreed=true&amp;coppa=true")));

    $template->pparse('body');

}
//
// ---------------------------------------
// Check to see if it has been at least 24 hours if they abandoned their previous empire
$disable_new = sqlsafeeval("SELECT disable_new FROM " . USERS_TABLE . " WHERE user_id=$userdata[empire_id]");

if($userdata[disable_new] == 1)
{
            message_die_ext(GENERAL_ERROR, 'Sorry, but you must wait at least ' . $config['abandon_delay'] . ' hours before you can create a new empire.');
}
	$template->assign_vars(array('DefaultFactionID' => $config['defaultfaction'], 'DefaultFaction' => strtolower($config['er'][100 + $config['defaultfaction']]['rname'])));
	
	for($ri=1; $ri <= $config['races']; $ri++)
	{
		$faction_id = "faction".$ri;
		$faction_idlow = "factlow".$ri;
		$faction_name = $config['er'][100 + $ri]['rname'];
		$faction_unlock = $config['er'][100 + $ri]['unlock'];
		$faction_namelow = strtolower($faction_name);
		
		if(($userdata['empires_owned'] - $userdata['empires_abandoned'] - $userdata['empires_destroyed']) >= $faction_unlock)
		{
			$viewable++;
			if(is_file("data/images/symbols/".$faction_namelow.".gif"))
				$image = $faction_namelow;
			else
				$image = "unknown";
			if($viewable <= 30) // Limit to 30 to prevent overflow
			{
				$hover_java .= "
				img".$ri."N= new Image(); 
				img".$ri."N.src= 'data/images/symbols/".$image.".png' ; 
				img".$ri."D= new Image(); 
				img".$ri."D.src= 'data/images/symbols/down/".$image.".png' ; 
				img".$ri."H= new Image(); 
				img".$ri."H.src= 'data/images/symbols/hover/".$image.".png';";
				$strippeddescr = preg_replace("/\n|\r\n|\r$/", "", $config['er'][100 + $ri]['factiondescriptions'][$ri]);
				$strippeddescr = ereg_replace('"', "'", $strippeddescr);
				$template->assign_block_vars('factionrow', array(
					'IMAGE' => $image,
					'NAME'	=>	$faction_name,
					'NAME_LOW' => $faction_namelow, 
					'DESCRIPTION' => $strippeddescr,
					'ID'	=>	$ri)
				);
			}
			$faction_region[$faction_id] = $config['er'][100 + $ri]['regions'];
			$template->assign_block_vars('DefaultRegion', array('ID' => $ri,'TAG' => $config['er'][100 + $ri]['regiontags'][0]));
				// For each faction
				$template->assign_block_vars(
						'factionregion', array('ID' => $ri, 'NAME' => $faction_name, '', 'IMAGE' => $image, 'DESCRIPTION' => $config['er'][100 + $ri]['regionselectdescription']));
				// For each region
			for ($rid = 0; $rid <= count($config['er'][100 + $ri]['regions']); $rid++)
			{
				$strippedrdescr = preg_replace("/\n|\r\n|\r$/", "", $config['er'][100 + $ri]['regiondescriptions'][$rid]);
				$strippedrdescr = ereg_replace('"', "'", $strippedrdescr);
				$template->assign_block_vars(
						'factionregion.regionrow', array('NAME' => $config['er'][100 + $ri]['regions'][$rid], 'TAG' => $config['er'][100 + $ri]['regiontags'][$rid], 'DESCRIPTION' => $strippedrdescr));
			}
			$template->assign_vars(array($faction_id => $faction_name, $faction_idlow => $faction_namelow));
		}
		else
			$unlockable++;
	}
	$first_java = "<script language='Javascript' type='text/javascript'>
	<!-- // 
	if (document.images) {";
		$last_java = "
		
		function iconDown(myImgName) { 
			document[myImgName].src=eval(myImgName+ 'D' ).src; 
		} 
		function iconOn(myImgName) { 
			document[myImgName].src=eval(myImgName+ 'H' ).src; 
		} 
		function iconOut(myImgName) { 
			document[myImgName].src=eval(myImgName+ 'N' ).src; 
		} 
		function changeFaction(id, faction){
			var description = document.getElementById(faction).value;
			var descrdiv = 'factiondescription';
			document.getElementById(descrdiv).innerHTML = description;
			document.getElementById('selectedfaction').value = id;
		}
		function goBacktoFaction(){
			var selectedfaction = document.getElementById('selectedfaction').value;
			var descrdiv1 = selectedfaction+'_regiondescription';
			document.getElementById(selectedfaction+'_main').style.display = 'none';
			document.getElementById('proceedtoregion').style.display = '';
			document.getElementById('goback').style.display = 'none';
			document.getElementById('empirename').style.display = 'none';
			document.getElementById('submit').style.display = 'none';
			document.getElementById('sregion').style.display = 'none';
			document.getElementById('factionmain').style.display = '';
		}
		function gotoRegionSelector(){
			var selectedfaction = document.getElementById('selectedfaction').value;
			var descrdiv1 = selectedfaction+'_regiondescription';
			document.getElementById(selectedfaction+'_main').style.display = '';
			document.getElementById('proceedtoregion').style.display = 'none';
			document.getElementById('goback').style.display = '';
			document.getElementById('empirename').style.display = '';
			document.getElementById('submit').style.display = '';
			changeRegion(document.getElementById('DefaultRegion_'+selectedfaction).value, selectedfaction);
			document.getElementById('sregion').style.display = '';
			document.getElementById('factionmain').style.display = 'none';
		}
		function changeRegion(rtag, factionregion){
			var description = document.getElementById(rtag).value;
			var descrdiv = factionregion+'_regiondescription';
			document.getElementById(descrdiv).innerHTML = description;
			document.getElementById('selectedregion').value = rtag;
		}
	} 
	//-->
	</script>";
	$hover_final = $first_java . $hover_java . $last_java;
	$template->assign_vars(array(
        	'factions' => $config['races'],'hover' => $hover_final ));
	if($unlockable > 0)
	$template->assign_vars(array('faction_unlockable_filler' => '<td width=30%>&nbsp;</td>', 'faction_unlockables'=> '<td width=30% align=right><span style="font-size:11px"><b>' . $unlockable.' Unlockable</b>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>'));

$error = false;
$error_msg = '';
$page_title = "Establish Settlement";
if ($mode == 'newplayer' && !isset($HTTP_POST_VARS['agreed']) && !isset($HTTP_GET_VARS
    ['agreed']))
{
    include ($phpbb_root_path . 'includes/page_header_ext.' . $phpEx);

    show_coppa();

    include ($phpbb_root_path . 'includes/page_tail.' . $phpEx);
}

$coppa = (empty($HTTP_POST_VARS['coppa']) && empty($HTTP_GET_VARS['coppa'])) ? 0 : true;

//
// Check and initialize some variables if needed
//
if (isset($HTTP_POST_VARS['submit']) || isset($HTTP_POST_VARS['avatargallery']) ||
    isset($HTTP_POST_VARS['submitavatar']) || isset($HTTP_POST_VARS['cancelavatar']) ||
    $mode == 'newplayer')
{
	
    include ($phpbb_root_path . 'includes/functions_validate.' . $phpEx);
    include ($phpbb_root_path . 'includes/bbcode.' . $phpEx);
    include ($phpbb_root_path . 'includes/functions_post.' . $phpEx);
    
    $template->assign_vars(array('STYLE_PBORDER_EM' => 'post', 'IMG_CROSS_EM' => '',
        'STYLE_PBORDER_CH' => 'post', 'IMG_CROSS_CH' => ''));
    $template->assign_block_vars('switch_image_preload', array());

    if ($mode == 'editprofile')
    {
        $user_id = intval($HTTP_POST_VARS['user_id']);
        $current_email = trim(htmlspecialchars($HTTP_POST_VARS['current_email']));
    }

    $strip_var_list = array('email' => 'email', 'icq' => 'icq', 'aim' => 'aim',
        'msn' => 'msn', 'yim' => 'yim', 'website' => 'website', 'location' => 'location',
        'occupation' => 'occupation', 'interests' => 'interests', 'confirm_code' =>
        'confirm_code', 'selectedfaction' => 'selectedfaction', 'selectedregion' => 'selectedregion');

    // Strip all tags from data ... may p**s some people off, bah, strip_tags is
    // doing the job but can still break HTML output ... have no choice, have
    // to use htmlspecialchars ... be prepared to be moaned at.
    while (list($var, $param) = @each($strip_var_list))
    {
        if (!empty($HTTP_POST_VARS[$param]))
        {
            $$var = trim(htmlspecialchars($HTTP_POST_VARS[$param]));
        }
    }

    $username = (!empty($HTTP_POST_VARS['username'])) ? phpbb_clean_username($HTTP_POST_VARS
        ['username']) : '';


    $trim_var_list = array('cur_password' => 'cur_password', 'new_password' =>
        'new_password', 'password_confirm' => 'password_confirm', 'signature' =>
        'signature');

    while (list($var, $param) = @each($trim_var_list))
    {
        if (!empty($HTTP_POST_VARS[$param]))
        {
            $$var = trim($HTTP_POST_VARS[$param]);
        }
    }

    $signature = (isset($signature)) ? str_replace('<br />', "\n", $signature) : '';
    $signature_bbcode_uid = '';

    // Run some validation on the optional fields. These are pass-by-ref, so they'll be changed to
    // empty strings if they fail.
    validate_optional_fields($icq, $aim, $msn, $yim, $website, $location, $occupation,
        $interests, $signature);

    $viewemail = (isset($HTTP_POST_VARS['viewemail'])) ? (($HTTP_POST_VARS[
        'viewemail']) ? true : 0) : 0;
    $allowviewonline = (isset($HTTP_POST_VARS['hideonline'])) ? (($HTTP_POST_VARS[
        'hideonline']) ? 0 : true) : true;
    $notifyreply = (isset($HTTP_POST_VARS['notifyreply'])) ? (($HTTP_POST_VARS[
        'notifyreply']) ? true : 0) : 0;
    $notifypm = (isset($HTTP_POST_VARS['notifypm'])) ? (($HTTP_POST_VARS['notifypm']) ? true :
        0) : true;
    $popup_pm = (isset($HTTP_POST_VARS['popup_pm'])) ? (($HTTP_POST_VARS['popup_pm']) ? true :
        0) : true;
    $sid = (isset($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : 0;

    if ($mode == 'newplayer')
    {
        $attachsig = (isset($HTTP_POST_VARS['attachsig'])) ? (($HTTP_POST_VARS[
            'attachsig']) ? true : 0) : $board_config['allow_sig'];

        $allowhtml = (isset($HTTP_POST_VARS['allowhtml'])) ? (($HTTP_POST_VARS[
            'allowhtml']) ? true : 0) : $board_config['allow_html'];
        $allowbbcode = (isset($HTTP_POST_VARS['allowbbcode'])) ? (($HTTP_POST_VARS[
            'allowbbcode']) ? true : 0) : $board_config['allow_bbcode'];
        $allowsmilies = (isset($HTTP_POST_VARS['allowsmilies'])) ? (($HTTP_POST_VARS[
            'allowsmilies']) ? true : 0) : $board_config['allow_smilies'];
    }
    else
    {
        $attachsig = (isset($HTTP_POST_VARS['attachsig'])) ? (($HTTP_POST_VARS[
            'attachsig']) ? true : 0) : $userdata['user_attachsig'];

        $allowhtml = (isset($HTTP_POST_VARS['allowhtml'])) ? (($HTTP_POST_VARS[
            'allowhtml']) ? true : 0) : $userdata['user_allowhtml'];
        $allowbbcode = (isset($HTTP_POST_VARS['allowbbcode'])) ? (($HTTP_POST_VARS[
            'allowbbcode']) ? true : 0) : $userdata['user_allowbbcode'];
        $allowsmilies = (isset($HTTP_POST_VARS['allowsmilies'])) ? (($HTTP_POST_VARS[
            'allowsmilies']) ? true : 0) : $userdata['user_allowsmile'];
    }

    $user_style = (isset($HTTP_POST_VARS['style'])) ? intval($HTTP_POST_VARS[
        'style']) : $board_config['default_style'];

    if (!empty($HTTP_POST_VARS['language']))
    {
        if (preg_match('/^[a-z_]+$/i', $HTTP_POST_VARS['language']))
        {
            $user_lang = htmlspecialchars($HTTP_POST_VARS['language']);
        }
        else
        {
            $error = true;
            $error_msg = $lang['Fields_empty'];
        }
    }
    else
    {
        $user_lang = $board_config['default_lang'];
    }

    $user_timezone = (isset($HTTP_POST_VARS['timezone'])) ? doubleval($HTTP_POST_VARS
        ['timezone']) : $board_config['board_timezone'];

    $sql = "SELECT config_value
		FROM " . CONFIG_TABLE . "
		WHERE config_name = 'default_dateformat'";
    if (!($result = $db->sql_query($sql)))
    {
        message_die_ext(GENERAL_ERROR, 'Could not select default dateformat', '',
            __line__, __file__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $board_config['default_dateformat'] = $row['config_value'];
    $user_dateformat = (!empty($HTTP_POST_VARS['dateformat'])) ? trim(
        htmlspecialchars($HTTP_POST_VARS['dateformat'])) : $board_config[
        'default_dateformat'];

    $user_avatar_local = (isset($HTTP_POST_VARS['avatarselect']) && !empty($HTTP_POST_VARS
        ['submitavatar']) && $board_config['allow_avatar_local']) ? htmlspecialchars($HTTP_POST_VARS
        ['avatarselect']) : ((isset($HTTP_POST_VARS['avatarlocal'])) ? htmlspecialchars
        ($HTTP_POST_VARS['avatarlocal']) : '');
    $user_avatar_category = (isset($HTTP_POST_VARS['avatarcatname']) && $board_config
        ['allow_avatar_local']) ? htmlspecialchars($HTTP_POST_VARS['avatarcatname']) :
        '';

    $user_avatar_remoteurl = (!empty($HTTP_POST_VARS['avatarremoteurl'])) ? trim(
        htmlspecialchars($HTTP_POST_VARS['avatarremoteurl'])) : '';
    $user_avatar_upload = (!empty($HTTP_POST_VARS['avatarurl'])) ? trim($HTTP_POST_VARS
        ['avatarurl']) : (($HTTP_POST_FILES['avatar']['tmp_name'] != "none") ? $HTTP_POST_FILES
        ['avatar']['tmp_name'] : '');
    $user_avatar_name = (!empty($HTTP_POST_FILES['avatar']['name'])) ? $HTTP_POST_FILES
        ['avatar']['name'] : '';
    $user_avatar_size = (!empty($HTTP_POST_FILES['avatar']['size'])) ? $HTTP_POST_FILES
        ['avatar']['size'] : 0;
    $user_avatar_filetype = (!empty($HTTP_POST_FILES['avatar']['type'])) ? $HTTP_POST_FILES
        ['avatar']['type'] : '';

    $user_avatar = (empty($user_avatar_local) && $mode == 'editprofile') ? $userdata
        ['user_avatar'] : '';
    $user_avatar_type = (empty($user_avatar_local) && $mode == 'editprofile') ? $userdata
        ['user_avatar_type'] : '';

    if ((isset($HTTP_POST_VARS['avatargallery']) || isset($HTTP_POST_VARS[
        'submitavatar']) || isset($HTTP_POST_VARS['cancelavatar'])) && (!isset($HTTP_POST_VARS
        ['submit'])))
    {
        $username = stripslashes($username);
        $selectedfaction = stripslashes($selectedfaction);
        $selectedregion = stripslashes($selectedregion);
        $email = stripslashes($email);
        $cur_password = htmlspecialchars(stripslashes($cur_password));
        $new_password = htmlspecialchars(stripslashes($new_password));
        $password_confirm = htmlspecialchars(stripslashes($password_confirm));

        $icq = stripslashes($icq);
        $aim = stripslashes($aim);
        $msn = stripslashes($msn);
        $yim = stripslashes($yim);

        $website = stripslashes($website);
        $location = stripslashes($location);
        $occupation = stripslashes($occupation);
        $interests = stripslashes($interests);
        $signature = htmlspecialchars(stripslashes($signature));

        $user_lang = stripslashes($user_lang);
        $user_dateformat = stripslashes($user_dateformat);

        if (!isset($HTTP_POST_VARS['cancelavatar']))
        {
            $user_avatar = $user_avatar_category . '/' . $user_avatar_local;
            $user_avatar_type = USER_AVATAR_GALLERY;
        }
    }
}

//
// Let's make sure the user isn't logged in while registering,
// and ensure that they were trying to register a second time
// (Prevents double registrations)
//
//if ($mode == 'newplayer' && ($userdata['session_logged_in'] || $username == $userdata['empire']))
//{
//	message_die_ext(GENERAL_MESSAGE, $lang['Empire_taken'], '', __LINE__, __FILE__);
//}

//
// Did the user submit? In this case build a query to update the users profile in the DB
//

function regionValidFaction($region)
{
	global $config, $selectedfaction;
	
	foreach($config['er'][100 + $selectedfaction]['regiontags'] as $num => $name)
	{
		if($name == $region)
		{
			$validregion = true;
		}
	}
	if($validregion)
	{
		return true;
	}
	else
	{
		return false;
	}
}

if (isset($HTTP_POST_VARS['submit']))
{
    include ($phpbb_root_path . 'includes/usercp_avatar.' . $phpEx);

    // session id check
    if ($sid == '' || $sid != $userdata['session_id'])
    {
        $error = true;
        $error_msg .= ((isset($error_msg)) ? '<br />' : '') . $lang['Session_invalid'];
    }

    $passwd_sql = '';
    if ($mode == 'editprofile')
    {
        if ($user_id != $userdata['user_id'])
        {
            $error = true;
            $error_msg .= ((isset($error_msg)) ? '<br />' : '') . $lang['Wrong_Profile'];
        }
    }
    else
        if ($mode == 'newplayer')
        {
            if (empty($selectedfaction))
            {
                $error = true;
                $error_msg .= ((isset($error_msg)) ? '<br />' : '') . $lang['Fields_empty'];
                $template->assign_vars(array('ERROR_BOX' => '<table><tr>
<td class="row1" width="100%" style="padding-top:1px; padding-bottom:3px;padding-left:6px" colspan="2"><span style="font-size: 10px; color:#dd2d10">A faction must be selected.</span>
</td>
</tr></table>'));
            }
            elseif (empty($selectedregion))
            {
                $error = true;
                $error_msg .= ((isset($error_msg)) ? '<br />' : '') . $lang['Fields_empty'];
                $template->assign_vars(array('ERROR_BOX' => '<table><tr>
<td class="row1" width="100%" style="padding-top:1px; padding-bottom:3px;padding-left:6px" colspan="2"><span style="font-size: 10px; color:#dd2d10">A region must be picked.</span>
</td>
</tr></table>'));
            }
			elseif(!regionValidFaction($selectedregion))
            {
                $error = true;
                $error_msg .= ((isset($error_msg)) ? '<br />' : '') . $lang['Fields_empty'];
                $template->assign_vars(array('ERROR_BOX' => '<table><tr>
<td class="row1" width="100%" style="padding-top:1px; padding-bottom:3px;padding-left:6px" colspan="2"><span style="font-size: 10px; color:#dd2d10">This region cannot be chosen for this faction.</span>
</td>
</tr></table>'));
            }
            elseif (empty($username))
            {
                $error = true;
                $error_msg .= ((isset($error_msg)) ? '<br />' : '') . $lang['Fields_empty'];
                $template->assign_vars(array('ERROR_GEN' => '<tr>
<td class="row1" width="100%" style="padding-top:1px; padding-bottom:3px;padding-left:6px" colspan="2"><span style="font-size: 10px; color:#dd2d10">All fields must be filled in.</span>
</td>
</tr>', 'STYLE_PBORDER_EM' => 'invalid-post', 'IMG_CROSS_EM' =>
                    '<img src="data/images/gui/cross.gif" width=12 height=12></img>', 'STYLE_PBORDER_CH' =>
                    'invalid-post', 'IMG_CROSS_CH' =>
                    '<img src="data/images/gui/cross.gif" width=12 height=12></img>'));
            }
            else
            {
                $template->assign_vars(array('STYLE_PBORDER_CH' => 'post', 'IMG_CROSS_CH' => ''));
            }
        }

    $passwd_sql = '';
    if (!empty($new_password) && !empty($password_confirm))
    {
        if ($new_password != $password_confirm)
        {
            $error = true;
            $error_msg .= ((isset($error_msg)) ? '<br />' : '') . $lang['Password_mismatch'];
        }
        else
            if (strlen($new_password) > 32)
            {
                $error = true;
                $error_msg .= ((isset($error_msg)) ? '<br />' : '') . $lang['Password_long'];
            }
            else
            {
                if ($mode == 'editprofile')
                {
                    $sql = "SELECT user_password
					FROM " . USERS_TABLE . "
					WHERE user_id = $user_id";
                    if (!($result = $db->sql_query($sql)))
                    {
                        message_die_ext(GENERAL_ERROR, 'Could not obtain user_password information', '',
                            __line__, __file__, $sql);
                    }

                    $row = $db->sql_fetchrow($result);

                    if ($row['user_password'] != md5($cur_password))
                    {
                        $error = true;
                        $error_msg .= ((isset($error_msg)) ? '<br />' : '') . $lang[
                            'Current_password_mismatch'];
                    }
                }

                if (!$error)
                {
                    $new_password = md5($new_password);
                    $passwd_sql = "user_password = '$new_password', ";
                }
            }
    }

    $username_sql = '';
    if ($board_config['allow_namechange'] || $mode == 'newplayer')
    {
        if (empty($username))
        {
            // Error is already triggered, since one field is empty.
            $error = true;
        }
        else
            if ($username != $userdata['empire'] || $mode == 'newplayer')
            {
                if (strtolower($username) != strtolower($userdata['empire']) || $mode ==
                    'newplayer')
                {
                    $result = validate_empire($username);
                    if ($result['error'])
                    {
                        $error = true;
                        $template->assign_vars(array('EM_ERROR' =>
                            '<br /><span class="gensmall" style="color:#dd2d10">' . $result['error_msg'] .
                            '</span>', 'STYLE_PBORDER_EM' => 'invalid-post', 'IMG_CROSS_EM' =>
                            '<img src="data/images/gui/cross.gif" width=12 height=12></img>'));
                    }
                    else
                    {
                        $template->assign_vars(array('STYLE_PBORDER_EM' => 'post', 'IMG_CROSS_EM' => ''));
                    }
                }
                if (!$error)
                {
                    $username_sql = "username = '" . str_replace("\'", "''", ucwords($username)) . "', ";

                }
            }
    }

    if ($signature != '')
    {
        if (strlen($signature) > $board_config['max_sig_chars'])
        {
            $error = true;
            $error_msg .= ((isset($error_msg)) ? '<br />' : '') . $lang[
                'Signature_too_long'];
        }

        if (!isset($signature_bbcode_uid) || $signature_bbcode_uid == '')
        {
            $signature_bbcode_uid = ($allowbbcode) ? make_bbcode_uid() : '';
        }
        $signature = prepare_message($signature, $allowhtml, $allowbbcode, $allowsmilies,
            $signature_bbcode_uid);
    }

    if ($website != '')
    {
        rawurlencode($website);
    }

    $avatar_sql = '';

    if (isset($HTTP_POST_VARS['avatardel']) && $mode == 'editprofile')
    {
        $avatar_sql = user_avatar_delete($userdata['user_avatar_type'], $userdata[
            'user_avatar']);
    }
    else
        if ((!empty($user_avatar_upload) || !empty($user_avatar_name)) && $board_config
            ['allow_avatar_upload'])
        {
            if (!empty($user_avatar_upload))
            {
                $avatar_mode = (empty($user_avatar_name)) ? 'remote' : 'local';
                $avatar_sql = user_avatar_upload($mode, $avatar_mode, $userdata['user_avatar'],
                    $userdata['user_avatar_type'], $error, $error_msg, $user_avatar_upload, $user_avatar_name,
                    $user_avatar_size, $user_avatar_filetype);
            }
            else
                if (!empty($user_avatar_name))
                {
                    $l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config[
                        'avatar_filesize'] / 1024));

                    $error = true;
                    $error_msg .= ((!empty($error_msg)) ? '<br />' : '') . $l_avatar_size;
                }
        }
        else
            if ($user_avatar_remoteurl != '' && $board_config['allow_avatar_remote'])
            {
                user_avatar_delete($userdata['user_avatar_type'], $userdata['user_avatar']);
                $avatar_sql = user_avatar_url($mode, $error, $error_msg, $user_avatar_remoteurl);
            }
            else
                if ($user_avatar_local != '' && $board_config['allow_avatar_local'])
                {
                    user_avatar_delete($userdata['user_avatar_type'], $userdata['user_avatar']);
                    $avatar_sql = user_avatar_gallery($mode, $error, $error_msg, $user_avatar_local,
                        $user_avatar_category);
                }

    if (!$error)
    {
        if ($avatar_sql == '')
        {
            $avatar_sql = ($mode == 'editprofile') ? '' : "'', " . USER_AVATAR_NONE;
        }

        if ($mode == 'editprofile')
        {
            if ($email != $userdata['user_email'] && $board_config['require_once_activation'] !=
                USER_ACTIVATION_NONE && $userdata['user_level'] != ADMIN)
            {
                $user_active = 0;

                $user_actkey = gen_rand_string(true);
                $key_len = 54 - (strlen($server_url));
                $key_len = ($key_len > 6) ? $key_len : 6;
                $user_actkey = substr($user_actkey, 0, $key_len);

                if ($userdata['session_logged_in'])
                {
                    session_end($userdata['session_id'], $userdata['user_id']);
                }
            }
            else
            {
                $user_active = 1;
                $user_actkey = '';
            }

            $sql = "UPDATE " . USERS_TABLE . "
				SET " . $username_sql . $passwd_sql . "user_email = '" . str_replace("\'",
                "''", $email) . "', user_icq = '" . str_replace("\'", "''", $icq) .
                "', user_website = '" . str_replace("\'", "''", $website) . "', user_occ = '" .
                str_replace("\'", "''", $occupation) . "', user_from = '" . str_replace("\'",
                "''", $location) . "', user_interests = '" . str_replace("\'", "''", $interests) .
                "', user_sig = '" . str_replace("\'", "''", $signature) .
                "', user_sig_bbcode_uid = '$signature_bbcode_uid', user_viewemail = $viewemail, user_aim = '" .
                str_replace("\'", "''", str_replace(' ', '+', $aim)) . "', user_yim = '" .
                str_replace("\'", "''", $yim) . "', user_msnm = '" . str_replace("\'", "''", $msn) .
                "', user_attachsig = $attachsig, user_allowsmile = $allowsmilies, user_allowhtml = $allowhtml, user_allowbbcode = $allowbbcode, user_allow_viewonline = $allowviewonline, user_notify = $notifyreply, user_notify_pm = $notifypm, user_popup_pm = $popup_pm, user_timezone = $user_timezone, user_dateformat = '" .
                str_replace("\'", "''", $user_dateformat) . "', user_lang = '" . str_replace("\'",
                "''", $user_lang) . "', user_style = $user_style, user_active = $user_active, user_actkey = '" .
                str_replace("\'", "''", $user_actkey) . "'" . $avatar_sql . "
				WHERE user_id = $user_id";

            if (!($result = $db->sql_query($sql)))
            {
                message_die_ext(GENERAL_ERROR, 'Could not update users table', '', __line__,
                    __file__, $sql);
            }

            // We remove all stored login keys since the password has been updated
            // and change the current one (if applicable)
            if (!empty($passwd_sql))
            {
                session_reset_keys($user_id, $user_ip);
            }

            if (!$user_active)
            {
                //
                // The users account has been deactivated, send them an email with a new activation key
                //
                include ($phpbb_root_path . 'includes/emailer_ext.' . $phpEx);
                $emailer = new emailer($board_config['smtp_delivery']);

                if ($board_config['require_once_activation'] != USER_ACTIVATION_ADMIN)
                {
                    $emailer->from($board_config['board_email']);
                    $emailer->replyto($board_config['board_email']);

                    $emailer->use_template('user_activate', stripslashes($user_lang));
                    $emailer->email_address($email);
                    $emailer->set_subject($lang['Reactivate']);

                    $emailer->assign_vars(array('SITENAME' => $board_config['sitename'], 'USERNAME' =>
                        preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(
                        str_replace("\'", "'", $username), 0, 25)), 'EMAIL_SIG' => (!empty($board_config
                        ['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config[
                        'board_email_sig']) : '', 'U_ACTIVATE' => $server_url . '?mode=activate&' .
                        POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey));
                    $emailer->send();
                    $emailer->reset();
                }
                else
                    if ($board_config['require_once_activation'] == USER_ACTIVATION_ADMIN)
                    {
                        $sql = 'SELECT user_email, user_lang 
 						FROM ' . USERS_TABLE . '
 						WHERE user_level = ' . ADMIN;

                        if (!($result = $db->sql_query($sql)))
                        {
                            message_die_ext(GENERAL_ERROR, 'Could not select Administrators', '', __line__,
                                __file__, $sql);
                        }

                        while ($row = $db->sql_fetchrow($result))
                        {
                            $emailer->from($board_config['board_email']);
                            $emailer->replyto($board_config['board_email']);

                            $emailer->email_address(trim($row['user_email']));
                            $emailer->use_template("admin_activate", $row['user_lang']);
                            $emailer->set_subject($lang['Reactivate']);

                            $emailer->assign_vars(array('USERNAME' => preg_replace($unhtml_specialchars_match,
                                $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
                                'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config[
                                'board_email_sig']), 'U_ACTIVATE' => $server_url . '?mode=activate&' .
                                POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey));
                            $emailer->send();
                            $emailer->reset();
                        }
                        $db->sql_freeresult($result);
                    }

                $message = $lang['Profile_updated_inactive'] . '<br /><br />' . sprintf($lang[
                    'Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
            }
            else
            {
                $message = $lang['Profile_updated'] . '<br /><br />' . sprintf($lang[
                    'Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
            }

            $template->assign_vars(array("META" =>
                '<meta http-equiv="refresh" content="5;url=' . append_sid("index.$phpEx") . '">'));

            message_die_ext(GENERAL_MESSAGE, $message);
        }
        else
        {
            $sql = "SELECT MAX(num) AS total
				FROM ".$config['prefixes'][1]."_players";
            if (!($result = $db->sql_query($sql)))
            {
                message_die_ext(GENERAL_ERROR, 'Could not obtain next user_id information', '',
                    __line__, __file__, $sql);
            }

            if (!($row = $db->sql_fetchrow($result)))
            {
                message_die_ext(GENERAL_ERROR, 'Could not obtain next user_id information', '',
                    __line__, __file__, $sql);
            }
            $user_id = $row['total'] + 1; // Default rank to put the player into


            define('IN_PHPBB', true);
define('PROMATHIUS', true);
            $userdata = session_pagestart($user_ip, PAGE_EMPIRE);
            init_userprefs($userdata);
            
            $race = $selectedfaction;
            
		require_once 'game/lib/create-empire.php';

        }// if mode == newplayer
    }

}// End of submit
if ($error)
{
    //
    // If an error occured we need to stripslashes on returned data
    //
    $username = stripslashes($username);
    $email = stripslashes($email);
    $cur_password = '';
    $new_password = '';
    $password_confirm = '';

    $icq = stripslashes($icq);
    $aim = str_replace('+', ' ', stripslashes($aim));
    $msn = stripslashes($msn);
    $yim = stripslashes($yim);

    $website = stripslashes($website);
    $location = stripslashes($location);
    $occupation = stripslashes($occupation);
    $interests = stripslashes($interests);
    $signature = stripslashes($signature);
    $signature = ($signature_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid(=|\])/si",
        '\\3', $signature) : $signature;

    $user_lang = stripslashes($user_lang);
    $user_dateformat = stripslashes($user_dateformat);

}
else
    if ($mode == 'editprofile' && !isset($HTTP_POST_VARS['avatargallery']) && !
        isset($HTTP_POST_VARS['submitavatar']) && !isset($HTTP_POST_VARS['cancelavatar']))
    {
        $user_id = $userdata['user_id'];
        $username = $userdata['empire'];
        $email = $userdata['user_email'];
        $cur_password = '';
        $new_password = '';
        $password_confirm = '';

        $icq = $userdata['user_icq'];
        $aim = str_replace('+', ' ', $userdata['user_aim']);
        $msn = $userdata['user_msnm'];
        $yim = $userdata['user_yim'];

        $website = $userdata['user_website'];
        $location = $userdata['user_from'];
        $occupation = $userdata['user_occ'];
        $interests = $userdata['user_interests'];
        $signature_bbcode_uid = $userdata['user_sig_bbcode_uid'];
        $signature = ($signature_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid(=|\])/si",
            '\\3', $userdata['user_sig']) : $userdata['user_sig'];

        $viewemail = $userdata['user_viewemail'];
        $notifypm = $userdata['user_notify_pm'];
        $popup_pm = $userdata['user_popup_pm'];
        $notifyreply = $userdata['user_notify'];
        $attachsig = $userdata['user_attachsig'];
        $allowhtml = $userdata['user_allowhtml'];
        $allowbbcode = $userdata['user_allowbbcode'];
        $allowsmilies = $userdata['user_allowsmile'];
        $allowviewonline = $userdata['user_allow_viewonline'];

        $user_avatar = ($userdata['user_allowavatar']) ? $userdata['user_avatar'] : '';
        $user_avatar_type = ($userdata['user_allowavatar']) ? $userdata[
            'user_avatar_type'] : USER_AVATAR_NONE;

        $user_style = $userdata['user_style'];
        $user_lang = $userdata['user_lang'];
        $user_timezone = $userdata['user_timezone'];
        $user_dateformat = $userdata['user_dateformat'];
    }

//
// Default pages
//
include ($phpbb_root_path . 'includes/page_header_ext.' . $phpEx);

make_jumpbox('viewforum.' . $phpEx);

if ($mode == 'editprofile')
{
    if ($user_id != $userdata['user_id'])
    {
        $error = true;
        $error_msg = $lang['Wrong_Profile'];
    }
}

if (isset($HTTP_POST_VARS['avatargallery']) && !$error)
{
    include ($phpbb_root_path . 'includes/usercp_avatar.' . $phpEx);

    $avatar_category = (!empty($HTTP_POST_VARS['avatarcategory'])) ?
        htmlspecialchars($HTTP_POST_VARS['avatarcategory']) : '';

    $template->set_filenames(array('body' => 'profile_avatar_gallery.tpl'));

    $allowviewonline = !$allowviewonline;

    display_avatar_gallery($mode, $avatar_category, $user_id, $email, $current_email,
        $coppa, $username, $email, $new_password, $cur_password, $password_confirm, $icq,
        $aim, $msn, $yim, $website, $location, $occupation, $interests, $signature, $viewemail,
        $notifypm, $popup_pm, $notifyreply, $attachsig, $allowhtml, $allowbbcode, $allowsmilies,
        $allowviewonline, $user_style, $user_lang, $user_timezone, $user_dateformat, $userdata
        ['session_id']);
}
else
{
    include ($phpbb_root_path . 'includes/functions_selects.' . $phpEx);

    if (!isset($coppa))
    {
        $coppa = false;
    }

    if (!isset($user_style))
    {
        $user_style = $board_config['default_style'];
    }

    $avatar_img = '';
    if ($user_avatar_type)
    {
        switch ($user_avatar_type)
        {
            case USER_AVATAR_UPLOAD:
                $avatar_img = ($board_config['allow_avatar_upload']) ? '<img src="' . $board_config
                    ['avatar_path'] . '/' . $user_avatar . '" alt="" />' : '';
                break;
            case USER_AVATAR_REMOTE:
                $avatar_img = ($board_config['allow_avatar_remote']) ? '<img src="' . $user_avatar .
                    '" alt="" />' : '';
                break;
            case USER_AVATAR_GALLERY:
                $avatar_img = ($board_config['allow_avatar_local']) ? '<img src="' . $board_config
                    ['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" />' : '';
                break;
        }
    }

    $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode .
        '" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' .
        $coppa . '" />';
    $s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata[
        'session_id'] . '" />';
    if ($mode == 'editprofile')
    {
        $s_hidden_fields .= '<input type="hidden" name="user_id" value="' . $userdata[
            'user_id'] . '" />';
        //
        // Send the users current email address. If they change it, and account activation is turned on
        // the user account will be disabled and the user will have to reactivate their account.
        //
        $s_hidden_fields .= '<input type="hidden" name="current_email" value="' . $userdata
            ['user_email'] . '" />';
    }

    if (!empty($user_avatar_local))
    {
        $s_hidden_fields .= '<input type="hidden" name="avatarlocal" value="' . $user_avatar_local .
            '" /><input type="hidden" name="avatarcatname" value="' . $user_avatar_category .
            '" />';
    }

    $html_status = ($userdata['user_allowhtml'] && $board_config['allow_html']) ? $lang
        ['HTML_is_ON'] : $lang['HTML_is_OFF'];
    $bbcode_status = ($userdata['user_allowbbcode'] && $board_config['allow_bbcode']) ?
        $lang['BBCode_is_ON'] : $lang['BBCode_is_OFF'];
    $smilies_status = ($userdata['user_allowsmile'] && $board_config[
        'allow_smilies']) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];

    if ($error)
    {
    }


    $template->set_filenames(array('body' =>
        '../../../data/templates/new_empire.tpl'));

    if ($mode == 'editprofile')
    {
        $template->assign_block_vars('switch_edit_profile', array());
    }

    if (($mode == 'newplayer') || ($board_config['allow_namechange']))
    {
        $template->assign_block_vars('switch_namechange_allowed', array());
    }
    else
    {
        $template->assign_block_vars('switch_namechange_disallowed', array());
    }

    // Visual Confirmation
    $confirm_image = '';
    if (!empty($board_config['enable_confirm']) && $mode == 'newplayer')
    {
        $sql = 'SELECT session_id 
			FROM ' . SESSIONS_TABLE;
        if (!($result = $db->sql_query($sql)))
        {
            message_die_ext(GENERAL_ERROR, 'Could not select session data', '', __line__,
                __file__, $sql);
        }

        if ($row = $db->sql_fetchrow($result))
        {
            $confirm_sql = '';
            do
            {
                $confirm_sql .= (($confirm_sql != '') ? ', ' : '') . "'" . $row['session_id'] .
                    "'";
            } while ($row = $db->sql_fetchrow($result));

            $sql = 'DELETE FROM ' . CONFIRM_TABLE . " 
				WHERE session_id NOT IN ($confirm_sql)";
            if (!$db->sql_query($sql))
            {
                message_die_ext(GENERAL_ERROR, 'Could not delete stale confirm data', '',
                    __line__, __file__, $sql);
            }
        }
        $db->sql_freeresult($result);

        $sql = 'SELECT COUNT(session_id) AS attempts 
			FROM ' . CONFIRM_TABLE . " 
			WHERE session_id = '" . $userdata['session_id'] . "'";
        if (!($result = $db->sql_query($sql)))
        {
            message_die_ext(GENERAL_ERROR, 'Could not obtain confirm code count', '',
                __line__, __file__, $sql);
        }

        $db->sql_freeresult($result);

        // Generate the require_onced confirmation code
        // NB 0 (zero) could get confused with O (the letter) so we make change it
        $code = dss_rand();
        $code = substr(str_replace('0', 'Z', strtoupper(base_convert($code, 16, 35))), 2,
            6);

        $confirm_id = md5(uniqid($user_ip));

        $sql = 'INSERT INTO ' . CONFIRM_TABLE . " (confirm_id, session_id, code) 
			VALUES ('$confirm_id', '" . $userdata['session_id'] . "', '$code')";
        if (!$db->sql_query($sql))
        {
            message_die_ext(GENERAL_ERROR, 'Could not insert new confirm code information',
                '', __line__, __file__, $sql);
        }

        unset($code);

        $confirm_image = '<img src="' . append_sid("create_empire.$phpEx?mode=confirm&amp;id=$confirm_id") .
            '" alt="" title="" />';
        $s_hidden_fields .= '<input type="hidden" name="confirm_id" value="' . $confirm_id .
            '" />';

        $template->assign_block_vars('switch_confirm', array());
        $template->assign_block_vars('switch_register', array());
    }

	// Prepare faction images
	for ($int = 1; $int < $config['races']; $int ++)
	{
		$factions_icons_html .= '<td><a href="templates/prom/frames/'.$faction_namelow.'s.php" target="descr"><img src="data/images/symbols/athens.gif" name="img1" width="62" height="57" onmouseover="myOn(this.name)" alt="" onmouseout="myOut(this.name)" /></img></a></td>';
	}
	

    //
    // Let's do an overall check for settings/versions which would prevent
    // us from doing file uploads....
    //
    $ini_val = (phpversion() >= '4.0.0') ? 'ini_get' : 'get_cfg_var';
    $form_enctype = (@$ini_val('file_uploads') == '0' || strtolower(@$ini_val(
        'file_uploads') == 'off') || phpversion() == '4.0.4pl1' || !$board_config[
        'allow_avatar_upload'] || (phpversion() < '4.0.3' && @$ini_val('open_basedir') !=
        '')) ? '' : 'enctype="multipart/form-data"';

    $template->assign_vars(array('USERNAME' => isset($username) ? $username : '',
        'CUR_PASSWORD' => isset($cur_password) ? $cur_password : '', 'NEW_PASSWORD' =>
        isset($new_password) ? $new_password : '', 'PASSWORD_CONFIRM' => isset($password_confirm) ?
        $password_confirm : '', 'EMAIL' => isset($email) ? $email : '', 'CONFIRM_IMG' =>
        $confirm_image, 'YIM' => $yim, 'ICQ' => $icq, 'MSN' => $msn, 'AIM' => $aim,
        'OCCUPATION' => $occupation, 'INTERESTS' => $interests, 'LOCATION' => $location,
        'WEBSITE' => $website, 'SIGNATURE' => str_replace('<br />', "\n", $signature),
        'VIEW_EMAIL_YES' => ($viewemail) ? 'checked="checked"' : '', 'VIEW_EMAIL_NO' =>
        (!$viewemail) ? 'checked="checked"' : '', 'HIDE_USER_YES' => (!$allowviewonline) ?
        'checked="checked"' : '', 'HIDE_USER_NO' => ($allowviewonline) ?
        'checked="checked"' : '', 'NOTIFY_PM_YES' => ($notifypm) ? 'checked="checked"' :
        '', 'NOTIFY_PM_NO' => (!$notifypm) ? 'checked="checked"' : '', 'POPUP_PM_YES' =>
        ($popup_pm) ? 'checked="checked"' : '', 'POPUP_PM_NO' => (!$popup_pm) ?
        'checked="checked"' : '', 'ALWAYS_ADD_SIGNATURE_YES' => ($attachsig) ?
        'checked="checked"' : '', 'ALWAYS_ADD_SIGNATURE_NO' => (!$attachsig) ?
        'checked="checked"' : '', 'NOTIFY_REPLY_YES' => ($notifyreply) ?
        'checked="checked"' : '', 'NOTIFY_REPLY_NO' => (!$notifyreply) ?
        'checked="checked"' : '', 'ALWAYS_ALLOW_BBCODE_YES' => ($allowbbcode) ?
        'checked="checked"' : '', 'ALWAYS_ALLOW_BBCODE_NO' => (!$allowbbcode) ?
        'checked="checked"' : '', 'ALWAYS_ALLOW_HTML_YES' => ($allowhtml) ?
        'checked="checked"' : '', 'ALWAYS_ALLOW_HTML_NO' => (!$allowhtml) ?
        'checked="checked"' : '', 'ALWAYS_ALLOW_SMILIES_YES' => ($allowsmilies) ?
        'checked="checked"' : '', 'ALWAYS_ALLOW_SMILIES_NO' => (!$allowsmilies) ?
        'checked="checked"' : '', 'ALLOW_AVATAR' => $board_config['allow_avatar_upload'],
        'AVATAR' => $avatar_img, 'AVATAR_SIZE' => $board_config['avatar_filesize'],
        'LANGUAGE_SELECT' => language_select($user_lang, 'language'), 'STYLE_SELECT' =>
        style_select($user_style, 'style'), 'TIMEZONE_SELECT' => tz_select($user_timezone,
        'timezone'), 'DATE_FORMAT' => $user_dateformat, 'HTML_STATUS' => $html_status,
        'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") .
        '" target="_phpbbcode">', '</a>'), 'SMILIES_STATUS' => $smilies_status,
        'L_CURRENT_PASSWORD' => $lang['Current_password'], 'L_NEW_PASSWORD' => ($mode ==
        'newplayer') ? $lang['Password'] : $lang['New_password'], 'L_CONFIRM_PASSWORD' =>
        $lang['Confirm_password'], 'L_CONFIRM_PASSWORD_EXPLAIN' => ($mode ==
        'editprofile') ? $lang['Confirm_password_explain'] : '', 'L_PASSWORD_IF_CHANGED' =>
        ($mode == 'editprofile') ? $lang['password_if_changed'] : '',
        'L_PASSWORD_CONFIRM_IF_CHANGED' => ($mode == 'editprofile') ? $lang[
        'password_confirm_if_changed'] : '', 'L_SUBMIT' => $lang['Submit'], 'L_RESET' =>
        $lang['Reset'], 'L_ICQ_NUMBER' => $lang['ICQ'], 'L_MESSENGER' => $lang['MSNM'],
        'L_YAHOO' => $lang['YIM'], 'L_WEBSITE' => $lang['Website'], 'L_AIM' => $lang[
        'AIM'], 'L_LOCATION' => $lang['Location'], 'L_OCCUPATION' => $lang['Occupation'],
        'L_BOARD_LANGUAGE' => $lang['Board_lang'], 'L_BOARD_STYLE' => $lang[
        'Board_style'], 'L_TIMEZONE' => $lang['Timezone'], 'L_DATE_FORMAT' => $lang[
        'Date_format'], 'L_DATE_FORMAT_EXPLAIN' => $lang['Date_format_explain'], 'L_YES' =>
        $lang['Yes'], 'L_NO' => $lang['No'], 'L_INTERESTS' => $lang['Interests'],
        'L_ALWAYS_ALLOW_SMILIES' => $lang['Always_smile'], 'L_ALWAYS_ALLOW_BBCODE' => $lang
        ['Always_bbcode'], 'L_ALWAYS_ALLOW_HTML' => $lang['Always_html'], 'L_HIDE_USER' =>
        $lang['Hide_user'], 'L_ALWAYS_ADD_SIGNATURE' => $lang['Always_add_sig'],
        'L_AVATAR_PANEL' => $lang['Avatar_panel'], 'L_AVATAR_EXPLAIN' => sprintf($lang[
        'Avatar_explain'], $board_config['avatar_max_width'], $board_config[
        'avatar_max_height'], (round($board_config['avatar_filesize'] / 1024))),
        'L_UPLOAD_AVATAR_FILE' => $lang['Upload_Avatar_file'], 'L_UPLOAD_AVATAR_URL' =>
        $lang['Upload_Avatar_URL'], 'L_UPLOAD_AVATAR_URL_EXPLAIN' => $lang[
        'Upload_Avatar_URL_explain'], 'L_AVATAR_GALLERY' => $lang['Select_from_gallery'],
        'L_SHOW_GALLERY' => $lang['View_avatar_gallery'], 'L_LINK_REMOTE_AVATAR' => $lang
        ['Link_remote_Avatar'], 'L_LINK_REMOTE_AVATAR_EXPLAIN' => $lang[
        'Link_remote_Avatar_explain'], 'L_DELETE_AVATAR' => $lang['Delete_Image'],
        'L_CURRENT_IMAGE' => $lang['Current_Image'], 'L_SIGNATURE' => $lang['Signature'],
        'L_SIGNATURE_EXPLAIN' => sprintf($lang['Signature_explain'], $board_config[
        'max_sig_chars']), 'L_NOTIFY_ON_REPLY' => $lang['Always_notify'],
        'L_NOTIFY_ON_REPLY_EXPLAIN' => $lang['Always_notify_explain'],
        'L_NOTIFY_ON_PRIVMSG' => $lang['Notify_on_privmsg'], 'L_POPUP_ON_PRIVMSG' => $lang
        ['Popup_on_privmsg'], 'L_POPUP_ON_PRIVMSG_EXPLAIN' => $lang[
        'Popup_on_privmsg_explain'], 'L_PREFERENCES' => $lang['Preferences'],
        'L_PUBLIC_VIEW_EMAIL' => $lang['Public_view_email'], 'L_ITEMS_require_onceD' => $lang
        ['Items_require_onced'], 'L_REGISTRATION_INFO' => $lang['Registration_info'],
        'L_PROFILE_INFO' => $lang['Profile_info'], 'L_PROFILE_INFO_NOTICE' => $lang[
        'Profile_info_warn'], 'L_EMAIL_ADDRESS' => $lang['Email_address'],
        'L_CONFIRM_CODE_IMPAIRED' => sprintf($lang['Confirm_code_impaired'],
        '<a href="mailto:' . $board_config['board_email'] . '">', '</a>'),
        'L_CONFIRM_CODE' => $lang['Confirm_code'], 'L_CONFIRM_CODE_EXPLAIN' => $lang[
        'Confirm_code_explain'], 'S_ALLOW_AVATAR_UPLOAD' => $board_config[
        'allow_avatar_upload'], 'S_ALLOW_AVATAR_LOCAL' => $board_config[
        'allow_avatar_local'], 'S_ALLOW_AVATAR_REMOTE' => $board_config[
        'allow_avatar_remote'], 'S_HIDDEN_FIELDS' => $s_hidden_fields, 'S_FORM_ENCTYPE' =>
        $form_enctype, 'S_PROFILE_ACTION' => append_sid("create_empire.php?mode=newplayer&agreed=true")));

    //
    // This is another cheat using the block_var capability
    // of the templates to 'fake' an IF...ELSE...ENDIF solution
    // it works well :)
    //
    if ($mode != 'newplayer')
    {
        if ($userdata['user_allowavatar'] && ($board_config['allow_avatar_upload'] || $board_config
            ['allow_avatar_local'] || $board_config['allow_avatar_remote']))
        {
            $template->assign_block_vars('switch_avatar_block', array());

            if ($board_config['allow_avatar_upload'] && file_exists(@phpbb_realpath('./' . $board_config
                ['avatar_path'])))
            {
                if ($form_enctype != '')
                {
                    $template->assign_block_vars('switch_avatar_block.switch_avatar_local_upload',
                        array());
                }
                $template->assign_block_vars('switch_avatar_block.switch_avatar_remote_upload',
                    array());
            }

            if ($board_config['allow_avatar_remote'])
            {
                $template->assign_block_vars('switch_avatar_block.switch_avatar_remote_link',
                    array());
            }

            if ($board_config['allow_avatar_local'] && file_exists(@phpbb_realpath('./' . $board_config
                ['avatar_gallery_path'])))
            {
                $template->assign_block_vars('switch_avatar_block.switch_avatar_local_gallery',
                    array());
            }
        }
    }
}
echo $faction;
$template->pparse('body');

include ($phpbb_root_path . 'includes/page_tail.' . $phpEx);

?>