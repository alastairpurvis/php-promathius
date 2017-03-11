
<script language="javascript" type="text/javascript">
<!--
function emoticon(text) {
	text = ' ' + text + ' ';
	if (opener.document.forms['post'].message.createTextRange && opener.document.forms['post'].message.caretPos) {
		var caretPos = opener.document.forms['post'].message.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
		opener.document.forms['post'].message.focus();
	} else {
	opener.document.forms['post'].message.value  += text;
	opener.document.forms['post'].message.focus();
	}
}
//-->
</script>

<table width="100%" cellspacing="0" cellpadding="10">
	<tr>
		<td><table width="100%" cellspacing="0" cellpadding="4" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		
		<td align="center" class="forumheader-mid">{L_EMOTICONS}</td>
	</tr></table></caption>
</thead>
<tbody>
			<tr>
				<td><table width="100" cellspacing="0" cellpadding="5">
					<!-- BEGIN smilies_row -->
					<tr align="center" valign="middle"> 
						<!-- BEGIN smilies_col -->
						<td><a href="javascript:emoticon('{smilies_row.smilies_col.SMILEY_CODE}')"><img src="{PATH}{smilies_row.smilies_col.SMILEY_IMG}" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></a></td>
						<!-- END smilies_col -->
					</tr>
					<!-- END smilies_row -->
					<!-- BEGIN switch_smilies_extra -->
					<tr align="center"> 
						<td colspan="{S_SMILIES_COLSPAN}"><span  class="nav"><a href="{U_MORE_SMILIES}" onclick="open_window('{U_MORE_SMILIES}', 250, 300);return false" target="_smilies" class="nav">{L_MORE_SMILIES}</a></td>
					</tr>
					<!-- END switch_smilies_extra -->
				</table></td>
			</tr>
			<tr>
				<td align="center"><br /><span class="genmed"><a href="javascript:window.close();" class="genmed">{L_CLOSE_WINDOW}</a></span></td>
			</tr>
		</tbody>
		</table></td>
	</tr>
</table>
