<?php
/*
Plugin Name: WP Code Highlight
Plugin URI: http://boliquan.com/wp-code-highlight/
Description: WP Code Highlight provides clean syntax highlighting and it also provides a code button. Wrap code blocks with <code>&lt;pre&gt;</code> and <code>&lt;/pre&gt;</code>
Version: 1.2.9
Author: BoLiQuan
Author URI: http://boliquan.com/
Text Domain: WP-Code-Highlight
Domain Path: /lang
*/

function load_wp_code_highlight_lang(){
	$currentLocale = get_locale();
	if(!empty($currentLocale)) {
		$moFile = dirname(__FILE__) . "/lang/wp-code-highlight-" . $currentLocale . ".mo";
		if(@file_exists($moFile) && is_readable($moFile)) load_textdomain('WP-Code-Highlight', $moFile);
	}
}
add_filter('init','load_wp_code_highlight_lang');

function wp_code_highlight_style(){
	$wp_code_highlight_themes=get_option('wp_code_highlight_themes');
	if($wp_code_highlight_themes=='random'){
		$theme_styles = array(
				'wp-code-highlight',
				'desert',
				'sunburst',
				'sons-of-obsidian'
		);
		$rand_style=array_rand($theme_styles);
		$wp_code_highlight_themes=$theme_styles[$rand_style];
	}
	$wp_code_highlight_css_url = plugins_url('/css/' . $wp_code_highlight_themes . '.css', __FILE__);
	if(file_exists(TEMPLATEPATH . "/wp-code-highlight.css")){
		$wp_code_highlight_css_url = get_bloginfo("template_url") . "/wp-code-highlight.css";
	}
	echo '<link rel="stylesheet" type="text/css" href="'.$wp_code_highlight_css_url.'" media="screen" />' . "\n";
}
add_action("wp_head",'wp_code_highlight_style');

function wp_code_highlight_js(){
	$wp_code_highlight_js_url = plugins_url('/js/wp-code-highlight.js', __FILE__);
?>
	<!--WP Code Highlight_start-->
	<script type="text/javascript">
		window.onload = function(){prettyPrint();};
	</script>
	<script type="text/javascript" src="<?php echo $wp_code_highlight_js_url; ?>"></script>
	<!--WP Code Highlight_end-->
<?php
}
add_action('get_footer','wp_code_highlight_js');

function wch_stripslashes($code){
	$code=str_replace('\\"', '"',$code);
	$code=htmlspecialchars($code,ENT_QUOTES);
	return $code;
}
function wp_code_highlight_filter($content) {
	if(get_option('wp_code_highlight_line_numbers')=='enable'){
		$line_numbers=' linenums:1';
	}
	else{
		$line_numbers='';
	}
	return preg_replace("/<pre(.*?)>(.*?)<\/pre>/ise",
		"'<pre class=\"wp-code-highlight prettyprint$line_numbers\">'.wch_stripslashes('$2').'</pre>'", $content);
}
add_filter('the_content', 'wp_code_highlight_filter', 2);
add_filter('comment_text', 'wp_code_highlight_filter', 2);

?>
<?php 
if(is_admin() && get_option('wp_code_highlight_button')!='disable'){
	if(!function_exists('wp_editor')){
		add_action('admin_footer','wp_code_highlight_button');
		function wp_code_highlight_button(){
?>
		<script type="text/javascript">
		//<![CDATA[
		if(wp_code_highlight_toolbar = document.getElementById("ed_toolbar")){
			wp_code_highlight_tag = edButtons.length;
			edButtons[wp_code_highlight_tag] = new edButton('ed_highlight','wp-code-highlight','<pre>\n','\n</pre>\n','p');
			var wp_code_highlight_button = wp_code_highlight_toolbar.lastChild; 
			while(wp_code_highlight_button.nodeType!= 1){
				wp_code_highlight_button = wp_code_highlight_button.previousSibling;
			}
			wp_code_highlight_button = wp_code_highlight_button.cloneNode(true);
			wp_code_highlight_button.value = "WP-Code-Highlight";
			wp_code_highlight_button.title = "WP Code Highlight";
			wp_code_highlight_button.onclick = function(){edInsertTag(edCanvas,parseInt(wp_code_highlight_tag));}
			wp_code_highlight_toolbar.appendChild(wp_code_highlight_button);
			wp_code_highlight_button.id = "ed_highlight";
		}
		//]]>
		</script>
<?php 
		}
	}else{
		add_action('admin_enqueue_scripts','wp_code_highlight_button');
		function wp_code_highlight_button(){
			wp_enqueue_script(
				'wp_code_highlight_button',
				plugins_url('/js/wp-code-highlight-button.js', __FILE__),
				array('quicktags')
			);
		}
	}
}

function wp_code_highlight_activate(){
	add_option('wp_code_highlight_button','enable');
	add_option('wp_code_highlight_themes','wp-code-highlight');
	add_option('wp_code_highlight_line_numbers','disable');
	add_option('wp_code_highlight_deactivate','');
}
register_activation_hook( __FILE__, 'wp_code_highlight_activate' );

if(get_option("wp_code_highlight_deactivate")=='yes'){
	function wp_code_highlight_deactivate(){
		global $wpdb;
		$remove_options_sql = "DELETE FROM $wpdb->options WHERE $wpdb->options.option_name like 'wp_code_highlight_%'";
		$wpdb->query($remove_options_sql);
	}
	register_deactivation_hook(__FILE__,'wp_code_highlight_deactivate');
}

function wp_code_highlight_settings_link($action_links,$plugin_file){
	if($plugin_file==plugin_basename(__FILE__)){
		$wch_settings_link = '<a href="options-general.php?page=' . dirname(plugin_basename(__FILE__)) . '/wp_code_highlight_admin.php">' . __("Settings") . '</a>';
		array_unshift($action_links,$wch_settings_link);
	}
	return $action_links;
}
add_filter('plugin_action_links','wp_code_highlight_settings_link',10,2);

if(is_admin()){require_once('wp_code_highlight_admin.php');}

?>