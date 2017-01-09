<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Get path to file from include_path
 *
 * @param string $file_path
 * @param string $new_file_path
 * @return boolean
 * @staticvar array|null
 */

//  $file_path, &$new_file_path

function smarty_core_get_include_path(&$params, &$smarty) {
    global $TPL_PATH;

    $pa = explode(PATH_SEPARATOR, $TPL_PATH );
    foreach ($pa as $ip) {
        if (file_exists($ip . DIRECTORY_SEPARATOR . $params['file_path'])) {
               $params['new_file_path'] = $ip . DIRECTORY_SEPARATOR . $params['file_path'];
            return true;
        }
    }
    return false;
}

/* vim: set expandtab: */

?>
