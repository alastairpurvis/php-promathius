{if $err != ""} <span class="success-font">{$err}</span><br /><br /><br />{/if}
<script type="text/javascript">document.write('<span class="success-font"><center>You have Javascript enabled in your browser.</center></span>')</script>
<noscript>
{$Begin_Shadow}
<table width="350" class="shlarge" style="padding-left: 15px;padding-right: 15px; padding-bottom: 14px; padding-top: 8px">
<tr><td>
<center>
<b>Your browser either does not support Javascript or it is disabled.</b><br /><br />
This website makes a large use of Javascript to deliver an immersive viewing expierience. Without Javascript you 
will miss out on many great features.<Br /><br />
The Javascript notifier is a useful tool to have when you frequently visit this website on different 
systems. <br /><br />
{if $users.nojs_nag != 1}
<i>If you <B>do not wish to ever use Javascript</b>, you may safely click on the button below.</i>
{else}
<i>If you wish to re-enable the Javascript notifier, safely click the button below.</i>
{/if}
<Br /><br />
<form method="post" action="{$main}?javascript{$authstr}">
{if $users.nojs_nag != 1}
<input type="submit" value="Disable Javascript notifier" name="do_disablejs" class="mainoption" tabindex="1"/>
{else}
<input type="submit" value="Enable Javascript notifier" name="do_enablejs" class="mainoption" tabindex="1"/>
{/if}
</form>
</td></tr>
</table>
{$End_Shadow}
</noscript>