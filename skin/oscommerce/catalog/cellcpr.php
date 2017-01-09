<?php
/*
  $Id: shipping.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CELLCPR);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CELLCPR));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE . ' - Cell CPR Ingredients'; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet2.css">
<? include ('includes/headertags.php'); ?>
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
    <td width="100%" valign="top" style="padding-top: 30px; padding-left: 30px; padding-right: 60px;"><table border="0" width="100%" cellspacing="0" cellpadding="0">
<script language="javascript" type="text/javascript">
    function getSection(id) {
        for (var i = 1; i <= 10;  i++) {
            eval("document.getElementById('ingredients_" + i + "')").style.display = "none";
            eval("document.getElementById('link_" + i + "')").className = "off";
        }

        eval("document.getElementById('ingredients_" + id + "')").style.display = "";
        eval("document.getElementById('link_" + id + "')").className = "on";
    }
</script>

        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top" style="width: 130px; padding-top: 28px;">
                <ul class="subnav">
                    <li class="title">INGREDIENTS</li>
                    <li><a href="javascript:getSection(1)" id="link_1" class="on">Renovasyn&trade;</a></li>
                    <li><a href="javascript:getSection(2)" id="link_2" class="off">SN-SC&trade;</a></li>

                    <li><a href="javascript:getSection(3)" id="link_3" class="off">Crylasine</a></li>
                    <li><a href="javascript:getSection(4)" id="link_4" class="off">Peptipeel</a></li>
                    <li><a href="javascript:getSection(5)" id="link_5" class="off">Ilumisine</a></li>
                    <li><a href="javascript:getSection(6)" id="link_6" class="off">Triphaxyl</a></li>
                    <li><a href="javascript:getSection(7)" id="link_7" class="off">Trephanine</a></li>
                    <li><a href="javascript:getSection(8)" id="link_8" class="off">NMF</a></li>

                    <li><a href="javascript:getSection(9)" id="link_9" class="off">O2 Catalyst</a></li>
                    <li>
                        <a href="javascript:getSection(10)" id="link_10" class="off">Skin Illustration
                        <img src="images/illustrationcellcpr.jpg" border="0" /></a>
                    </li>
                </ul>
                </td> 
                <td width="30">&nbsp;</td>       
                <td valign="top">
                    <table cellpadding="0" cellspacing="0" width="100%"e><td><h1>Our Proprietory Ingredients</h1></td>
                    <td><a class="inactive" href="javascript:history.back(-1)"><< Back</a></td></table>

                    <div id="ingredients_1">
                    <h2>Renovasyn&trade;</h2>
                    <ul class="plus">
                        <li><strong>Phytosterols</strong> - plant sterols that support the renewal of the skin's natural protective layer.</li>
                        <li><strong>Omega Plankton</strong> - High quality source of Omega 3 and EPAs and DHAs. Combats inflammation by reducing the NO (Nitric Oxide) radical, stimulates Ceramides, rebuilds the skin's natural protection, and provides a lasting seal by increasing hydration of the epidermal layers.</li>

                        <li><strong>Photosphingosine</strong> - a lipid residing in the Stratum Corneum (the skin's outer-most layer) meant to protect internal organs from the outside environment. When it is damaged it is not able to function correctly. The supplement of this in Cell-CPRT supports the biological function and is a key biochemical precursor (building block) for Ceramide 3, 6, and Phytoceramide 1, which all improve skin barrier function.</li>
                        <li><strong>Ceramide-2, 3 &amp; 4</strong> - protects and repairs the barrier and inhibits melanin synthesis.</li>
                        <li><strong>ATP</strong> (Adenosine Triphosphate) - a bioactive complex to provide energy for the cell. It has high water retention properties, improving skin moisture, wrinkle smoothing, and skin tightening. </li>

                        <li><strong>Polysaccharides</strong> - rapidly reduces the appearance of wrinkles and inhibits skin irritation. <br /><br />
                        <span>* Proprietary ingredients and registered trademarks of Skin Nutrition.<br />All of the Ingredient copy is the exclusive property of Skin Nutrition and is protected under the copyright laws of the USA and the EU.</span>
                        </li>
                    </ul>
                    </div>
                    <div id="ingredients_2" style="display: none;">

                    <h2>SN-SC&trade;</h2>
                    <ul class="plus">
                        <li><strong>Skin Nutrition Stem Cell Complex </strong> - a plant stem cell to protect and stimulate our skin stem cells. Protects cell longevity and the cell against UV damage.<br /><br />

                        <span>*Proprietary ingredients and registered trademarks of Skin Nutrition.<br />All of the Ingredient copy is the exclusive property of Skin Nutrition and is protected under the copyright laws of the USA and the EU.</span>
                        </li>
                    </ul>

                    </div>
                    <div id="ingredients_3" style="display: none;">
                    <h2>Crylasine - <span style="font-weight:normal;">A proprietary blend of EGF and FGF</span> </h2> 
                    <ul class="plus">
                        <li><strong>EGF (Epidermal Growth Factor)</strong> - promotes epidermal cell proliferation.</li>
                        <li><strong>FGF (Fibroblast Growth Factor) </strong> - increases the synthesis of Collagen and Elastin;<br /> reduces and prevents lines and wrinkles by generating new skin cells.<br /><br />

                        <span>* Proprietary ingredients and registered trademarks of Skin Nutrition.<br />All of the Ingredient copy is the exclusive property of Skin Nutrition and is protected under the copyright laws of the USA and the EU.</span>
                        </li>
                    </ul>
                    </div>
                    <div id="ingredients_4" style="display: none;">
                    <h2>Peptipeel</h2>
                    <ul class="plus">

                        <li>A peptide that creates youthful skin by increasing the turnover of the Stratum Corneum (the skin's outermost layer) without thinning the skin like chemical peels and AHAs do with prolonged use.<br /><br />
                        <span>* Proprietary ingredients and registered trademarks of Skin Nutrition.<br />All of the Ingredient copy is the exclusive property of Skin Nutrition and is protected under the copyright laws of the USA and the EU.</span>
                        </li>
                    </ul>
                    </div>
                    <div id="ingredients_5" style="display: none;">
                    <h2>Ilumisine</h2>

                    <ul class="plus">
                        <li>A skin depigmentation and radiance boosting complex made up of unique plant extracts. The key function is tyrosinase inhibition, the enzyme responsible for melanin synthesis or melanogenesis as it is commonly referred.<br /><br />
                        <span>* Proprietary ingredients and registered trademarks of Skin Nutrition.<br />All of the Ingredient copy is the exclusive property of Skin Nutrition and is protected under the copyright laws of the USA and the EU.</span>
                        </li>
                    </ul>
                    </div>
                    <div id="ingredients_6" style="display: none;">

                    <h2>Triphaxyl</h2>
                    <ul class="plus">
                        <li>An amino acid complex designed to protect DNA and repair already damaged DNA as well as prevent and revere glycation.<br /><br />
                        <span>* Proprietary ingredients and registered trademarks of Skin Nutrition.<br />All of the Ingredient copy is the exclusive property of Skin Nutrition and is protected under the copyright laws of the USA and the EU.</span>
                        </li>
                    </ul>
                    </div>

                    <div id="ingredients_7" style="display: none;">
                    <h2>Trephanine</h2>
                    <ul class="plus">
                        <li><strong>Vitamin C </strong> - a stabilized super-hybrid lipid soluble form of vitamin C which delivers 50 times better than ascorbic acid (regular vitamin C). It reduces melanin synthesis, increases collagen synthesis, and is a great acne treatment.</li>
                        <li><strong>Hematite</strong> - a mineral from effusive magma rock in hydrothermal seams, which stimulates enzymatic activity inside the cell, increasing production of pro-collagen (a precursor to collagen).</li>

                        <li><strong>Rhodochrosite</strong> - a mineral first discovered by the Incas in the 13th century, has extraordinary cell protection capabilities as well as is necessary for the synthesis of proteins, haemoglobin, and lipids.</li>
                        <li><strong>SOD (superoxide dismutase) </strong> - an enzyme that is also a powerful anti-oxidant and anti-inflammatory that repairs cells and reduces the damage done to them by superoxide, the most common free radical in the body. Also provides environmental protection to the skin.</li>
                        <li><strong>Saccharomyces Ferment</strong> derived from yeast, provides powerful DNA and lipid barrier protection, as well as anti-wrinkle effects.<br /><br />
                        <span>* Proprietary ingredients and registered trademarks of Skin Nutrition.<br />All of the Ingredient copy is the exclusive property of Skin Nutrition and is protected under the copyright laws of the USA and the EU.</span>

                        </li>
                    </ul>
                    </div>
                    <div id="ingredients_8" style="display: none;">
                    <h2>NMF <span style="font-weight:normal;">(Natural Moisturizing Factors)</span></h2>
                    <ul class="plus">
                        <li><strong>Sodium PCA</strong> - a naturally occurring component of human skin residing in the epidermis for the purpose binding moisture to our cells. Ours is derived from plant sources and is a highly bioactive moisturizer, humectant, and emollient.</li>

                        <li><strong>Sodium Hyaluronate (Hyaluronic Acid)</strong> - occurs naturally in the deeper layers of our skin (the dermis). It helps to keep skin smooth and "plump" through its ability to hold up to 1,000 times its weight in water. Ours is derived from plant sources and is a powerful bioactive moisturizer, humectant, and emollient.</li>
                        <li><strong>Trehalose</strong> - a plant derived substance that has high water retention capabilities as well as the ability to bind moisture to our cells. Trehalose also has the ability to prevent glycation.<br /><br />
                        <span>* Proprietary ingredients and registered trademarks of Skin Nutrition.<br />All of the Ingredient copy is the exclusive property of Skin Nutrition and is protected under the copyright laws of the USA and the EU.</span>
                        </li>
                    </ul>

                    </div>
                    <div id="ingredients_9" style="display: none;">
                    <h2>O2 Catalyst </h2>
                    <ul class="plus">
                        <li>Perfluorocarbon, an organic compound, is a catalyst for oxygen. It increases oxygen and moisture levels in the skin as well as increases skin and cellular respiration.<br /><br />
                        <span>* Proprietary ingredients and registered trademarks of Skin Nutrition.<br />All of the Ingredient copy is the exclusive property of Skin Nutrition and is protected under the copyright laws of the USA and the EU.</span>
                        </li>

                    </ul>
                    </div>
                    <div id="ingredients_10" style="display: none;">
                    <h2>Skin Illustration</h2>
                        <img src="images/illustrationLarge.jpg" />
                    </div>
                </td>
            </tr>

        </table>

    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
