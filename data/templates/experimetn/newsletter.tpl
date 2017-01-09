{if $state == 1}
	<form name="send_msg" method="post" action="?{$action}{$authstr}">
	%n for their name<br />
	%d for the date<br />
	Subject: <input type="text" name="send_subj" maxlength='50' size="24"><br />
	<br />
	Message: <br /><textarea cols='65' rows='15' wrap='soft' name='send_body'></textarea><br />
	<input type="submit" name="send_msg" value="Send {$whatsend}">
	</form>
{/if}

{if $state == 2}
	Message sent!
{/if}

