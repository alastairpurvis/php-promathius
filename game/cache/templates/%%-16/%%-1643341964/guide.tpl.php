<?php /* Smarty version 2.6.0, created on 2009-07-27 05:23:56
         compiled from guide.tpl */ ?>
<table class="invisible" cellspacing=0 cellpadding=0 width=520  style='padding: 0px; margin: 0px'><tr><td>
<?php echo $this->_tpl_vars['BeginTabmenu']; ?>

	<?php echo $this->_tpl_vars['oTabActive'];  echo $this->_tpl_vars['page_title'];  echo $this->_tpl_vars['cTabActive']; ?>

	<?php echo $this->_tpl_vars['oDummy'];  echo $this->_tpl_vars['cDummy']; ?>

<?php echo $this->_tpl_vars['EndTabmenu']; ?>

</table>
<table cellspacing="0" cellpadding="0" width=520>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding: 12px">
<table border="0" width="100%" cellpadding="4" id="mainTable" cellspacing="0" summary="<?php echo $this->_tpl_vars['PAGE_TITLE_BRUT']; ?>
">
	<tr>
		        <th align="right" valign="top">
        <div>
            <form method="post" action="<?php echo $this->_tpl_vars['search_form']; ?>
">
                <div>
                    <input type="hidden" name="action" value="search" />
                    <input type="text" name="query" value="<?php echo $this->_tpl_vars['search_value']; ?>
" tabindex=1 />&nbsp;
                    <input type="submit" class="mainoption" value="Search" accesskey="q" />
                </div>
            </form>
        </div></th>
	</tr>
	<tr id="headerLinks">
		<td class="pageLinks" align="right" colspan="2" style="padding-top: 12px">
			<?php if ($this->_tpl_vars['edit_button']): ?>
            <a href="<?php echo $this->_tpl_vars['edit_button']; ?>
" accesskey="5" rel="nofollow">Edit</a>
            <?php endif; ?> 
            <?php if ($this->_tpl_vars['help']): ?><a href="<?php echo $this->_tpl_vars['help']; ?>
" accesskey="2" rel="nofollow">Help</a><?php endif; ?>
            <?php if ($this->_tpl_vars['history'] && $this->_tpl_vars['history'] != 'Yes'): ?>&nbsp;/ <a href="<?php echo $this->_tpl_vars['history']; ?>
" accesskey="6" rel="nofollow">History</a><br /><?php endif; ?>
            <?php if ($this->_tpl_vars['history'] == 'Yes'): ?>&nbsp;/ History<br /><?php endif; ?>
		</td>
	</tr>
	<tr>
		<td class="wikiContent" colspan="2">
			<div class="error"><?php echo $this->_tpl_vars['ERROR']; ?>
</div>
			<?php echo $this->_tpl_vars['content']; ?>

		</td>
	</tr>
	<tr id="footerLinks">
		<td class="pageLinks">
		</td>
	</tr>
</table>
<?php echo $this->_tpl_vars['End_Shadow_NoHelp']; ?>