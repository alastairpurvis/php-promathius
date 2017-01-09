<?php
/*
  $Id: shipping.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ABOUT);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ABOUT));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet2.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
        <td valign="top" width="581" style="padding: 23px 50px 30px 50px;">
        <div id="ContentB_1">
        <h1>Overview</h1>
                <p>
                Skin Nutrition is a revolutionary skin care brand leading the way in bio-active skin care, specializing in innovative anti-aging, age reversal, acne, hyper-pigmentation, and skin rejuvenation treatments through patented and cutting edge bio-technologies, and a pioneering ‘outside-in & inside-out’ methodology.   
        </p><p>
        Most of today’s skin care products use a generic approach for “dry,” “oily,” or “combination” skin types, one that merely cleanses and moisturizes the epidermis. These products do not address the source of premature internal aging, and have little to no effect on the surface where damage manifests itself by way of wrinkles, loss of elasticity, and pigmentation disorders.
        </p><p>
        Skin Nutrition takes a radically different, bilateral approach to skin care; combining technologically advanced topically applied products that penetrate the epidermis to work from the ‘outside-in’ and proprietary nutritional supplements that work from the ’inside-out’.
        </p><p>
        This synergistic strategy reverses cellular inflammation and glycation internally where premature ageing starts, stimulates cell and fibroblast reparation and renewal, and repairs and reverses the visible signs of ageing on the surface of the skin.
        </p><p>

        Using patented technologies, nano-encapsulated biotechnologically-engineered ingredients, combined with the most potent botanical extracts from nature, Skin Nutrition’s skin care topicals penetrate the epidermal layer of the skin to support cellular optimization from the outside in, while the nutritional supplements promote the same function from the inside out, resulting in healthier, younger-looking skin.
                </p>
        </div>
        <div id="ContentB_2" style="display: none;">

        <h1>Management</h1>
        <p>
        <strong>Richard Purvis</strong><br />
        <em>President and Chief Executive Officer</em>
        </p>
        <p>
        Mr. Purvis was born, raised and educated in Los Angeles, California . He has extensive international trading, marketing, sales, development and business management experience in fast moving consumer goods, nutritional supplements and skin care products. He has been involved with the development and launches of many new products in the US and South Africa and has either founded or managed a number of successful companies including Nutrimax, R&B Trading, Growers Foods SA, and Food Flair Pty Ltd.
        </p>

        <p>
        <strong>John Knowlton</strong><br />
        <em>Vice President Research &amp; Development<br />C.Chem, MRSC, Dip. Cos. Sci. (GB) </em>
        </p>
        <p>
        Mr. Knowlton C.Chem, MRSC, Dip. Cos. Sci. (GB) joined Johnson & Johnson in 1984 where he held the position of Principal Scientist Southern Europe. In 1995, he relocated to South Africa to join Justine Skin Care as Technical Director and, following the acquisition of this company by the AVON Corporation in 1996, he held the position of Vice President of Research & Development. In 1998 Mr. Knowlton founded, Cosmetic Solutions, which specialises in providing a wide range of advisory and development services in all categories of cosmetics. Extra curricularly, he held the position of President of the British Society of Cosmetic Scientists in 1992 and President of the South African Society of Cosmetic Chemists in 1999. He is also the author of many papers and articles on cosmetics and has spoken extensively at many conferences in various parts of the world. 
        </p>

        <p>
        <strong>Joanne Purvis</strong><br />
        <em>Vice President Sales &amp; Marketing</em>
        </p>
        <p>
        Ms. Purvis was born in the United Kingdom and raised and educated in both the UK and South Africa . After gaining 15 years of extensive experience in the sales, marketing, distribution and promotional field, (namely through the Coca Cola Bottlers (ABI), Appletiser SA, Valpre Spring Water and Pharmaceutical company Adcock Ingram), she was responsible for co-founding the Skin Nutrition brand as Brand Manager, along with CEO, Richard Purvis.
        </p>

        </div>
        </td>
        <td valign="top" width="192" style="border-left: 1px solid #e8e9ea;">
        <table cellpadding="0" cellspacing="0" width="192" align="right">
            <tr>
                <td width="10"><img src="}images/pxl-trans.gif" width="10" height="1" /></td>
                <td>
                <table cellpadding="0" cellspacing="0" width="182">

                    <tr>
                        <td height="25" style="border-bottom: 1px solid #5fa9ca; padding-left: 5px;" class="header" valign="top"><strong>SKIN NUTRITION</strong></td>
                    </tr>
                    <tr>
                        <td><img src="}images/pxl-trans.gif" width="1" height="6" /></td>
                    </tr>
                    <tr>
                        <td class="rightNav" style="padding-left: 5px;">

                        <a href="javascript:showBody(1);" id="RightB_1" class="active">Overview</a><br />
                        <a href="javascript:showBody(2);" id="RightB_2" class="inactive">Management</a><br />
                        <a href="javascript:showSection(1);" id="Right_1" class="inactive">Registered Details</a><br />
                        <div id="Content_1" style="display: none;"><strong>Skin Nutrition International</strong><br />State of Incorporation: Colorado<br />SEC CIK Number: 0001349879<br />Date of fiscal year-end: 12/31</div>
                        <a href="javascript:showSection(2);" id="Right_2" class="inactive">Address</a><br />

                        <div id="Content_2" style="display: none;">410 Park Avenue<br />15th Floor<br />New York, NY 10022</div>
                        <a href="javascript:showSection(3);" id="Right_3" class="inactive">Transfer Agent</a><br />
                        <div id="Content_3" style="display: none;">Corporate Stock Transfer<br />3200 Cherry Creek Drive South<br />Suite 430, Denver, Colorado 80209</div>
                        <a href="javascript:showSection(4);" id="Right_4" class="inactive">Legal Counsel</a><br />
                        <div id="Content_4" style="display: none;">Sichenzia Ross Friedman Ference LLP<br />61 Broadway<br />New York, NY 10006</div>

                        <a href="javascript:showSection(5);" id="Right_5" class="inactive">Auditors</a><br />
                        <div id="Content_5" style="display: none;">Kempisty &amp; Company Certified Public Accountants, P.C.<br />15 Maiden Lane<br />Suite 1003<br />New York<br />NY 10038</div>
                        <a href="javascript:showSection(6);" id="Right_6" class="inactive">Accountants</a><br />
                        <div id="Content_6" style="display: none;">KBL Certified Public Accountants &amp; Advisors<br />110 Wall Street<br />11th Floor<br />New York<br />NY 10005 </div>

                        <a href="javascript:showSection(7);" id="Right_7" class="inactive">Investors</a><br />
                        <div id="Content_7" style="display: none;">
                        <strong>Select an option</strong><br />
                        <a href="http://www.sec.gov/cgi-bin/browse-edgar?company=skin+nutrition&CIK=&filenum=&State=&SIC=&owner=include&action=getcompany" target="_blank" class="inactive">EDGAR Filings</a><br />
                        <a href="http://www.nasdaq.com/" target="_blank" class="inactive">Stock Info</a><br />
                        <a href="About.aspx?S=Request" class="inactive">Request Info</a><br />
                        <a href="<? ECHO tep_href_link(FILENAME_NEWS) ?>&page=pressreleases" class="inactive">Press Releases</a>
                        </div>
                        </td>
                    </tr>
                </table>

                </td>
            </tr>
        </table>
        </td>
    </tr>
</table>
</div>




</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
