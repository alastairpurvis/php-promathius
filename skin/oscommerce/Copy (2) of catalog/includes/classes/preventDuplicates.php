<?php
/**
 * Google Duplicate Content Manager
 * 
 * oscommerce version compatability - MS-2.2, RC1, RC2, RC2a
 * PHP4/5, MySQL (No DB changes needed)
 * Adds title/meta to pages in order to cure duplicate title/meta problems
 * @package preventDuplicates.php
 * @link http://www.fwrmedia.co.uk/ FWR Media
 * @copyright Copyright 2008, FWR Media
 * @author Robert Fisher
 * @filesource catalog/includes/classes/preventDuplicates
 * @version 1.0alpha
 * @license See standard oscommerce license
 * filename preventDuplicates.php
 * date: 07 September 2008
 */
 
 /**
 * class preventDuplicates
 * 
 * @param $getValues - array of $_GET variables which will action the added meta
 * @param $meta - contains the title/meta info prior to being altered by this class
 * @param $caught - Numerical array containing $_GET keys that were present in $getValues
 * @param $addedMeta - $_GET as a string containing key value pairs
 * @param $finalMeta - The modified (or not) meta that will be printed to screen
 * @param $IhaveDuplicateContent - Set to true or false dependent on whether Google webmaster tolls is showing duplicate content
 * @param $noIndex - meta shown when $IhaveDuplicateContent is set to false 
 */
class preventDuplicates {
  
  var $getValues = array('sort', 'page', 'language', 'currency');
  var $IhaveDuplicateContent = true;
  var $turnServiceOn = true; // true turns on false will turn this service off
  var $meta;
  var $caught;
  var $addedMeta;
  var $finalMeta;
  var $noIndex = '<meta name="ROBOTS" content="NOINDEX, FOLLOW" />';

  function preventDuplicates(){
  }
  /**
  * Sets $this->finalMeta (Final meta to be output based on the methods and properties below
  * 
  * @param mixed $meta - $meta - contains the buffered title/meta info prior to being altered by this class
  * @method - $this->targetsExist() - Returns true or false based on whether $getValues was found in $_GET
  * @method - $this->parseMeta() - Ultimately sets $this->finalMeta;
  */
  function checkTarget($meta) {
    
    $this->meta = $meta;
    if( $this->targetsExist() && (false !== $this->turnServiceOn) ){
      if( false !== $this->IhaveDuplicateContent ){
      $this->parseMeta();
      } else {
        $this->finalMeta = $this->meta . "\n" . $this->noIndex;
      }
    } else {
      $this->finalMeta = $this->meta;
    }
  }
  /**
  * Checks whether any $this->getValues exist in the $_GET array
  * 
  * @param - $this->caught - set as an array of keys found in $_GET 
  * @return - Returns true or false, if true $this->caught is also set as an array
  */
  function targetsExist(){
    $caught = array();
    foreach( $this->getValues as $value ){
      if( isset($_GET[$value]) ){
        $caught[] = tep_output_string_protected($value);
      }
  }
  if( !empty($caught)) {
    $this->caught = $caught;
    return true; 
  } else{
    return false;
  }
  }
  /**
  * Sets $this->addedMeta which is a string made up of matched $_GET key value pairs
  * Key value pairs are seperated with _ (underscore) seperate $_GET are se[erated with - (hyphen)
  * 
  * @param $this->addedMeta -  A string made up of matched $_GET key value pairs
  * @method $this->performPCRE() - performs PCRE replace operations on the buffered $meta  
  * 
  */
  function parseMeta(){
    
    $addedMeta = '';
    $count = count($this->caught);
    for( $i=0; $i<$count; $i++ ){
      $addedMeta .= $this->caught[$i] . '_' . tep_sanitize_string(tep_output_string_protected($_GET[$this->caught[$i]])) . '-';
    }
    $this->addedMeta = $addedMeta;
    $this->performPCRE();
  }
  /**
  * PCRE replace operations to inject added meta info based on matched $_GET variables
  * 
  * @param $this->finalMeta - Sets $this->finalMeta which contains the modified meat data 
  */
  function performPCRE() {
    
    $pattern[]   = '@<title>\s*@i';
    $pattern[]   = '@<meta\s*name\s*=\s*"\s*description\s*"\s*content\s*=\s*"\s*@i';
    $pattern[]   = '@<meta\s*name\s*=\s*"\s*keywords\s*"\s*content\s*=\s*"\s*@i';
    $replace[]   = '<title>' . str_replace('-', ' | ', $this->addedMeta);
    $replace[]   = '<meta name="description" content="' . str_replace('-', ' ', $this->addedMeta);
    $replace[]   = '<meta name="keywords" content="' . str_replace('-', ', ', $this->addedMeta);
    
    $this->finalMeta = preg_replace($pattern, $replace, $this->meta);
  }
  
} //End preventDuplicates class  
?>