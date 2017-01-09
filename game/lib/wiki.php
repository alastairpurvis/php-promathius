<?php
///////////////////////////////////////////////////////////////////
//	WIKI LIBRARY
//	Based on TigerWiki.
//  Used for the game guide
///////////////////////////////////////////////////////////////////

// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

    $TIME_FORMAT		=	"%Y/%m/%d %R";
    $LOCAL_HOUR			=	"-2";
    $TIME_ZONE 			=   "America/Montreal"; //See http://ch2.php.net/manual/en/timezones.php
	$PAGES_DIR			= 	$data_root_path."/guide/";
	$PAGE_NAME			=	"section";	// Can be section, page, document etc.
    $START_PAGE			=	"Home";
	if($wikidirargs){ 	// Custom pages for integrated help
		$PAGES_DIR		= 	$data_root_path.'/guide/special/'.$wikidirargs.'/';
		$TABOPTION 		= 	"&tab=help";
		$START_PAGE		=	"main";
	}
	$BACKUP_DIR			=	$game_root_path."/cache/guide";
	
    $HOME_BUTTON		=	"Guide";
    $HELP_BUTTON		=	"Help";
    $DEFAULT_CONTENT	=	"There is nothing to list."; //The center variable is the page requested stripslashes($_GET[$PAGE_NAME])
    $EDIT_BUTTON		=	"Edit";
    $DONE_BUTTON		=	"Save";
    $PROTECTED_BUTTON 	=	"Locked page";
    $SEARCH_BUTTON		=	"Search";
    $SEARCH_RESULTS		=	"Search results";
	$LIST				=	"List of pages";
    $RECENT_CHANGES		=	"Recent Changes";
	$LAST_CHANGES		=	"Last modification";
	$HISTORY_BUTTON		=	"History";
	$NO_HISTORY			=	"No history found.";
	$RESTORE            =   "Restore";
	$MDP                =   "Password";
	$ERROR				=	$MDP." specified is incorrect.";
	$ERASE_COOKIE       =   "Erase cookie";

	$address = $currentServer."?".$GAME_ACTION.$TABOPTION;
    if (! $PAGE_TITLE = stripslashes(utf8_encode(htmlentities($_GET[$PAGE_NAME])))) {
        if ($_GET["action"] == "search")
			if ($_POST['query'] != "")
				$PAGE_TITLE = "$SEARCH_RESULTS " . stripslashes(htmlentities($_POST['query']));
			else
				$PAGE_TITLE = $LIST . " (" . count(glob("$PAGES_DIR/*.*")) . ")";
        elseif ($_GET["action"] == "recent")
            $PAGE_TITLE = "$RECENT_CHANGES";
        else
            $PAGE_TITLE = "$START_PAGE";
    }
    $action = $_GET["action"];
    if (isset($_GET["time"]))
        $gtime = $_GET["time"];
    @date_default_timezone_set($TIME_ZONE);
    $datetw = date("Y/m/d H:i", mktime(date("H") + $LOCAL_HOUR));
	
// Arreter les acces malicieux via repertoire et accents
    if (preg_match("/\//", $PAGE_TITLE))
		$PAGE_TITLE = $START_PAGE;
    if (preg_match("/\//", $gtime))
		$gtime = '';
		
