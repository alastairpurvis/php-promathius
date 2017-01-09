<?php
/*
  cip_manager.php
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2003 osCommerce
  Released under the GNU General Public License
*/

if(defined('JOSCOM_VERSION')){
	require(DIR_FS_ADMIN_INCLUDES.'application_top.php');
}else{
	if(!defined('DB_PREFIX')) define('DB_PREFIX', '');
	require('includes/application_top.php');
    require('includes/configure_ci.php');
}


if(!defined('TABLE_CIP')) {
    define('TABLE_CIP', (defined('DB_PREFIX') ? DB_PREFIX : '').'cip');
}


if (!defined(BOX_CONTRIB_INSTALLER)) {
    define('BOX_CONTRIB_INSTALLER', 'Contrib Installer');
}
include_once(DIR_FS_ADMIN_LANGUAGES.'english/contrib_installer.php');
require_once(DIR_FS_ADMIN_CLASSES.'ci_cip.class.php');
require_once(DIR_FS_ADMIN_CLASSES.'ci_upload_cip.class.php');
require_once(DIR_FS_ADMIN_CLASSES.'ci_file_integrity.class.php');


// initialize the message stack for output messages
require_once(DIR_FS_ADMIN_CLASSES.'table_block.php');
require_once(DIR_FS_ADMIN_CLASSES.'ci_message.class.php');
$message=new message;
//Must be included after ci_message.class.php:
require_once(DIR_FS_ADMIN_CLASSES.'ci_cip_manager.class.php');
$cip_manager= new cip_manager($current_path);
require_once(DIR_FS_ADMIN_FUNCTIONS . 'contrib_installer.php');


//set_current_path:

//if (defined('DIR_FS_CIP'))     $current_path=DIR_FS_CIP;

//This must protect contrib_dir parameter
if (isset($_REQUEST['contrib_dir']) && $_REQUEST['action']=='install'
&& $_REQUEST['cip']==$cip_manager->ci_cip() && is_dir($_REQUEST['contrib_dir']) ){
  $current_path=$_REQUEST['contrib_dir'];
}

if (strstr($current_path, '..') or !is_dir($current_path) or (defined(DIR_FS_CIP) && !ereg('^' . DIR_FS_CIP, $current_path))) {
    $current_path = DIR_FS_CIP;
}

if (!tep_session_is_registered('current_path'))   tep_session_register('current_path');
$current_path=str_replace ('//', '/', $current_path);


// Nessesary for self-install. We redirect from init_contrib_installer.php with this patameters:
if (!defined(DIR_FS_CIP) && $_REQUEST['contrib_dir'])     define ('DIR_FS_CIP', $_REQUEST['contrib_dir']);

//Check if ontrib Installer installed:
if (DIR_FS_CIP=='DIR_FS_CIP')     tep_redirect(tep_href_link(INIT_CONTRIB_INSTALLER));

//Check if self-install was made:
if ($_REQUEST['cip']!=$cip_manager->ci_cip() && $_REQUEST['contrib_dir'] && !$cip_manager->is_ci_installed()) {
  tep_redirect(tep_href_link(INIT_CONTRIB_INSTALLER));
}

$cip_manager->check_action($_REQUEST['action']);



//Content for list:
$contents = array();
$contents=$cip_manager->folder_contents();
if (is_array($contents)) {
  function tep_cmp($a, $b) {return strcmp( ($a['is_dir'] ? 'D' : 'F') . $a['name'], ($b['is_dir'] ? 'D' : 'F') . $b['name']);}
  usort($contents, 'tep_cmp');
}

  $cip_list=$cip_manager->draw_cip_list();


$info=$cip_manager->draw_info();
?>
<?php if(defined('JOSCOM_VERSION')){ ?>
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_ADMIN_INCLUDES; ?>stylesheet.css">
<link rel="stylesheet" type="text/css" href=<?php echo DIR_WS_ADMIN_INCLUDES; ?>"contrib_installer.css">
<script language="javascript" src="<?php echo DIR_WS_ADMIN_INCLUDES; ?>general.js"></script>
<?php }else{ ?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/contrib_installer.css">
<script language="javascript" src="includes/general.js"></script>
<?php } ?>
<script LANGUAGE="JavaScript">
<!--
function confirmSubmit()
{
var agree=confirm("<?php echo TEXT_DELETE_INTRO;?>");
if (agree)  return true ;
else  return false ;
}
// -->
</script>


<?php if(!defined('JOSCOM_VERSION')){ ?>
</head>
<body bgcolor="#E5E5E5">
<?php } ?>
<!-- header //-->
<?php require(DIR_FS_ADMIN_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
   <!-- left_navigation //-->
   <?php require(DIR_FS_ADMIN_INCLUDES . 'column_left.php'); ?>
   <!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr><td width="100%" class="pageHeading"><?php echo HEADING_TITLE;?></td></tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0" >
          <tr>
<?php
if ($_REQUEST['action']!='upload') {
?>
            <td valign="top"><table border="0" width="100%" cellspacing="1" cellpadding="0"
            style="border:2px solid #00659c;">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION;?>&nbsp;</td>
                <td class="dataTableHeadingContent" width="90%"><?php echo TABLE_HEADING_FILENAME; ?></td>
    <?php
    if ($cip_manager->current_path==DIR_FS_CIP && SHOW_SIZE_COLUMN=='true') {
        echo '<td class="dataTableHeadingContent" align="right">'. TABLE_HEADING_SIZE.', Kb</td>';
    }?>
                <td class="dataTableHeadingContent" align="right">&nbsp;</td>
              </tr>
<?php
echo $cip_list;
?>
            </table>
            </td>
            <td style="pagging:1px;"></td>
<?php
}
echo $info;
?>
          </tr>
        </table></td>
      </tr>
    <?php
// end of list of CIP
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_FS_ADMIN_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<?php if(!defined('JOSCOM_VERSION')){ ?>
</body>
</html>
<?php } ?>
<?php require(DIR_FS_ADMIN_INCLUDES . 'application_bottom.php'); ?>