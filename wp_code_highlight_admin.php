<?php
function wp_code_highlight_admin() {
	add_options_page('WP Code Highlight Options', 'WP Code Highlight','manage_options', __FILE__, 'wp_code_highlight_options');
}
function wp_code_highlight_options(){
	add_option('wp_code_highlight_button','enable');
    add_option('wp_code_highlight_themes','wp-code-highlight');
	add_option('wp_code_highlight_line_numbers','disable');
	add_option('wp_code_highlight_deactivate','yes');
?>
<div class="wrap">
	
<?php screen_icon(); ?>
<h2>WP Code Highlight</h2>

<form action="options.php" method="post" enctype="multipart/form-data" name="wp_code_highlight_form">
<?php wp_nonce_field('update-options'); ?>

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

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="wp_code_highlight_button,wp_code_highlight_themes,wp_code_highlight_line_numbers,wp_code_highlight_deactivate" />

<p class="submit">
<input type="submit" class="button-primary" name="Submit" value="<?php _e('Save Changes'); ?>" />
</p>

</form>

<h3>Basic Usage</h3>
Wrap code blocks with <code>&lt;pre&gt;</code> and <code>&lt;/pre&gt;</code> for more information, please visit: <a href="http://boliquan.com/wp-code-highlight/" target="_blank">WP Code Highlight</a> | <a href="http://wordpress.org/extend/plugins/wp-code-highlight/" target="_blank">Download</a>

<h3>Example</h3>
<code>&lt;pre&gt;</code><br />
&nbsp;&lt;?php<br />
&nbsp;&nbsp;&nbsp;echo "Hello World";<br />
&nbsp;?&gt;<br />
<code>&lt;/pre&gt;</code>

<br /><br />
<?php $paypal_url = plugins_url('/img/paypal_32_32.jpg', __FILE__);?>
<?php $blq_donate_url = plugins_url('/img/btn_donateCC_LG.gif', __FILE__);?>
<div class="icon32"><img src="<?php echo $paypal_url; ?>" alt="Paypal" /></div>
<h2>Donate</h2>
If you find my work useful and you want to encourage the development of more free resources, you can do it by donating.
<p>
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=SKA6TPPWSATKG&item_name=BoLiQuan&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=CA&bn=PP%2dDonationsBF&charset=UTF%2d8" target="_blank"><img src="<?php echo $blq_donate_url; ?>" alt="Donate" /></a>
</p>
<br />

</div>
<?php 
}
add_action('admin_menu', 'wp_code_highlight_admin');
?>