// Ecrire les modifications, s'il y a lieu
   	if ($_POST["content"] != "") {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {	
			if ($_POST["sc"] == $PASSWORD || $_COOKIE['AutorisationTigerWiki'] == md5($PASSWORD)) {
			    setcookie('AutorisationTigerWiki', md5($PASSWORD), time() + 365*24*3600);
				if (! $file = @fopen($PAGES_DIR . stripslashes($_POST[$PAGE_NAME]) . ".wik", "w"))
					die("Could not write page!");
            $safe_content = htmlentities($_POST['content'],ENT_COMPAT,"UTF-8");
				if (get_magic_quotes_gpc())
					fputs($file, trim(stripslashes(utf8_encode($safe_content))));
				else
					fputs($file, trim(utf8_encode($_POST["content"])));	    
				fclose($file);        
				if ($BACKUP_DIR <> '') {
					$complete_dir_s = $BACKUP_DIR . "/" . $_POST[$PAGE_NAME] . "/";
                    if (! $dir = @opendir($complete_dir_s)) {
						mkdir($complete_dir_s);
						chmod($complete_dir_s,0777);
				    }
                    if (! $file = @fopen($complete_dir_s . date("Ymd-Hi", mktime(date("H") + $LOCAL_HOUR)) . ".bak", "a"))
                        die("Could not write backup of page!");
                    fputs($file, "\n// " . $datetw . " / " . " " . $_SERVER['REMOTE_ADDR'] . "\n");
                    if (get_magic_quotes_gpc())
                         fputs($file, trim(stripslashes($safe_content)));
                    else
                         fputs($file, trim($safe_content) . "\n\n");            
                     fclose($file);
				}
				header("location: ".$address . "&" . $PAGE_NAME . "=" . urlencode(stripslashes($_POST[$PAGE_NAME])));
			}
			else { header("location: ".$address . "&" . $PAGE_NAME . "=" . $_POST[$PAGE_NAME]."&action=edit&error=1"); }
	}
	}
	elseif (isset($_POST["content"]) && $_POST["content"] == "") {
	    if ($_POST["sc"] == $PASSWORD || $_COOKIE['AutorisationTigerWiki'] == md5($PASSWORD)) {
	        setcookie('AutorisationTigerWiki', md5($PASSWORD), time() + 365*24*3600);
	        unlink($PAGES_DIR . stripslashes($_POST[$PAGE_NAME]) . ".wik");
	    }
	    else
	        header("location: ".$address . "&" . $PAGE_NAME . "=" . $_POST[$PAGE_NAME]."&action=edit&error=1");
    }
	
// Lecture et analyse du modèle de page
    if (! $file = @fopen($data_root_path.'/templates/guide.tpl', "r"))
        die("$data_root_path/templates/guide.tpl is missing!");
    $template = fread($file, filesize($data_root_path.'/templates/guide.tpl'));
    fclose($file);
	
// Lecture du contenu et de la date de modification de la page
    if (($file = @fopen($PAGES_DIR . utf8_decode($PAGE_TITLE) . ".wik", "r")) || $action <> "") {
        if (file_exists($PAGES_DIR . utf8_decode($PAGE_TITLE) . ".wik"))
            $TIME = date("Y/m/d H:i", @filemtime($PAGES_DIR . utf8_decode($PAGE_TITLE) . ".wik") + $LOCAL_HOUR * 3600);
    $CONTENT = "\n" . @fread($file, @filesize($PAGES_DIR . utf8_decode($PAGE_TITLE) . ".wik")) . "\n";
        // Restaurer une page
        if (isset($_GET[$PAGE_NAME]) && isset($gtime) && $_GET["restore"] == 1)
            if ($file = @fopen($BACKUP_DIR . "/" . $PAGE_TITLE . "/" . $gtime, "r"))
                $CONTENT = "\n" . @fread($file, @filesize($BACKUP_DIR . "/" . $PAGE_TITLE . "/" . $gtime)) . "\n";
        @fclose($file);
		$CONTENT = preg_replace("/\\$/Umsi", "&#036;", $CONTENT);
		$CONTENT = preg_replace("/\\\/Umsi", "&#092;", $CONTENT);
    }
    else {
        if (!file_exists($PAGES_DIR . $PAGE_TITLE . ".wik"))
            $CONTENT = "\n" . $DEFAULT_CONTENT;
        else
            $action = "edit";
    }
	
// Déterminer le mode d'accès
    if ($action == "edit" || $action == "search" || $action == "recent")
	{
		$edit_button = ""; 
        $html = preg_replace('/{EDIT}/', $EDIT_BUTTON, $template);
	}
    elseif (is_writable($PAGES_DIR . $PAGE_TITLE . ".wik") || !file_exists($PAGES_DIR . $PAGE_TITLE . ".wik"))
	{
		if($users['editor'] == 1)
		{
			$edit_button = $address . "&" . $PAGE_NAME . "=" . $PAGE_TITLE."&amp;action=edit"; 
		}
	}
    else
        $html = preg_replace('/{EDIT}/', $PROTECTED_BUTTON, $template);
    if ($action == "recent")
        $html = preg_replace('/{RECENT_CHANGES}/', $RECENT_CHANGES, $html);
    else
        $html = preg_replace('/{RECENT_CHANGES}/', "<a href=\"./?action=recent\" accesskey=\"3\">$RECENT_CHANGES</a>", $html);
		
