<?php
/*
  $Id: shipping.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_NEWS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_NEWS));
    $page = 'news';
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?> id="top">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE . ' - News'; ?></title>
<link rel="stylesheet" type="text/css" href="stylesheet2.css">
<? include ('includes/headertags.php'); ?>
<script language="javascript" type="text/javascript" src="scripts/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
        <td valign="top" width="581" style="padding: 23px 40px 30px 50px;">
        <?
         if (strtolower($_GET["page"]) == 'pressreleases')
         {  
                $category=2;
                $lspage=2;
         }
         elseif (strtolower($_GET["page"]) == 'pressclippings')
         {
                $category=1;
                $lspage=3;
         }
         else
         {
                $category=3;   
                $lspage=1; 
         }
         ?>
        
         <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding-right: 130px; text-align:justify">
          <tr>
            <td><h1 style="font-size: 26px;">News</h1></td></tr>
          </tr>
        </table>
        <?
                include('newsdir/show_news.php'); 
        ?>
        </td>
        <td valign="top" width="192" style="border-left: 0px solid #e8e9ea;">
        <table cellpadding="0" cellspacing="0" width="192" align="right">
            <tr>
                <td width="10"><img src="images/pxl-trans.gif" width="10" height="1" /></td>
                    <? if($showothernews){?>
                <td>
                <table cellpadding="0" cellspacing="0" width="182">

                    <tr>
                        <td height="25" style="border-bottom: 1px solid #5fa9ca; padding-left: 5px;" class="header" valign="top"><strong>SELECT A NEWS TYPE</strong></td>
                    </tr>
                    <tr>
                        <td><img src="images/pxl-trans.gif" width="1" height="6" /></td>
                    </tr>
                    <tr>
                        <td class="rightNav" style="padding-left: 5px;">
                 <?if(strpos(tep_href_link(FILENAME_NEWS), '?') !== false) $operator = '&'; else $operator = '?'; ?>
                        <a href="<? ECHO tep_href_link(FILENAME_NEWS) . $operator ?>page=news" class="<? if ($lspage == 1){ echo 'active';}else {echo 'inactive';}?>">News</a><br />
                        <a href="<? ECHO tep_href_link(FILENAME_NEWS) . $operator ?>page=pressreleases" class="<? if ($lspage == 2){ echo 'active';}else {echo 'inactive';}?>">Press Releases</a><br />
                        <a href="<? ECHO tep_href_link(FILENAME_NEWS) . $operator ?>page=pressclippings" class="<? if ($lspage == 3){ echo 'active';}else {echo 'inactive';}?>">Press Clippings</a><br />
                        </td>
                    </tr>
                </table>

                </td>
                    <?}?>
            </tr>
        </table>
        </td>
    </tr>
</table>
</div>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
