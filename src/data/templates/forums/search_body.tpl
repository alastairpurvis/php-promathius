
<form action="{S_SEARCH_ACTION}" method="POST"><table width="100%" cellspacing="2" cellpadding="2" align="center">
	<tr> 
		<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
	</tr>
</table>

{Begin_Shadow}
<table class="forumline" width="100%" cellpadding="4" cellspacing="0">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid">{L_SEARCH_QUERY}</td>
	</tr></table></caption>
</thead>
<tbody>
	<tr> 
		<td class="row1" colspan="2" width="50%"><span class="gen">{L_SEARCH_KEYWORDS}:</span><br /><span class="gensmall">{L_SEARCH_KEYWORDS_EXPLAIN}</span></td>
		<td class="row2" colspan="2" valign="top"><input type="text" style="width: 300px" class="post" name="search_keywords" size="30" /><br />
		<table cellspacing="0" cellpadding="1">
		<tr>
			<td width="20"><span class="rbstyled"><input type="radio" name="search_terms" value="any" /></span></td>
			<td><span class="genmed">{L_SEARCH_ANY_TERMS}</span></td>
		</tr>
		<tr>
			<td width="20"><span class="rbstyled"><input type="radio" name="search_terms" value="all" checked="checked" /></span></td>
			<td><span class="genmed">{L_SEARCH_ALL_TERMS}</span></td>
		</tr>
		</table></td>
	</tr>
	<tr> 
		<td class="row1" colspan="2"><span class="gen">{L_SEARCH_AUTHOR}:</span><br /><span class="gensmall">{L_SEARCH_AUTHOR_EXPLAIN}</span></td>
		<td class="row2" colspan="2" valign="middle"><span class="genmed"><input type="text" style="width: 300px" class="post" name="search_author" size="30" /></span></td>
	</tr>
	<tr> 
		<th class="forum" class="thHead" colspan="4" height="25">{L_SEARCH_OPTIONS}</th>
	</tr>
	<tr> 
		<td class="row1" align="right"><span class="gen">{L_FORUM}:&nbsp;</span></td>
		<td class="row2"><span class="genmed"><select class="post" name="search_forum">{S_FORUM_OPTIONS}</select></span></td>
		<td class="row1" align="right" nowrap="nowrap"><span class="gen">{L_SEARCH_PREVIOUS}:&nbsp;</span></td>
		<td class="row2" valign="middle"><select class="post" name="search_time">{S_TIME_OPTIONS}</select><br />
		<table cellspacing="0" cellpadding="1">
		<tr>
			<td width="20"><span class="rbstyled"><input type="radio" name="search_fields" value="all" checked="checked" /></span></td>
			<td><span class="genmed">{L_SEARCH_MESSAGE_TITLE}</span></td>
		</tr>
		<tr>
			<td width="20"><span class="rbstyled"><input type="radio" name="search_fields" value="msgonly" /></span></td>
			<td><span class="genmed">{L_SEARCH_MESSAGE_ONLY}</span></td>
		</tr>
		</table></td>
	</tr>
	<tr> 
		<td class="row1" align="right"><span class="gen">{L_CATEGORY}:&nbsp;</span></td>
		<td class="row2"><span class="genmed"><select class="post" name="search_cat">{S_CATEGORY_OPTIONS}
		</select></span></td>
		<td class="row1" align="right"><span class="gen">{L_SORT_BY}:&nbsp;</span></td>
		<td class="row2" valign="middle" nowrap="nowrap"><select class="post" name="sort_by">{S_SORT_OPTIONS}</select><br />
		<table cellspacing="0" cellpadding="1">
		<tr>
			<td width="20"><span class="rbstyled"><input type="radio" name="sort_dir" value="ASC" /></span></td>
			<td><span class="genmed">{L_SORT_ASCENDING}</span></td>
		</tr>
		<tr>
			<td width="20"><span class="rbstyled"><input type="radio" name="sort_dir" value="DESC" checked="checked" /></span></td>
			<td><span class="genmed">{L_SORT_DESCENDING}</span></td>
		</tr>
		</table></td>
	</tr>
	<tr> 
		<td class="row1" align="right" nowrap="nowrap"><span class="gen">{L_DISPLAY_RESULTS}:&nbsp;</span></td>
		<td class="row2" nowrap="nowrap"><table cellspacing="0" cellpadding="1">
		<tr>
			<td width="20"><span class="rbstyled"><input type="radio" name="show_results" value="posts" /></span></td>
			<td><span class="genmed">{L_POSTS}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
			<td width="20"><span class="rbstyled"><input type="radio" name="show_results" value="topics" checked="checked" /></span></td>
			<td><span class="genmed">{L_TOPICS}</span></td>
		</tr>
		</table></td>
		<td class="row1" align="right"><span class="gen">{L_RETURN_FIRST}</span></td>
		<td class="row2"><span class="genmed"><select class="post" name="return_chars">{S_CHARACTER_OPTIONS}</select> {L_CHARACTERS}</span></td>
	</tr>
	<tr> 
		<td class="catBottom" colspan="4" align="center" height="28">{S_HIDDEN_FIELDS}<input class="mainoption" type="submit" value="{L_SEARCH}" /></td>
	</tr>
</table>
{End_Shadow}
</form>

<table width="100%">
	<tr>
		<td align="right" valign="top">{JUMPBOX}</td>
	</tr>
</table>
