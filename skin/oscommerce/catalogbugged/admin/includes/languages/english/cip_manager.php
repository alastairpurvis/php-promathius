<?php
/*
  cip_manager.php
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2002 osCommerce
  Released under the GNU General Public License
*/

define('HEADING_TITLE', '<ABBR  title="Contrib Installer Package">CIP</ABBR> Manager');

define('TABLE_HEADING_FILENAME', 'Name');
define('TABLE_HEADING_SIZE', 'Size');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_HEADING_UPLOAD', 'Upload');
define('TEXT_FILE_NAME', 'Filename:');
define('TEXT_FILE_SIZE', 'Size:');
define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this file?');


define('ERROR_DIRECTORY_NOT_WRITEABLE', 'Error: I can not write to this directory. Please set the right user permissions on: %s');
define('ERROR_FILE_NOT_WRITEABLE', 'Error: I can not write to this file. Please set the right user permissions on: %s');
define('ERROR_DIRECTORY_NOT_REMOVEABLE', 'Error: I can not remove this directory. Please set the right user permissions on: %s');
define('ERROR_FILE_NOT_REMOVEABLE', 'Error: I can not remove this file. Please set the right user permissions on: %s');
define('ERROR_DIRECTORY_DOES_NOT_EXIST', 'Error: Directory does not exist: %s');
//======================
define('ICON_UNZIP', 'Unpack');
define('ICON_ZIP', 'Pack');
define('ICON_INSTALL', 'Install');
define('ICON_REMOVE', 'Remove');
define('ICON_WITHOUT_DATA_REMOVING', 'without data removing');
define('ICON_EMPTY', '');

define('ICON_INSTALLED_CURRENT_FOLDER', 'Current folder of CIP that has been installed');
define('ICON_INSTALLED_CURRENT_FOLDER', 'folder of CIP that has been installed');

//Uploader:
define('ERROR_FILE_ALREADY_EXISTS','File %s  <b>already exists</b>.');

define('TEXT_UPLOAD_INTRO', 'Please select the files to upload.');
define('TEXT_UPLOAD_LIMITS','Remember that you could upload only <b>ZIPs</b>, no more than <b>'.round(MAX_UPLOADED_FILESIZE/1024).'Kb</b> and only <b>Contrib Installer Packages</b>!');

//========================================
define('TEXT_INFO_SUPPORT', 'Support');
define('TEXT_INFO_CONTRIB', 'Contrib Info');
define('CONTRIBS_PAGE_ALT','Contributions official page on osCommerce site');
define('CONTRIBS_PAGE','Contrib\'s Page on osCommerce.org');

define('CONTRIBS_FORUM_ALT','Link to forum where you can get a support');
define('CONTRIBS_FORUM','Support Forum for contrib on osCommerce.org');

define('CIP_STATUS_REMOVED_ALT', 'CIP have NOT been installed');
define('CIP_STATUS_INSTALLED_ALT', 'CIP have been INSTALLED');

define('CIP_USES', 'CIP uses');
define('TEXT_DOESNT_EXISTS', ' doesn\'t exists');


//MESSAGES:
define('MSG_WAS_INSTALLED','CIP was installed!');
define('MSG_WAS_APPLIED',' was aplied!');
define('MSG_WAS_REMOVED','CIP was removed.');
define('TEXT_POST_INSTALL_NOTES','POST INSTALL NOTES');


?>