// Remplacer les variables par des valeurs (dans le style de page)
    $html = preg_replace('/{PAGE_TITLE_BRUT}/', $PAGE_TITLE, $html);
    if ($action != "" && $action != "recent" && $action != "search")
	{
	   $page_title_tpl = $PAGE_TITLE;
	   $page_title_address = $address . "&" . $PAGE_NAME . "=" . $PAGE_TITLE;
	}
	else
	{
	   	$page_title_tpl = $PAGE_TITLE;
	   	$page_title_address = "";
	}
    if ($PAGE_TITLE == $START_PAGE && $action <> "search")
	{
        $page_title_tpl = $HOME_BUTTON;
	}
    else
	{
		$page_title_tpl = $HOME_BUTTON;
		$page_title_address = $address . "&" . $PAGE_NAME . "=" . $START_PAGE;
	}
    $html = preg_replace('/{WIKI_TITLE}/', $WIKI_TITLE, $html);
    $html = preg_replace('/{LAST_CHANGE}/', $LAST_CHANGES." :", $html);
    if ($action != "edit")
	{
		$help_link = "";
	}
    else
	{
		if($users['editor'] == 1)
		{
			$help_link = $address . "&" . $PAGE_NAME . "=" . $HELP_BUTTON;
		}
		else
		{
			$help_link = "";
		}
	}

	$search_address = $address."&action=search";
	$search_value = $_GET[query];
	
    if ($action == "edit") {
		if($users['editor'] == 1)
		{
			//$html = preg_replace('/{HISTORY}/', "/ <a href=\"".$address."&page=".$PAGE_TITLE."&amp;action=history\" accesskey=\"6\" rel=\"nofollow\">".$HISTORY_BUTTON."</a><br />", $html);
			$history_link = $address . "&" . $PAGE_NAME . "=" . $PAGE_TITLE."&amp;action=history";
			$CONTENT = "<form method=\"post\" action=\"".$address . "&" . $PAGE_NAME . "\"><textarea name=\"content\" cols=\"63\" rows=\"35\" style=\"width: 100%;\">$CONTENT</textarea><input type=\"hidden\" name=\"".$PAGE_NAME."\" value=\"".$PAGE_TITLE."\" /><br /><p align=\"right\">";
			if ($PASSWORD != "" && $_COOKIE['AutorisationTigerWiki'] != md5($PASSWORD))
				$CONTENT .= $MDP." : <input type=\"password\" name=\"sc\" />";
			$CONTENT .= " <input type=\"submit\" value=\"$DONE_BUTTON\" class=\"mainoption\" accesskey=\"s\" /></p></form>";
		}
		else
		{
			$CONTENT = "You do not have rights to edit this page.";			
		}
	}
	elseif ($action != "history")
    	$history_link = "";
// Liste des versions historiques d'une page
    if ($action == "history" && !isset($gtime)) {
    	$history_link = "Yes";
		$complete_dir = $BACKUP_DIR . "/" . $_GET[$PAGE_NAME] . "/";
    	if ($opening_dir = @opendir($complete_dir)) {
        	while (false !== ($filename = @readdir($opening_dir)))
        		$files[] = $filename;
        	rsort ($files);
           	for($cptfiles = 0; $cptfiles < sizeof($files)-2; $cptfiles++)
        	    $affichage = $affichage."<a href=\"".$address . "&" . $PAGE_NAME . "=" . $_GET[$PAGE_NAME]."&amp;action=history&amp;time=".$files[$cptfiles]."\" rel=\"nofollow\">".$files[$cptfiles]."</a><br />";
        	$html = preg_replace('/{CONTENT}/', $affichage, $html);
        }
        else
        	$html = preg_replace('/{CONTENT}/', $NO_HISTORY, $html);
    }
