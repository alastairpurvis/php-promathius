<?php
/*
  $Id: index.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// the following cPath references come from application_top.php
  $category_depth = 'top';
  if (isset($cPath) && tep_not_null($cPath)) {
    $categories_products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
    $cateqories_products = tep_db_fetch_array($categories_products_query);
    if ($cateqories_products['total'] > 0) {
      $category_depth = 'products'; // display products
    } else {
      $category_parent_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$current_category_id . "'");
      $category_parent = tep_db_fetch_array($category_parent_query);
      if ($category_parent['total'] > 0) {
        $category_depth = 'nested'; // navigate through the categories
      } else {
        $category_depth = 'products'; // category has no products, but display the 'no products' message
      }
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<script language="javascript" type="text/javascript" src="scripts/jquery.js"></script>
<script language="javascript" type="text/javascript" src="scripts/partners.js"></script>
    <script language="javascript" type="text/javascript" src="scripts/easySlider1.5.js"></script>
    <script language=javascript type="text/javascript">
        $(document).ready(function() {
            $("#slider").easySlider({
                auto: true,
                continuous: true

            });
        });
    </script>
<link rel="stylesheet" type="text/css" href="stylesheet2.css">
</head>
<body onload="StartSlideshow();StartPartnerSlideshow();" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<script language="javascript" type="text/javascript">
    var startDiv = "";
    var endDiv = "";

    function StartSlideshow()
    {
        if(endDiv == "Banner2")
        {
            startDiv = "Banner2";
            endDiv = "Banner3";
            setTimeout("GetNextBanner('" + startDiv + "', '" + endDiv + "', 10, 0)",7000);
        }
        else if(endDiv == "Banner3")
        {
            startDiv = "Banner3";
            endDiv = "Banner4";
            setTimeout("GetNextBanner('" + startDiv + "', '" + endDiv + "', 10, 0)",7000);
        }
        else if(endDiv == "Banner4")
        {
            startDiv = "Banner4";
            endDiv = "Banner1";
            setTimeout("GetNextBanner('" + startDiv + "', '" + endDiv + "', 10, 0)",7000);
        }
        else if(endDiv == "Banner1")
        {
            startDiv = "Banner1";
            endDiv = "Banner2";
            setTimeout("GetNextBanner('" + startDiv + "', '" + endDiv + "', 10, 0)",7000);
        }
        else
        {
            startDiv = "Banner1";
            endDiv = "Banner2";
            setTimeout("GetNextBanner('" + startDiv + "', '" + endDiv + "', 10, 0)",7000);
        }
    }

    function GetNextBanner(fadefrom, fadeto, start, end)
    {
        var fromStart = 0;
        var toStart = 0;

        if(start != 0)
        {
            document.getElementById(fadefrom).style.display = "";
            document.getElementById(fadeto).style.display = "none";

            fromStart = start - 1;

            document.getElementById(fadefrom).style.filter = "alpha(opacity=" + fromStart + "0)";
            document.getElementById(fadefrom).style.opacity = "0." + fromStart;
            document.getElementById(fadefrom).style.MozOpacity = "0." + fromStart;

            setTimeout("GetNextBanner('" + fadefrom + "', '" + fadeto + "', " + fromStart + ", " + toStart + ")",40);
        }
        else if(end != 10)
        {   
            document.getElementById(fadefrom).style.display = "none";
            document.getElementById(fadeto).style.display = "";

            toStart = end + 1;

            if(toStart < 10)
            {
                document.getElementById(fadeto).style.filter = "alpha(opacity=" + toStart + "0)";
                document.getElementById(fadeto).style.opacity = "0." + toStart;
                document.getElementById(fadeto).style.MozOpacity = "0." + toStart;   
            }
            else
            {
                document.getElementById(fadeto).style.filter = "alpha(opacity=100)";
                document.getElementById(fadeto).style.opacity = "1.0";
                document.getElementById(fadeto).style.MozOpacity = "1.0";
            }

            setTimeout("GetNextBanner('" + fadefrom + "', '" + fadeto + "', 0, " + toStart + ")",40);
        }   
        else
        { 

            document.getElementById(fadefrom).style.display = "none";
            document.getElementById(fadeto).style.display = ""; 
            StartSlideshow(); 
        }
    }
</script>
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
<td>

<?php
  if ($category_depth == 'nested') {
    $category_query = tep_db_query("select cd.categories_name, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");
    $category = tep_db_fetch_array($category_query);
?>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . $category['categories_image'], $category['categories_name'], HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
<?php
    if (isset($cPath) && strpos('_', $cPath)) {
// check to see if there are deeper categories within the current category
      $category_links = array_reverse($cPath_array);
      for($i=0, $n=sizeof($category_links); $i<$n; $i++) {
        $categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
        $categories = tep_db_fetch_array($categories_query);
        if ($categories['total'] < 1) {
          // do nothing, go through the loop
        } else {
          $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
          break; // we've found the deepest category the customer is in
        }
      }
    } else {
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
    }

    $number_of_categories = tep_db_num_rows($categories_query);

    $rows = 0;
    while ($categories = tep_db_fetch_array($categories_query)) {
      $rows++;
      $cPath_new = tep_get_path($categories['categories_id']);
      $width = (int)(100 / MAX_DISPLAY_CATEGORIES_PER_ROW) . '%';
      echo '                <td align="center" class="smallText" width="' . $width . '" valign="top"><a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">' . tep_image(DIR_WS_IMAGES . $categories['categories_image'], $categories['categories_name'], SUBCATEGORY_IMAGE_WIDTH, SUBCATEGORY_IMAGE_HEIGHT) . '<br>' . $categories['categories_name'] . '</a></td>' . "\n";
      if ((($rows / MAX_DISPLAY_CATEGORIES_PER_ROW) == floor($rows / MAX_DISPLAY_CATEGORIES_PER_ROW)) && ($rows != $number_of_categories)) {
        echo '              </tr>' . "\n";
        echo '              <tr>' . "\n";
      }
    }

// needed for the new products module shown below
    $new_products_category_id = $current_category_id;
?>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td><?php include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<?php
  } elseif ($category_depth == 'products' || isset($HTTP_GET_VARS['manufacturers_id'])) {
// create column list
    $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
                         'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
                         'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER,
                         'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE,
                         'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY,
                         'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT,
                         'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE);

    asort($define_list);

    $column_list = array();
    reset($define_list);
    while (list($key, $value) = each($define_list)) {
      if ($value > 0) $column_list[] = $key;
    }

    $select_column_list = '';

    for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
      switch ($column_list[$i]) {
        case 'PRODUCT_LIST_MODEL':
          $select_column_list .= 'p.products_model, ';
          break;
        case 'PRODUCT_LIST_NAME':
          $select_column_list .= 'pd.products_name, ';
          break;
        case 'PRODUCT_LIST_MANUFACTURER':
          $select_column_list .= 'm.manufacturers_name, ';
          break;
        case 'PRODUCT_LIST_QUANTITY':
          $select_column_list .= 'p.products_quantity, ';
          break;
        case 'PRODUCT_LIST_IMAGE':
          $select_column_list .= 'p.products_image, ';
          break;
        case 'PRODUCT_LIST_WEIGHT':
          $select_column_list .= 'p.products_weight, ';
          break;
      }
    }

// show the products of a specified manufacturer
    if (isset($HTTP_GET_VARS['manufacturers_id'])) {
      if (isset($HTTP_GET_VARS['filter_id']) && tep_not_null($HTTP_GET_VARS['filter_id'])) {
// We are asked to show only a specific category
        $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$HTTP_GET_VARS['filter_id'] . "'";
      } else {
// We show them all
        $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "'";
      }
    } else {
// show the products in a given categorie
      if (isset($HTTP_GET_VARS['filter_id']) && tep_not_null($HTTP_GET_VARS['filter_id'])) {
// We are asked to show only specific catgeory
        $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$HTTP_GET_VARS['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "'";
      } else {
// We show them all
        $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "'";
      }
    }

    if ( (!isset($HTTP_GET_VARS['sort'])) || (!ereg('^[1-8][ad]$', $HTTP_GET_VARS['sort'])) || (substr($HTTP_GET_VARS['sort'], 0, 1) > sizeof($column_list)) ) {
      for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
        if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
          $HTTP_GET_VARS['sort'] = $i+1 . 'a';
          $listing_sql .= " order by pd.products_name";
          break;
        }
      }
    } else {
      $sort_col = substr($HTTP_GET_VARS['sort'], 0 , 1);
      $sort_order = substr($HTTP_GET_VARS['sort'], 1);

      switch ($column_list[$sort_col-1]) {
        case 'PRODUCT_LIST_MODEL':
          $listing_sql .= " order by p.products_model " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_NAME':
          $listing_sql .= " order by pd.products_name " . ($sort_order == 'd' ? 'desc' : '');
          break;
        case 'PRODUCT_LIST_MANUFACTURER':
          $listing_sql .= " order by m.manufacturers_name " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_QUANTITY':
          $listing_sql .= " order by p.products_quantity " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_IMAGE':
          $listing_sql .= " order by pd.products_name";
          break;
        case 'PRODUCT_LIST_WEIGHT':
          $listing_sql .= " order by p.products_weight " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_PRICE':
          $listing_sql .= " order by final_price " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
      }
    }
?>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">

<?php
// optional Product List Filter
    if (PRODUCT_LIST_FILTER > 0) {
      if (isset($HTTP_GET_VARS['manufacturers_id'])) {
        $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where p.products_status = '1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p2c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' order by cd.categories_name";
      } else {
        $filterlist_sql= "select distinct m.manufacturers_id as id, m.manufacturers_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by m.manufacturers_name";
      }
      $filterlist_query = tep_db_query($filterlist_sql);
      if (tep_db_num_rows($filterlist_query) > 1) {
        echo '            <td align="center" class="main">' . tep_draw_form('filter', FILENAME_DEFAULT, 'get') . TEXT_SHOW . '&nbsp;';
        if (isset($HTTP_GET_VARS['manufacturers_id'])) {
          echo tep_draw_hidden_field('manufacturers_id', $HTTP_GET_VARS['manufacturers_id']);
          $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
        } else {
          echo tep_draw_hidden_field('cPath', $cPath);
          $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
        }
        echo tep_draw_hidden_field('sort', $HTTP_GET_VARS['sort']);
        while ($filterlist = tep_db_fetch_array($filterlist_query)) {
          $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
        }
        echo tep_draw_pull_down_menu('filter_id', $options, (isset($HTTP_GET_VARS['filter_id']) ? $HTTP_GET_VARS['filter_id'] : ''), 'onchange="this.form.submit()"');
        echo tep_hide_session_id() . '</form></td>' . "\n";
      }
    }

// Get the right image for the top-right
    $image = DIR_WS_IMAGES . 'table_background_list.gif';
    if (isset($HTTP_GET_VARS['manufacturers_id'])) {
      $image = tep_db_query("select manufacturers_image from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "'");
      $image = tep_db_fetch_array($image);
      $image = $image['manufacturers_image'];
    } elseif ($current_category_id) {
      $image = tep_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
      $image = tep_db_fetch_array($image);
      $image = $image['categories_image'];
    }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><?php include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING); ?></td>
      </tr>
    </table></td>
<?php
  } else { // default page
  $defaultpageshow = true;
?>
    <td>
    <table cellpadding="0" cellspacing="0" style="padding-bottom:20px">
    <tr>
    <td>
    <div style="z-index: 2;" id="Banner1">
<table cellpadding="0" cellspacing="0" width="773" height="276">
    <tr>
        <td valign="top">
            <img src="images/home/homepage_12.jpg" border="0" /></td>
        <td width="342"><img src="images/home/homepage_11.jpg" border="0" /></td>
    </tr>
</table>
</div>
<div style="display: none; z-index: 2;" id="Banner2">
<table cellpadding="0" cellspacing="0" width="773" height="276">
    <tr>
        <td valign="top" style="background: url('images/home/homepage_13.jpg'); width: 773px; height: 276px; padding-left: 372px; padding-top:191px">
      <div><a href="ProductOverview.aspx?id=6"><img src="images/buttons/learnmore.jpg" onmouseover="this.src='images/buttons/learnmore_o.jpg';" onmouseout="this.src='images/buttons/learnmore.jpg';" border="0" /></a></div>
    </td>
    </tr>
</table>
</div>
<div style="display: none;" id="Banner3">
<table cellpadding="0" cellspacing="0" width="773" height="276">
    <tr>
        <td valign="top" style="background-image: url('images/home/homepage_03.jpg'); padding: 115px 140px 0px 30px;">
        <h2>Meet your body's NBF's</h2>
        <p>Skin Nutrition Body Beautiful is a range of technologically-advanced body care products that provide a synergistic holistic wellness program for the whole body..</p>
        <p><a href="ProductOverview.aspx?id=2"><img src="images/buttons/learnmore.jpg" onmouseover="this.src='images/buttons/learnmore_o.jpg';" onmouseout="this.src='images/buttons/learnmore.jpg';" border="0" /></a></p>
        </td>
        <td width="353"><img src="images/home/homepage_04.jpg" /></td>
    </tr>
</table>
</div>
<div style="display: none;" id="Banner4">
<table cellpadding="0" cellspacing="0" width="773" height="276">
    <tr>
        <td width="470"><img src="images/home/homepage_05.jpg" /></td>
        <td valign="top" style="background-image: url('images/home/homepage_06.jpg'); padding: 115px 35px 0px 0px;">
        <h2>Skin Supplements</h2>
        <p>Our unique range of skin supplements are designed to help fight the visible signs of aging at a cellular level. Looking good starts from the inside out..</p>
        <p><a href="ProductOverview.aspx?id=3"><img src="images/buttons/learnmore.jpg" onmouseover="this.src='images/buttons/learnmore_o.jpg';" onmouseout="this.src='images/buttons/learnmore.jpg';" border="0" /></a></p>
        </td>
    </tr>
</table>
</div>
</td>
</tr>
  </tr>
</table>
</td></tr>
</table>
<TABLE cellpadding="0" cellspacing="0" style="padding-top:20px">
                <tr>
                    <td>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td valign="top" style="width: 193px; height: 192px; background: url('images/home/Homepage_07.jpg') no-repeat 0px 0px; padding:43px 0 0 7px;">

                            <div id="slider">
                            <ul>
                                <li><a href="Products.aspx?range=7"><img src="images/specials/specials04b.jpg" border="0" /></a></li>				
                                <li><a href="Products.aspx?range=7"><img src="images/specials/specials01a.jpg" border="0" /></a></li>
                                <li><a href="Products.aspx?range=7"><img src="images/specials/specials01b.jpg" border="0" /></a></li>
                                <li><a href="Products.aspx?range=7"><img src="images/specials/specials02a.jpg" border="0" /></a></li>
                                <li><a href="Products.aspx?range=7"><img src="images/specials/specials02b.jpg" border="0" /></a></li>
                                <li><a href="Products.aspx?range=7"><img src="images/specials/specials03a.jpg" border="0" /></a></li>
                                <li><a href="Products.aspx?range=7"><img src="images/specials/specials03b.jpg" border="0" /></a></li>

                                <li><a href="Products.aspx?range=7"><img src="images/specials/specials04a.jpg" border="0" /></a></li>
                                <li><a href="Products.aspx?range=7"><img src="images/specials/specials04b.jpg" border="0" /></a></li>			
                            </ul>
                            </div>
                            </td>
                            <td valign="top" style="width: 527px; padding: 0px 21px 0px 21px; border-right: 1px solid #ecebea;">
                            <h1><a>TECHNOLOGICAL BREAKTHROUGH</a><br />A world first in skincare, exclusive to Skin Nutrition</h1>
                            <p style="width: 100%;">

                            Every decade or so something new comes along in the cosmetics market that really lights it up. This time the skin care market is about to witness the ‘Holy Grail’. Imagine a skin care product that is so intelligent it mimics our body’s own biological processes of making new skin cells.   Imagine a skin care product that every time you use it provides your skin with the identical elements of a new cell. Imagine a skin care product that counteracts the signs of the aging process and never slows down like our own biological processes do as we age. The imagining is almost over - <a href="/ProductOverview.aspx?id=6">Cell CPR</a> is now available for pre-order!
                            </p>
                            </td>
                            <td valign="top" style="width: 193px; padding: 0px 7px 0px 7px;">
                            <h1><a>GOOD READING</a><br />News Stories</h1>
                            <p>
<?
$number=4;
$template="Headlines";
$category=3;
$static=TRUE;
include("news/show_news.php");

?>
                            </p>
                            </td>
                        </tr>
                    </table>

                    </td>
                </tr>
                <tr>
                    <td><img src="}images/pxl-trans.gif" width="1" height="20" /></td>

                </tr>


                <tr>
                    <td>
                    <table cellpadding="0" cellspacing="0"">
                        <tr>

                            <td valign="top" width="276" style="padding: 0px 20px 0px 20px; border-right: 1px solid #e4e4e5;">
                            <h3>A UNIQUE APPROACH</h3>
                            <p style="width: 100%;">
                                Skin Nutrition is passionate about age reversal and to achieve optimal results 
                                we have developed a ground-breaking synergistic face, body and nutrition 
                                &quot;wellness&quot; concept utilising the latest bio-technologies</p>
                            <p><a href="<? ECHO tep_href_link(FILENAME_ABOUT); ?>" style="text-decoration: none;"><b>LEARN MORE</b></a></p>
                            </td>

                            <td valign="top" style="padding: 0px 20px 0px 20px; border-right: 1px solid #e4e4e5; width: 284px;">
                            <h3>TESTIMONIALS</h3>
                            <p>
                                Find out how women in our sample group felt after using Skin Nutrition for just six weeks. Let them 
                                tell you in their own words how their skin responded to the various Skin 
                                Nutrition products they tested...</p>
                            <p><a href="<? ECHO tep_href_link(FILENAME_BA); ?>" style="text-decoration: none;"><b>BEFORE &amp; AFTER PICS</b></a></p>
                            </td>

                            <td valign="top" style="padding: 0px 0px 0px 20px; width: 334px;">
                            <h3>OUR PARTNERS</h3>
                            <p>
                            <table cellpadding="0" cellspacing="0" width="316px">
                                <tr>
                                    <td class="default" valign="top" align="left" width="160px" style="padding-right: 10px;">Skin Nutrition is proud to be associated with the world’s most prestigious department stores, specialty stores, spas, and online retailers.</td>
                                    <td>
                                    <div style="position: relative; width: 146px; height: 77px; background-image: url('}images/home/bg.jpg');">

                                    <div style="position: absolute; top: 0px; left: 0px; z-index: 2;" id="Partner1"><a href="http://www.blissworld.com/" target="_blank"><img src="images/home/BlissMain.jpg" border="0" /></a></div>
                                    <div style="position: absolute; top: 0px; left: 0px; display: none;" id="Partner2"><a href="http://www.saksfifthavenue.com/" target="_blank"><img src="images/home/saks.jpg" border="0" /></a></div>
                                    <div style="position: absolute; top: 0px; left: 0px; display: none;" id="Partner3"><a href="http://www.selfridges.com/" target="_blank"><img src="images/home/selfridges.jpg" border="0" /></a></div>     
                                    <div style="position: absolute; top: 0px; left: 0px; display: none;" id="Partner4"><a href="http://www.davidjones.com.au/" target="_blank"><img src="images/home/davidjones.jpg" border="0" /></a></div>      
                                    <div style="position: absolute; top: 0px; left: 0px; display: none;" id="Partner5"><a href="http://www.rescu.com.au/" target="_blank"><img src="images/home/rescu.jpg" border="0" /></a></div>               
                                    <div style="position: absolute; top: 0px; left: 0px; display: none;" id="Partner6"><a href="http://www.emmalizs.com/" target="_blank"><img src="images/home/emmalizs.jpg" border="0" /></a></div>              
                                    <div style="position: absolute; top: 0px; left: 0px; display: none;" id="Partner7"><a href="http://www.fredsegal.com/" target="_blank"><img src="images/home/fredsegal.jpg" border="0" /></a></div>               
                                    <div style="position: absolute; top: 0px; left: 0px; display: none;" id="Partner8"><a href="http://www.treatthyself.com/" target="_blank"><img src="images/home/treat.jpg" border="0" /></a></div>                                     
                                    </div>
                                    </td>
                                </tr>
                            </table>

                            </p>
                            </td>
                        </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td><img src="}images/pxl-trans.gif" width="1" height="18" /></td>
                </tr>
</TABLE>

<?php
  }
  if(! $defaultpageshow)
  {
?>
  </tr>
</table>
<?}?>
</td></tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
