<?php
function wp_code_highlight_admin() {
	add_options_page('WP Code Highlight Options', 'WP Code Highlight','manage_options', __FILE__, 'wp_code_highlight_options');
	add_action('admin_init','wp_code_highlight_register');
}
function wp_code_highlight_register(){
	register_setting('wch-settings','wp_code_highlight_button');
	register_setting('wch-settings','wp_code_highlight_themes');
	register_setting('wch-settings','wp_code_highlight_line_numbers');
	register_setting('wch-settings','wp_code_highlight_deactivate');
}
function wp_code_highlight_options(){
?>
<div class="wrap">
	
<?php screen_icon(); ?>
<h2>WP Code Highlight</h2>

<form action="options.php" method="post" enctype="multipart/form-data" name="wp_code_highlight_form">
<?php settings_fields('wch-settings'); ?>

<table class="form-table">
	<tr valign="top">
		<th scope="row">
			<?php _e('Code Button','WP-Code-Highlight'); ?>
		</th>
		<td>
			<label>
				<input name="wp_code_highlight_button" type="radio" value="enable"<?php if (get_option('wp_code_highlight_button') == 'enable') { ?> checked="checked"<?php } ?> />
				<?php _e('enable','WP-Code-Highlight'); ?>
			</label>
			<label>
				<input name="wp_code_highlight_button" type="radio" value="disable"<?php if (get_option('wp_code_highlight_button') == 'disable') { ?> checked="checked"<?php } ?> />
				<?php _e('disable','WP-Code-Highlight'); ?>
			</label>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<?php _e('Highlight Themes','WP-Code-Highlight'); ?>
		</th>
		<td>
			<label>
				<input name="wp_code_highlight_themes" type="radio" value="wp-code-highlight"<?php if (get_option('wp_code_highlight_themes') == 'wp-code-highlight') { ?> checked="checked"<?php } ?> />
				wp-code-highlight
			</label>
			<label>
				<input name="wp_code_highlight_themes" type="radio" value="desert"<?php if (get_option('wp_code_highlight_themes') == 'desert') { ?> checked="checked"<?php } ?> />
				desert
			</label>
			<label>
				<input name="wp_code_highlight_themes" type="radio" value="sunburst"<?php if (get_option('wp_code_highlight_themes') == 'sunburst') { ?> checked="checked"<?php } ?> />
				sunburst
			</label>
			<label>
				<input name="wp_code_highlight_themes" type="radio" value="sons-of-obsidian"<?php if (get_option('wp_code_highlight_themes') == 'sons-of-obsidian') { ?> checked="checked"<?php } ?> />
				sons-of-obsidian
			</label>
			<label>
				<input name="wp_code_highlight_themes" type="radio" value="random"<?php if (get_option('wp_code_highlight_themes') == 'random') { ?> checked="checked"<?php } ?> />
				random
			</label>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<?php _e('Line Numbers','WP-Code-Highlight'); ?>
		</th>
		<td>
			<label>
				<input name="wp_code_highlight_line_numbers" type="radio" value="enable"<?php if (get_option('wp_code_highlight_line_numbers') == 'enable') { ?> checked="checked"<?php } ?> />
				<?php _e('enable','WP-Code-Highlight'); ?>
			</label>
			<label>
				<input name="wp_code_highlight_line_numbers" type="radio" value="disable"<?php if (get_option('wp_code_highlight_line_numbers') == 'disable') { ?> checked="checked"<?php } ?> />
				<?php _e('disable','WP-Code-Highlight'); ?>
				&nbsp;&nbsp;<code>Notice: Be careful to enable Line Numbers, you may need to adjust your wordpress theme style.</code>
			</label>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<?php _e('Delete Options','WP-Code-Highlight'); ?>
		</th>
		<td>
			<label>
				<input type="checkbox" name="wp_code_highlight_deactivate" value="yes" <?php if(get_option("wp_code_highlight_deactivate")=='yes') echo 'checked="checked"'; ?> />
				<?php _e('Delete options while deactivate this plugin.','WP-Code-Highlight'); ?>
			</label>
		</td>
	</tr>
</table>

<p class="submit">
<input type="submit" class="button-primary" name="Submit" value="<?php _e('Save Changes'); ?>" />
</p>

</form>

<h3>Basic Usage</h3>
1. "Dashboard"->"Users"->"Your Profile"->"Disable the visual editor when writing"<br />
2. "Dashboard"->"Settings"->"WP Code Highlight"<br />
3. Wrap code blocks with <code>&lt;pre&gt;</code> and <code>&lt;/pre&gt;</code> (It provides a code button in the HTML editor)<br />
4. You don't need to specify the language since WP Code Highlight will guess, all languages are supported<br />
5. It can also load <code>wp-code-highlight.css</code> from current wordpress theme directory<br />
6. For more information, please visit: <a href="http://boliquan.com/wp-code-highlight/" target="_blank">WP Code Highlight</a> | <a href="http://boliquan.com/wp-code-highlight/" title="WP Code Highlight" target="_blank">FAQ</a> | <a href="http://boliquan.com/wp-code-highlight/" target="_blank">Submit Translations</a> | <a href="http://wordpress.org/plugins/wp-code-highlight/" target="_blank">Download</a>

<h3>Example</h3>
<code>&lt;pre&gt;</code><br />
&nbsp;&lt;?php<br />
&nbsp;&nbsp;&nbsp;echo "Hello World";<br />
&nbsp;?&gt;<br />
<code>&lt;/pre&gt;</code>

<h3>Other Plugins</h3>
1. <a href="http://boliquan.com/wp-clean-up/" target="_blank">WP Clean Up</a> | <a href="http://wordpress.org/plugins/wp-clean-up/" target="_blank">Download</a><br />
2. <a href="http://boliquan.com/wp-smtp/" target="_blank">WP SMTP</a> | <a href="http://wordpress.org/plugins/wp-smtp/" target="_blank">Download</a><br />
3. <a href="http://boliquan.com/wp-slug-translate/" target="_blank">WP Slug Translate</a> | <a href="http://wordpress.org/plugins/wp-slug-translate/" target="_blank">Download</a><br />
4. <a href="http://boliquan.com/wp-anti-spam/" target="_blank">WP Anti Spam</a> | <a href="http://wordpress.org/plugins/wp-anti-spam/" target="_blank">Download</a><br />
5. <a href="http://boliquan.com/yg-share/" target="_blank">YG Share</a> | <a href="http://wordpress.org/plugins/yg-share/" target="_blank">Download</a>

<br /><br />
<?php $donate_url = plugins_url('/img/paypal_32_32.jpg', __FILE__);?>
<?php $paypal_donate_url = plugins_url('/img/paypal_donate_email.jpg', __FILE__);?>
<?php $ali_donate_url = plugins_url('/img/alipay_donate_email.jpg', __FILE__);?>
<div class="icon32"><img src="<?php echo $donate_url; ?>" alt="Donate" /></div>
<h2>Donate</h2>
<p>
If you find my work useful and you want to encourage the development of more free resources, you can do it by donating.
</p>
<p>
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SCWY6NPFRR8EY" target="_blank"><img src="<?php echo $paypal_donate_url; ?>" alt="Paypal Donate" title="Paypal" /></a>
&nbsp;
<a href="https://www.alipay.com/" target="_blank"><img src="<?php echo $ali_donate_url; ?>" alt="Alipay Donate" title="Alipay" /></a>
</p>
<br />

<div style="text-align:center; margin:60px 0 10px 0;">&copy; <?php echo date("Y"); ?> BoLiQuan.COM</div>

</div>
<?php 
}
add_action('admin_menu', 'wp_code_highlight_admin');
?>