// Affichage d'un fichier historique
	if ($action == "history" && isset($gtime)) {
	    $complete_dir = $BACKUP_DIR . "/" . $PAGE_TITLE . "/";
	    if ($file = @fopen($BACKUP_DIR . "/" . $PAGE_TITLE . "/" . $gtime, "r")) {
    	    $html = preg_replace('/{HISTORY}/', "/ <a href=\"".$address . "&" . $PAGE_NAME . "=" . $PAGE_TITLE."&amp;action=history\" rel=\"nofollow\">".$HISTORY_BUTTON."</a> (<a href=\"".$address . "&" . $PAGE_NAME . "=" . $PAGE_TITLE."&amp;action=edit&amp;time=".$gtime."&amp;restore=1\" rel=\"nofollow\">".$RESTORE."</a>)", $html);
            $CONTENT = @fread($file, @filesize($complete_dir . $gtime)) . "\n";
      	}
      	else
    	    $html = preg_replace('/{HISTORY}/', "/ <a href=\"".$address . "&" . $PAGE_NAME . "=" . $PAGE_TITLE."&amp;action=history\" rel=\"nofollow\">".$HISTORY_BUTTON."</a> (-)", $html);
    }
// Erreur du mot de passe
	if ($_GET['error'] == 1)
		$html = preg_replace('/{ERROR}/', $ERROR, $html);
	else
		$html = preg_replace('/{ERROR}/', "", $html);
// Effacement du cookie
    if ($_GET['erasecookie'] == 1)
        setcookie('AutorisationTigerWiki');
// Page de recherche
    if ($action == "search") {
		$results = 0;
        $dir = opendir(getcwd() . "/$PAGES_DIR");
        while ($file = readdir($dir)) {
            if (preg_match("/.wik$/", $file)) {
                $handle = fopen($PAGES_DIR . $file, "r");
                @$content = fread($handle, filesize($PAGES_DIR . $file));
                fclose($handle);
                $query = preg_quote($_POST['query'],"/");
				if (@preg_match("/$query/i", $content) || preg_match("/$query/i", "$PAGES_DIR/$file")) {
                    $file = substr($file, 0, strlen($file) - 4);
                    $CONTENTLINKS .= "<a href=\"".$address . "&" . $PAGE_NAME . "=" . utf8_encode($file)."\">".utf8_encode($file)."</a><br />";
					$results++;
                }
            }
        }
		if ($results == 0)
			$CONTENT .= "Nothing found matching your search criteria.<br><Br>";
		else
			$CONTENT .= $results." search results.<br><Br>";
		$CONTENT .= $CONTENTLINKS;
    }
// Changements récents
    elseif ($action == "recent") {
        $dir = opendir(getcwd() . "/$PAGES_DIR");
        while ($file = readdir($dir))
            if (preg_match("/.wik/", $file))
                $filetime[$file] = filemtime($PAGES_DIR . $file);
        arsort($filetime);
        $filetime = array_slice($filetime, 0, 10);
        foreach ($filetime as $filename => $timestamp) {
            $filename = substr($filename, 0, strlen($filename) - 4);
            $CONTENT .= "<a href=\"".$address . "&" . $PAGE_NAME . "=" . utf8_encode($filename)."\">".utf8_encode($filename)."</a> (" . strftime("$TIME_FORMAT", $timestamp + $LOCAL_HOUR * 3600) . ")<br />";
        }
    }
