
<table width="100%" cellspacing="2" cellpadding="2" align="center">
	<tr>
		<td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	</tr>
</table>


<br class="spacer" />

<table class="forumline" width="100%" cellspacing="0" cellpadding="3" align="center">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid">Simple BB Code</td>
	</tr></table></caption>
</thead>
	<tr> 
		<td class="{faq_block.faq_row.ROW_CLASS}" align="left" valign="top"><span class="postbody"><a name="{faq_block.faq_row.U_FAQ_ID}"></a><b>{faq_block.faq_row.FAQ_QUESTION}</b></span><br /><span class="postbody"><p>When editing a message, there is no possibility to include HTML. Messages can contain only "BB codes" - special HTML-code replacements, that "emulate" HTML code. When posting on clan forums, or anywhere outside of the official forums, a simplified version of BBcode is used as outlined here. Currently, there is support for the following codes:

<ul>
<li><b>[url=SOMEURL]SOMETEXT[/url]</b> where SOMEURL is URL like http://www.minibb.net, SOMETEXT is alternate text to URL. DON'T USE QUOTATION MARKS OR APOSTROPHES INSIDE THIS TAG. In a post, these tags are replaced like following:
&lt;a href='SOMEURL'&gt;SOMETEXT&lt;/a&gt;.

<li><b>[email=SOMEEMAIL]SOMETEXT[/email]</b> where SOMEEMAIL is email you want to highlight. Practically, this tag is the same as URL, only with "mailto:". DON'T USE QUOTATION MARKS OR APOSTROPHES INSIDE THIS TAG. In a post, these tags are replaced like following:
&lt;a href='mailto:SOMEEMAIL' target='_blank'&gt;SOMETEXT&lt;/a&gt;.

<li><b>[img(left|right)]http://www.someserver.com/images/image.gif[/img]</b> where http://www.someserver.com/images/image.gif is exact URL for an image file (.JPG or .GIF). Alternatively, you can use "left" and "right" tags (without trailing space!) followed exact after "img". They place image left or right on the page, in the same way like HTML does. Usually, only [img] tag is used, but in systems like "forum news" you can also use left/right aligns. This tag is replaced with: &lt;img src='http://www.someserver.com/images/image.gif' align='left OR right OR nothing' alt=''&gt;. (Example: [imgleft]http://www.someserver.com/images/image.gif[/img]) Note: because of hack protection, you can include images only from http:// servers, also as with only extensions like .gif or .jpg.

<li><b>[b]Bold[/b]</b> where "Bold" is the text you want to markup as in a "bold" style. Example:
[b]Attention[/b] produces <b>Attention</b>.

<li><b>[i]Italic[/i]</b> where "Italic" is the text you want to markup as in an "italic" style. Example:
[i]I apologize[/i] produces <i>I apologize</i>.

<li><b>[u]Underlined[/u]</b> where "Underlined" is the text you want to markup as in an "underlined" style. Example:
[u]Don't write me an email[/u] produces <u>Don't write me an email</u>.

<li><b>[center]Centered Text[/center]</b> where "Centered Text" is the text you want to align to the center. Example:
[center]Welcome to the league![/center] produces: <br /><center>Welcome to the league!</center>

</ul>

<p>Note that the case of BB codes doesn't matter. You can type "[URL]" or "[uRL]" or whatever. Only opening and closing tags ([urL]...[/uRL]) are important, also tags CAN NOT CONTAIN SPACES!
<p>There is no necessary to know exactly what do you need to type for corresponding tag. Each template message form contains JavaScript <i>buttons</i> that helps you to insert these tags into your post. 

<p>It is possible to combine tags with each other, f.e., to make "bold+italic" or "bold link". But be careful again with opening and closing tags correspondly. Example:

	</tr>
	<tr>
		<td class="spaceRow" height="1"><img src="../data/images/forums/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<td class="{faq_block.faq_row.ROW_CLASS}" align="left" valign="top"><span class="postbody">

<p>'This General Public License [b]does not permit[/b] incorporating your program into proprietary programs. If your program is a subroutine game/library, you may consider it more useful to permit linking proprietary applications with the game/library. If this is what you want to do, use the GNU game/library General Public License instead of this License. 

<p>Return to [url=http://www.fsf.org/home.html]GNU's home page[/url]. 

<p>FSF &amp; GNU inquiries &amp; questions to [email=gnu@gnu.org]gnu@gnu.org[/email]. Other ways to [b][url=http://www.fsf.org/home.html#ContactInfo]contact the FSF[/url][/b]. 

<p>Comments on these web pages to [email=webmasters@www.gnu.org]webmasters@gnu.org[/email], send other questions to [email=gnu@gnu.org]GNU[/email]. 

<p>[b][u]Copyright notice above[/u][/b].
<p>[i]Free Software Foundation, Inc[/i]., [i][u]59 Temple Place - Suite 330, Boston, MA 02111, USA[/u][/i]'
<br /><br />
	</tr>
	<tr>
		<td class="spaceRow" height="1"><img src="../data/images/forums/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<td class="{faq_block.faq_row.ROW_CLASS}" align="left" valign="top"><span class="postbody">

<center>Produces:</center>

	</tr>
	<tr>
		<td class="spaceRow" height="1"><img src="../data/images/forums/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<td class="{faq_block.faq_row.ROW_CLASS}" align="left" valign="top"><span class="postbody">

<p>'This General Public License <b>does not permit</b> incorporating your program into proprietary programs. If your program is a subroutine game/library, you may consider it more useful to permit linking proprietary applications with the game/library. If this is what you want to do, use the GNU game/library General Public License instead of this License. 

<p>Return to <a href="http://www.fsf.org/home.html" target="_blank">GNUs home page</a>. 

<p>FSF &amp; GNU inquiries &amp; questions to <a href="mailto:gnu@gnu.org">gnu@gnu.org</a>. Other ways to <b><a href="http://www.fsf.org/home.html#ContactInfo" target="_blank">contact the FSF</a></b>. 

<p>Comments on these web pages to <a href="mailto:webmasters@www.gnu.org">webmasters@gnu.org</a>, send other questions to <a href="mailto:gnu@gnu.org">GNU</a>. 

<p><b><u>Copyright notice above</u></b>.
<p><i>Free Software Foundation, Inc</i>., <i><u>59 Temple Place - Suite 330, Boston, MA 02111, USA</u></i>'
<br /><br />
	</tr>
	<tr>
		<td class="spaceRow" height="1"><img src="../data/images/forums/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<td class="{faq_block.faq_row.ROW_CLASS}" align="left" valign="top"><span class="postbody">

<p><p>If you need to post 100% "tagged" URL, it is better to do it with tags, since automatic replacements can't work in some cases. F.e., the following example will not work: [b]http://www.minibb.net[/b]. It is only "bolded", but not "highlighted". For bolding url links, use [url] tag.
<p>Note: you can use tags also for multi-line text. Example:
<p>[b]Text1
<p>Text2[/b]
<p>(text contains two paragraphs) produces:
<p><b>Text1</b>
<p><b>Text2</b>


</tbody>
</table>

<br class="spacer" />



<table width="100%" cellspacing="2" align="center">
	<tr>
		<td align="right" valign="middle" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br /><br />{JUMPBOX}</td> 
	</tr>
</table>
