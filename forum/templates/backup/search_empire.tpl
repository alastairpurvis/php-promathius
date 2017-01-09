
<script language="javascript" type="text/javascript">
<!--
function refresh_empire(selected_empire)
{
	opener.document.forms['post'].empire.value = selected_empire;
	opener.focus();
	window.close();
}
//-->
</script>

<form method="post" name="search" action="{S_SEARCH_ACTION}">
<table width="100%" cellspacing="0" cellpadding="10">
	<tr>
		<td><table width="100%" class="forumline" cellpadding="4" cellspacing="0">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		
		<td align="center" class="forumheader-mid">{L_SEARCH_EMPIRE}</td>
	</tr></table></caption>
</thead>
<tbody>
			<tr> 
				<td valign="top" class="row1"><span class="genmed"><br /><input type="text" name="search_empire" value="{empire}" class="post" />&nbsp; <input type="submit" name="search" value="{L_SEARCH}" class="liteoption" /></span><br /><span class="gensmall">{L_SEARCH_EXPLAIN}</span><br />
				<!-- BEGIN switch_select_name -->
				<span class="genmed">{L_UPDATE_empire}<br /><select name="empire_list">{S_empire_OPTIONS}</select>&nbsp; <input type="submit" class="liteoption" onClick="refresh_empire(this.form.empire_list.options[this.form.empire_list.selectedIndex].value);return false;" name="use" value="{L_SELECT}" /></span><br />
				<!-- END switch_select_name -->
				<br /><span class="genmed"><a href="javascript:window.close();" class="genmed">{L_CLOSE_WINDOW}</a></span></td>
			</tr>
		</tbody>
		</table></td>
	</tr>
</table>
</form>
