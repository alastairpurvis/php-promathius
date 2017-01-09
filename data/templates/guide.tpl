<table class="invisible" cellspacing=0 cellpadding=0 width=520  style='padding: 0px; margin: 0px'><tr><td>
{$BeginTabmenu}
	{$oTabActive}{$page_title}{$cTabActive}
	{$oDummy}{$cDummy}
{$EndTabmenu}
</table>
<table cellspacing="0" cellpadding="0" width=520>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding: 12px">
<table border="0" width="100%" cellpadding="4" id="mainTable" cellspacing="0" summary="{$PAGE_TITLE_BRUT}">
	<tr>
		{*
		<th> 
			<h1>
            {if $page_title_address}
            <a href="{$page_title_address}">{$page_title}</a>
            {else}
            {$page_title}
            {/if}
            </h1>
		</th>
		*}
        <th align="right" valign="top">
        <div>
            <form method="post" action="{$search_form}">
                <div>
                    <input type="hidden" name="action" value="search" />
                    <input type="text" name="query" value="{$search_value}" tabindex=1 />&nbsp;
                    <input type="submit" class="mainoption" value="Search" accesskey="q" />
                </div>
            </form>
        </div></th>
	</tr>
	<tr id="headerLinks">
		<td class="pageLinks" align="right" colspan="2" style="padding-top: 12px">
			{if $edit_button}
            <a href="{$edit_button}" accesskey="5" rel="nofollow">Edit</a>
            {/if} 
            {if $help}<a href="{$help}" accesskey="2" rel="nofollow">Help</a>{/if}
            {if $history && $history != 'Yes'}&nbsp;/ <a href="{$history}" accesskey="6" rel="nofollow">History</a><br />{/if}
            {if $history == 'Yes'}&nbsp;/ History<br />{/if}
		</td>
	</tr>
	<tr>
		<td class="wikiContent" colspan="2">
			<div class="error">{$ERROR}</div>
			{$content}
		</td>
	</tr>
	<tr id="footerLinks">
		<td class="pageLinks">
		</td>
	</tr>
</table>
{$End_Shadow_NoHelp}