// Format the page
    elseif ($action <> "edit") {

        if (preg_match("/%html%\s/", $CONTENT))     

            $CONTENT = preg_replace("/%html%\s/", "", $CONTENT);
        else {
        	$CONTENT = str_replace("\r","",$CONTENT);
            //$CONTENT = htmlentities($CONTENT,ENT_COMPAT,"UTF-8");
    		$CONTENT = preg_replace("/&amp;#036;/Umsi", "&#036;", $CONTENT);
    		$CONTENT = preg_replace("/&amp;#092;/Umsi", "&#092;", $CONTENT);
    		$CONTENT = preg_replace("/\^(.)/Umsie", "'&#'.ord('\\1').';'", $CONTENT);
    		//--
    		$nbcode = preg_match_all("/{{(.+)}}/Ums",$CONTENT,$matches_code);
			$CONTENT = preg_replace("/{{(.+)}}/Ums","<code><pre>{{CODE}}</pre></code>",$CONTENT);
			//--
			$CONTENT = preg_replace('#\[([^\]]+)\|([0-9a-zA-Z\.\'\s\#/~\-_%=\?\&,\+]*)\]#U', '<a href="$2" class="url">$1</a>', $CONTENT);
			$CONTENT = preg_replace('#\[([^\]]+)\|h(ttps?://[0-9a-zA-Z\.\#/~\-_%=\?\&,\+]*)\]#U', '<a href="xx$2" class="url">$1</a>', $CONTENT);
    		$CONTENT = preg_replace('#\[h(ttps?://[0-9a-zA-Z\.\&amp;\#\:/~\-_%=?]*\.(jpeg|jpg|gif|png))\]#i', '<img src="xx$1" />', $CONTENT);
    		$CONTENT = preg_replace('#\[([0-9a-zA-Z\.\&amp;\#\:/~\-_%=?]*\.(jpeg|jpg|gif|png))\]#i', '<img src="$1" />', $CONTENT);
    		$CONTENT = preg_replace('#(https?://[0-9a-zA-Z\.\&amp;\#\:/~\-_%=?]*)#i', '<a href="$0" class="url">$1</a>', $CONTENT);
    		$CONTENT = preg_replace('#xxttp#', 'http', $CONTENT);
    		preg_match_all("/\[([^\/]+)\]/U", $CONTENT, $matches, PREG_PATTERN_ORDER);
    		foreach ($matches[1] as $match)
    			if (file_exists(html_entity_decode($PAGES_DIR."$match.wik")))
    				$CONTENT = str_replace("[$match]", "<a href=\"".$address . "&" . $PAGE_NAME . "=" . $match."\">$match</a>", $CONTENT);
    			else
    				$CONTENT = str_replace("[$match]", "<a class=\"pending\" href=\"".$address . "&" . $PAGE_NAME . "=" . $match."\">$match</a>", $CONTENT);
    		$CONTENT = preg_replace('#(\[\?(.+)\]*)#i', '<a href="http://en.wikipedia.org/wiki/$0" class="url">$0</a>', $CONTENT);
            $CONTENT = preg_replace('#([0-9a-zA-Z\./~\-_]+@[0-9a-z\./~\-_]+)#i', '<a href="mailto:$0">$0</a>', $CONTENT);
            $CONTENT = preg_replace('/^\*\*\*(.*)(\n)/Um', "<ul><ul><ul><li>$1</li></ul></ul></ul>$2", $CONTENT);
            $CONTENT = preg_replace('/^\*\*(.*)(\n)/Um', "<ul><ul><li>$1</li></ul></ul>$2", $CONTENT);
            $CONTENT = preg_replace('/^\*(.*)(\n)/Um', "<ul><li>$1</li></ul>$2", $CONTENT);
            $CONTENT = preg_replace('/^\#\#\#(.*)(\n)/Um', "<ol><ol><ol><li>$1</li></ol></ol></ol>$2", $CONTENT);
            $CONTENT = preg_replace('/^\#\#(.*)(\n)/Um', "<ol><ol><li>$1</li></ol></ol>$2", $CONTENT);
            $CONTENT = preg_replace('/^\#(.*)(\n)/Um', "<ol><li>$1</li></ol>$2", $CONTENT);

            $CONTENT = preg_replace('/(<\/ol>\n*<ol>|<\/ul>\n*<ul>)/', "", $CONTENT); 
            $CONTENT = preg_replace('/(<\/ol>\n*<ol>|<\/ul>\n*<ul>)/', "", $CONTENT); 
            $CONTENT = preg_replace('/(<\/ol>\n*<ol>|<\/ul>\n*<ul>)/', "", $CONTENT); 


			$CONTENT = preg_replace('/^!!!(.*)$/Um', '<h1>$1</h1>', $CONTENT);
			$CONTENT = preg_replace('/^!!(.*)$/Um', '<h2>$1</h2>', $CONTENT);
			$CONTENT = preg_replace('/^!(.*)$/Um', '<h3>$1</h3>', $CONTENT);

            while (preg_match('/^  /Um', $CONTENT))
              $CONTENT = preg_replace('/^( +) ([^ ])/Um', '$1&nbsp;&nbsp;&nbsp;&nbsp;$2', $CONTENT);
              $CONTENT = preg_replace('/^ /Um', '&nbsp;&nbsp;&nbsp;&nbsp;', $CONTENT);
              $CONTENT = preg_replace('/----*(\r\n|\r|\n)/m', '<hr />', $CONTENT);
              $CONTENT = preg_replace('/\n/', '<br />', $CONTENT);
              $CONTENT = preg_replace('#</ul>(<br />)*#', "</ul>", $CONTENT);
              $CONTENT = preg_replace('#</ol>(<br />)*#', "</ol>", $CONTENT);

              $CONTENT = preg_replace('#</li><ul><li>*#', "<ul><li>", $CONTENT);
              $CONTENT = preg_replace('#</ul></ul>*#', "</ul></li></ul>", $CONTENT);
              $CONTENT = preg_replace('#</ul></ul>*#', "</ul></li></ul>", $CONTENT);
              $CONTENT = preg_replace('#</li></ul><li>*#', "</li></ul></li><li>", $CONTENT);

              $CONTENT = preg_replace('#</li><ol><li>*#', "<ol><li>", $CONTENT);
              $CONTENT = preg_replace('#</ol></ol>*#', "</ol></li></ol>", $CONTENT);
              $CONTENT = preg_replace('#</ol></ol>*#', "</ol></li></ol>", $CONTENT);
              $CONTENT = preg_replace('#</li></ol><li>*#', "</li></ol></li><li>", $CONTENT);

              $CONTENT = preg_replace('#(</h[123]>)<br />#', "$1", $CONTENT);
              //$CONTENT = preg_replace("/{(.+)}/Ue", "'<pre><code>' . preg_replace('#<br />#', '', '\\1') . '</code></pre>'", $CONTENT);
              $CONTENT = preg_replace("/'--(.*)--'/Um", '<del>$1</del>', $CONTENT);
              $CONTENT = preg_replace("/'''''(.*)'''''/Um", '<strong><em>$1</em></strong>', $CONTENT);
              $CONTENT = preg_replace("/'''(.*)'''/Um", '<strong>$1</strong>', $CONTENT);
              $CONTENT = preg_replace("/''(.*)''/Um", '<em>$1</em>', $CONTENT);
              $CONTENT = preg_replace("/'u'(.*)'u'/Um", '<u>$1</u>', $CONTENT);
              // TOC
			if (strpos($CONTENT,"TOC"))
			{
			   $CONTENT = preg_replace("/TOC/Um","",$CONTENT,1);
			   $nbAncres = preg_match_all('/<a name="(.+)">(.+)<\/a>/Ums',$CONTENT,$matches_ancres);
			   //~ print "<pre>".htmlentities(var_dump($matches_ancres,TRUE))."</pre>"; //DBG
			   $toc = "<div id=toc>";
			   for ($i=0;$i<$nbAncres;$i++) $toc .= '<a href="#'.$matches_ancres[1][$i].'">'.$matches_ancres[2][$i].'</a> ';
			   $toc .= "</div>";
			}
			else
			   $toc = ""; 
              $CONTENT = substr($CONTENT, 6, strlen($CONTENT) - 6);
              $CONTENT = html_entity_decode($CONTENT,ENT_COMPAT,"UTF-8");
              //--
              function matchcode($m) {global $matches_code;static $idxcode=0; return $matches_code[1][$idxcode++];}
			   if ($nbcode > 0)
			      $CONTENT = preg_replace_callback(array_fill(0,$nbcode,"/{{CODE}}/"),"matchcode",$CONTENT);
			  //--
        }
    }
    if ($action != "" && $action != "edit" || (!file_exists($PAGES_DIR . $PAGE_TITLE . ".wik")))
        $TIME = "-";
    $html = preg_replace("/{CONTENT}/", $CONTENT, $html);
    $html = preg_replace("/{LANG}/", $LANG, $html);
    $html = preg_replace("/{WIKI_VERSION}/", $WIKI_VERSION, $html);
    $html = preg_replace("/{CHARSET}/", $CHARSET, $html);
    $html = preg_replace('/{TIME}/', $TIME, $html);
    $html = preg_replace('/{DATE}/', $datetw, $html);
    $html = str_replace('{TOC}', $toc, $html);
	$tpl->assign('content', $CONTENT);
	$tpl->assign('page_title', $page_title_tpl);
	$tpl->assign('page_title_address', $page_title_address);
	$tpl->assign('search_form', $search_address);
	$tpl->assign('search_value', $search_value);
	$tpl->assign('edit_button', $edit_button);
	$tpl->assign('history', $history_link);
	$tpl->assign('help', $help_link);

?>