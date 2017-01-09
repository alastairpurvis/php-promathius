<?php
/*
  $Id: information.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
                                   function createSubNavs ($ls)
                                    {
                                        global $languages_id;
                                        // We are asked to show only a specific category
                            $product_info_query = tep_db_query("select  p.products_id, pd.products_name, p2c.categories_id, p.products_status, pd.language_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and p2c.categories_id = '".$ls."' and pd.language_id = '" . (int)$languages_id . "'");
                            //$product_info = tep_db_fetch_array($product_info_query);
                           while ($product_info = tep_db_fetch_array($product_info_query))
                           {
                       $products[$product_info['products_id']] = array('name' => $product_info['products_name'],
                                                                       'id' => $product_info['products_id']);
                                        }

                                       foreach($products as $id => $value){
                                       ?>
                                        <tr>
                                            <td class="subnavMainOff" onmouseover="SetBgOn(this);" onmouseout="SetBgOff(this);"><a href="<? echo tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$id]['id']); ?>" class="sideNavMainLink"><?echo $products[$id]['name'];?></a></td>
                                        </tr>             

                                       <?
                                       } 
                                    }

?>

<table cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="193" valign="top">
                            <table cellpadding="0" cellspacing="0" width="193">

                                <tr>
                                    <td><img alt="Skincare Products" src="images/leftnav/SideNav_01.jpg" onmouseover="ShowMenu(0);" /></td>
                                </tr>
                                <tr>
                                    <td><img alt="Advanced Peptide Therapy" src="images/leftnav/SideNav_02.jpg" onmouseover="ShowMenu(1);" border="0" /></td>
                                </tr>
                                <tr>
                                    <td><img alt="Nutrissentials" src="images/leftnav/SideNav_03.jpg" onmouseover="ShowMenu(2);" border="0" /></td>
                                </tr>

                                <tr>
                                    <td><a href="<? echo tep_href_link(FILENAME_RANGES, 'cPath=25')?>"><img alt="Cell CPR" src="images/leftnav/SideNav_12.jpg" border="0" /></a></td>
                                </tr>
                                <tr>
                                    <td><img alt="Bodycare Products" src="images/leftnav/SideNav_04.jpg" onmouseover="ShowMenu(0);" /></td>
                                </tr>
                                <tr>
                                    <td><img alt="Body Beautiful" src="images/leftnav/SideNav_05.jpg" onmouseover="ShowMenu(3);" border="0" /></td>
                                </tr>

                                <tr>
                                    <td><img alt="Supplements" src="images/leftnav/SideNav_06.jpg" onmouseover="ShowMenu(0);" /></td>
                                </tr>
                                <tr>
                                    <td><img alt="Body Beautiful Nutrition" src="images/leftnav/SideNav_07.jpg" onmouseover="ShowMenu(4);" border="0" /></td>
                                </tr>
                                <tr>
                                    <td><img src="images/leftnav/SideNav_08.jpg" onmouseover="ShowMenu(0);" border="0" /></td>
                                </tr>

                                <tr>
                                    <td><a href="<? echo tep_href_link(FILENAME_SSOLUTIONS)?>"><img alt="Skin Solutions" src="images/leftnav/SideNav_11.jpg" border="0" /></a></td>
                                </tr>
                            </table>

                            </td>
                            <td width="5"><img src="images/pxl-trans.gif" width="5" height="1" /></td>
                            <td valign="top" width="773">
                            <div style="position: relative;">
                            <div class="Sub" id="Menu_01" style="display: none; position: absolute; top: 0px; left: 0px; z-index: 99; height: 296px; width: 193px;">

                            <table cellpadding="0" cellspacing="0" width="193" height="276">
                                <tr>
                                    <td class="subnavTitle">Advanced Peptide Therapy</td>
                                </tr>
                                <tr>
                                    <td height="5" class="subnavMain"><img src="images/pxl-trans.gif" width="1" height="5" /></td>
                                </tr>
                                <tr>

                                    <td valign="top" class="subnavMain" onmouseover="ShowMenu(1);" onmouseout="ShowMenu(0);">
                                    <table cellpadding="0" cellspacing="0" width="193">
                                    <? createSubNavs (21); ?>
                                    </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="13"><img src="images/subnav/bottom.gif" /></td>
                                </tr>

                            </table>
                            </div>
                            <div class="Sub" id="Menu_02" style="display: none; position: absolute; top: 0px; left: 0px; z-index: 99; height: 286px; width: 193px;">
                            <table cellpadding="0" cellspacing="0" width="193" height="286">
                                <tr>
                                    <td class="subnavTitle">Nutrissentials</td>
                                </tr>
                                <tr>

                                    <td height="5" class="subnavMain"><img src="images/pxl-trans.gif" width="1" height="5" /></td>
                                </tr>
                                <tr>
                                    <td valign="top" class="subnavMain" onmouseover="ShowMenu(2);" onmouseout="ShowMenu(0);">
                                    <table cellpadding="0" cellspacing="0" width="193">

                                    <table cellpadding="0" cellspacing="0" width="193">
                                        <? createSubNavs (22);?>

                                    </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="13"><img src="images/subnav/bottom.gif" /></td>
                                </tr>
                            </table>
                            </div>

                            <div class="Sub" id="Menu_03" style="display: none; position: absolute; top: 0px; left: 0px; z-index: 99; height: 286px; width: 193px;">
                            <table cellpadding="0" cellspacing="0" width="193" height="286">
                                <tr>
                                    <td class="subnavTitle">Body Beautiful</td>
                                </tr>
                                <tr>
                                    <td height="5" class="subnavMain"><img src="images/pxl-trans.gif" width="1" height="5" /></td>
                                </tr>

                                <tr>
                                    <td valign="top" class="subnavMain" onmouseover="ShowMenu(3);" onmouseout="ShowMenu(0);">
                                    <table cellpadding="0" cellspacing="0" width="193">
                                        <? createSubNavs (23);?>

                                    </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="13"><img src="images/subnav/bottom.gif" /></td>
                                </tr>
                            </table>
                            </div>

                            <div class="Sub" id="Menu_04" style="display: none; position: absolute; top: 0px; left: 0px; z-index: 99; height: 286px; width: 193px;">
                            <table cellpadding="0" cellspacing="0" width="193" height="286">
                                <tr>
                                    <td class="subnavTitle">Body Beautiful Nutrition</td>
                                </tr>
                                <tr>
                                    <td height="5" class="subnavMain"><img src="images/pxl-trans.gif" width="1" height="5" /></td>
                                </tr>

                                <tr>
                                    <td valign="top" class="subnavMain" onmouseover="ShowMenu(4);" onmouseout="ShowMenu(0);">
                                    <table cellpadding="0" cellspacing="0" width="193">
                                        <? createSubNavs (24);?>
                                    </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="13"><img src="images/subnav/bottom.gif" /></td>
                                </tr>
                            </table>
                            </div>

                            <div class="Sub" id="Menu_05" style="display: none; position: absolute; top: 0px; left: 0px; z-index: 99; height: 286px; width: 193px;">
                            <table cellpadding="0" cellspacing="0" width="193" height="286">
                                <tr>
                                    <td class="subnavTitle">Skin Solutions</td>
                                </tr>
                                <tr>
                                    <td height="5" class="subnavMain"><img src="images/pxl-trans.gif" width="1" height="5" /></td>
                                </tr>


                                <tr>

                                    <td height="13"><img src="images/subnav/bottom.gif" /></td>
                                </tr>
                            </table>
                            </div>





<!-- information //-->
 
<?php

  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_INFORMATION);

  //new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $info_box_contents[] = array('text' => '<a href="' . tep_href_link(FILENAME_ABOUT) . '">' . 'About' . '</a><br>' . 
                                        '<a href="' . tep_href_link(FILENAME_SHIPPING) . '">' . BOX_INFORMATION_SHIPPING . '</a><br>' .
                                         '<a href="' . tep_href_link(FILENAME_PRIVACY) . '">' . BOX_INFORMATION_PRIVACY . '</a><br>' .
                                         '<a href="' . tep_href_link(FILENAME_CONDITIONS) . '">' . BOX_INFORMATION_CONDITIONS . '</a><br>' .
                                         '<a href="' . tep_href_link(FILENAME_CONTACT_US) . '">' . BOX_INFORMATION_CONTACT . '</a>');

 // new infoBox($info_box_contents);
?>

<!-- information_eof //-->
