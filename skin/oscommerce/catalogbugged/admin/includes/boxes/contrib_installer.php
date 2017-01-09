<?php
/*
  contrib_installer.php
  Released under the GNU General Public License
*/
?>
<!-- contrib_installer //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_CONTRIB_INSTALLER,
                     'link'  => tep_href_link(FILENAME_CIP_MANAGER, 'selected_box=contrib_installer'));

  if ($selected_box == 'contrib_installer') {
    $contents[] = array('text' =>
    '<a href="'.tep_href_link(FILENAME_CIP_MANAGER).'" class="menuBoxContentLink">'.
            BOX_CONTRIB_INSTALLER_CIP_MANAGER.'</a><br>'.
    '<a href="'.tep_href_link(FILENAME_CIP_MANAGER, 'action=upload&goto='.DIR_FS_CIP).'"
            class="menuBoxContentLink">'. BOX_CONTRIB_INSTALLER_UPLOAD_CIP.'</a><br>'.
    '<a href="http://cip.net.ua/" class="menuBoxContentLink" title="Support on CIP.NET.UA">CIP.NET.UA</a><br>');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- contrib_installer_eof //-->
