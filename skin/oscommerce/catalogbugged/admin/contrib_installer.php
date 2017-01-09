<?php
/*
osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com
Copyright (c) 2003 osCommerce
Released under the GNU General Public License
*/


if(defined('JOSCOM_VERSION')){
	require(DIR_FS_ADMIN_INCLUDES.'application_top.php');
}else{

    if(!defined('DB_PREFIX'))    define('DB_PREFIX', '');
	require('includes/application_top.php');
    require('includes/configure_ci.php');

}

if(!defined('TABLE_CIP')) {
    define('TABLE_CIP', (defined('DB_PREFIX') ? DB_PREFIX : '').'cip');
}

include_once(DIR_FS_ADMIN_LANGUAGES.'english/contrib_installer.php');
include_once(DIR_FS_ADMIN_LANGUAGES.'english/cip_manager.php');
require(DIR_FS_ADMIN_FUNCTIONS.'contrib_installer.php');
require_once(DIR_FS_ADMIN_CLASSES.'table_block.php');
require_once(DIR_FS_ADMIN_CLASSES.'ci_message.class.php');

$message=new message;
//PrintArray($_SERVER);
//exit;

if ($_REQUEST['contrib_dir'])    prepare_ci_installation();
if (isset($_REQUEST['contrib_dir']) && $message->size<1) {
    // Name of Contrib Installer folder:
    $ci_cip=CONTRIB_INSTALLER_NAME."_".CONTRIB_INSTALLER_VERSION;
    //Redirect to self-install:
    tep_redirect(tep_href_link('cip_manager.php', 'action=install&contrib_dir='.$_REQUEST['contrib_dir'].'&cip='.$ci_cip));
} else {
    //Print init page
    define('HEADING_TITLE', INIT_CONTRIB_INSTALLER_TEXT." ".CONTRIB_INSTALLER_VERSION );
?>
<?php if(defined('JOSCOM_VERSION')){ ?>
	<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_ADMIN_INCLUDES; ?>stylesheet.css">
<?php }else{ ?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/contrib_installer.css">
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
      <tr><td class="pageHeading"><?php echo HEADING_TITLE;?></td></tr>
      <tr><td ><?php echo (($message->size>0) ? $message->output() : ''); ?></td></tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
            <table border="0" cellspacing="2" cellpadding="2"  width="100%">
              <tr>
                <td width="220" valign="middle" align="left"><?php echo CONTRIBUTION_DIR_TEXT;?></td>
                <td width="270" valign="middle" align="left"><?php
                    echo tep_draw_form('initialization', 'contrib_installer.php','', 'post').
                             tep_draw_input_field('contrib_dir', DIR_FS_ADMIN . 'contributions', 'size="70"');?>
                </td>
                <td width="*"  valign="middle" align="left"><?php
                    echo tep_image_submit('button_module_install.gif', INSTALL_CONTRIB_INSTALLER);?>
                </td>
              </tr>
              <tr><td colspan="3" valign="middle" align="left"><?php echo INTRO;?></td></tr>
            </table>
            </form>
            </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_FS_ADMIN_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
<?php if(!defined('JOSCOM_VERSION')){ ?>
</body>
</html>
<?php } ?>
<?php require(DIR_FS_ADMIN_INCLUDES . 'application_bottom.php');
}




//========================================================
//Functions:
//========================================================
function recursive_mkdir($path) {
  global $message;
  if (!file_exists($path)) {
    if (is_dir($path))     recursive_permissions_check($path);
    else {
      recursive_mkdir(dirname($path));
      if (!is_writeable(dirname($path))) {
        $message->add(WRITE_PERMISSINS_NEEDED_TEXT.dirname($path).'/','error');
        return;
      }
      if (!@mkdir($path, 0777)) {
        $message->add(CANT_CREATE_DIR_TEXT.$path,'error');
        return;
      }
      if (is_dir($path))    chmod($path, 0777);
    }
  }
}


function prepare_ci_installation() {
  global $message;
  //Do install
  //==========================================================
  //Rinon wrote this. I don't know what it is doing :-):
  if (preg_replace('/^(.*)(\/|\\\)$/', $_REQUEST['contrib_dir'], $matches)) {
      $contrib_dir=$matches[1];
  } else    $contrib_dir=$_REQUEST['contrib_dir'];
  //=======================================
  //Check if upper folder exists and create if nessesary:
  if(!is_dir(dirname($contrib_dir))) {
      if(!@mkdir(dirname($contrib_dir), 0777)) {
          $message->add(WRITE_PERMISSINS_NEEDED_TEXT.dirname($contrib_dir),'error');
          return;
      }
  }
  //CONTIBUTIONS FOLDER
  if(!is_dir($contrib_dir)) {
      recursive_mkdir($contrib_dir);
      if (is_dir($contrib_dir))    chmod($contrib_dir, 0777);
      else return;
  }
  //BACKUP FOLDER
  if(!is_dir(DIR_FS_ADMIN_BACKUP)){
      recursive_mkdir(DIR_FS_ADMIN_BACKUP);
      if (is_dir(DIR_FS_ADMIN_BACKUP))    chmod(DIR_FS_ADMIN_BACKUP, 0777);
      else return;
  }
  //=======================================


  //=======================================
  // Name of Contrib Installer folder:
  $ci_cip=CONTRIB_INSTALLER_NAME."_".CONTRIB_INSTALLER_VERSION;

  //Creates Contrib Installer folder in contribs folder:
  if (!is_dir($contrib_dir.'/'.$ci_cip)) {
      if (!@mkdir($contrib_dir.'/'.$ci_cip.'/')) {
          $message->add(WRITE_PERMISSINS_NEEDED_TEXT.$contrib_dir.'/'.$ci_cip,'error');
          return;
      }
      if (is_dir($contrib_dir.'/'.$ci_cip))    chmod($contrib_dir.'/'.$ci_cip, 0777);
  }

  //If install.xml with Contrib Installer exists we remove them:
  if(file_exists($contrib_dir.'/'.$ci_cip.'/'. CONFIG_FILENAME)) {
      if(!(@ unlink($contrib_dir.'/'.$ci_cip . '/' . CONFIG_FILENAME))) {
          $message->add(COULDNT_REMOVE_FILE_TEXT.$contrib_dir.'/'.$ci_cip . '/' . CONFIG_FILENAME,'error');
          return;
      }
  }
  //Copy install.xml with Contrib Installer to right place:
  if (@!copy(DIR_FS_ADMIN_FUNCTIONS.'/'.CONFIG_FILENAME, $contrib_dir.'/'.$ci_cip.'/'.CONFIG_FILENAME)) {
      $message->add(COULDNT_COPY_TO_TEXT. CONFIG_FILENAME,'error');
      return;
  }
  //Set permissions:
  if (is_dir($contrib_dir.'/'.$ci_cip))    chmod($contrib_dir.'/'.$ci_cip.'/', 0777);
  chmod($contrib_dir.'/'.$ci_cip.'/'.CONFIG_FILENAME, 0777);

  //Zip CI folder.
  define ('DIR_FS_CIP', $contrib_dir);
  require_once(DIR_FS_ADMIN_CLASSES.'ci_cip.class.php');
  $cip=new CIP ($ci_cip);
  $cip->pack_cip();
  chmod($contrib_dir.'/'.$ci_cip.'.zip', 0777);
  //Remove CI folder
  //If I remove this folder post notes will not appear and CI is not listed as installed.
  //ci_remove($contrib_dir.'/'.$ci_cip);
}
?>