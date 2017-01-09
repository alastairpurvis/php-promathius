<?php
/***************************************************************************
*                                create_empire.php
*                            -------------------
*   begin                : Saturday, Feb 13, 2007
*   copyright            : (C) 2001 The phpBB Group
*   email                : support@phpbb.com
*
*   $Id: register.php,v 1.193.2.7 2006/04/09 16:17:27 grahamje Exp $
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
***************************************************************************/

define('IN_PHPBB', true);
define('PROMATHIUS', true);
$phpbb_root_path = './forum/';
include ($phpbb_root_path . 'extension.inc');
include ($phpbb_root_path . 'common.' . $phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_EMPIRE);
init_userprefs($userdata);
//
// End session management
//

// session id check
if (!empty($HTTP_POST_VARS['sid']) || !empty($HTTP_GET_VARS['sid']))
{
    $sid = (!empty($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : $HTTP_GET_VARS
        ['sid'];
}
else
{
    $sid = '';
}

if ($userdata['is_empire'])
{
    die ("You have already founded your settlement.");
    exit;
}

//
// Set default email variables
//

$script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config[
    'script_path']));
$script_name = ($script_name != '') ? $script_name . '/profile.' . $phpEx :
    'profile.' . $phpEx;
$server_name = trim($board_config['server_name']);
$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

$server_url = $server_protocol . $server_name . $server_port . $script_name;

// -----------------------
// Page specific functions
//
function gen_rand_string($hash)
{
    $rand_str = dss_rand();

    return ($hash) ? md5($rand_str) : substr($rand_str, 0, 8);
}

//
// End page specific functions
// ---------------------------
function sqlQuotes(&$str)
{
    $str = mysql_real_escape_string($str);
}
function mysql_safe_query($query)
{
    return mysql_query($query);/* SAFE -- root call */
}
$userdata = session_pagestart($user_ip, PAGE_LOGIN);
init_userprefs($userdata);

$is_empire = $userdata[is_empire];

//
// Start of program proper
//
if (isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']))
{
    $mode = (isset($HTTP_GET_VARS['mode'])) ? $HTTP_GET_VARS['mode'] : $HTTP_POST_VARS
        ['mode'];
    $mode = htmlspecialchars($mode);

    if ($mode == 'newplayer')
    {
        if ($userdata['session_logged_in'])
        {
            if ($is_empire == '0')
            {
                include ($phpbb_root_path . 'includes/empire_new.' . $phpEx);
            }
        }
        redirect(append_sid("../index.$phpEx", true));
        exit;
    }
    else
        if ($mode == 'email')
        {
            include ($phpbb_root_path . 'includes/usercp_email.' . $phpEx);
            exit;
        }
}

redirect(append_sid("../index.$phpEx", true));

?>
