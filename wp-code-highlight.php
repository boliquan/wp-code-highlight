<?php
/*
Plugin Name: WP Code Highlight
Plugin URI: http://boliquan.com/wp-code-highlight/
Description: WP Code Highlight provides clean syntax highlighting and it also provides a code button. Wrap code blocks with <code>&lt;pre&gt;</code> and <code>&lt;/pre&gt;</code>
Version: 1.2.3
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
		srand((float) microtime() *10000000);
		$theme_style[1]='wp-code-highlight';
		$theme_style[2]='desert';
		$theme_style[3]='sunburst';
		$theme_style[4]='sons-of-obsidian';
		$rand_theme=array_rand($theme_style);
		$wp_code_highlight_themes=$theme_style[$rand_theme];
	}
	$wp_code_highlight_css_url = plugins_url('/css/' . $wp_code_highlight_themes . '.css', __FILE__);
	if(file_exists(TEMPLATEPATH . "/wp-code-highlight.css")){
		$wp_code_highlight_css_url = get_bloginfo("template_url") . "/wp-code-highlight.css";
	}
	if(get_option('wp_code_highlight_themes')!=''){
		echo '<link rel="stylesheet" type="text/css" href="'.$wp_code_highlight_css_url.'" media="screen" />' . "\n";
	}
	else{
		$wp_code_highlight_css_url = plugins_url('/css/wp-code-highlight.css', __FILE__);
		echo '<link rel="stylesheet" type="text/css" href="'.$wp_code_highlight_css_url.'" media="screen" />' . "\n";
	}
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

function my_stripslashes($code){
	$code=str_replace(array("\\\"", "\\\'"), array ('"', "'"),$code);
	$code=htmlspecialchars($code);
	$code=str_replace(array('<', '>'), array('&lt;', '&gt;'),$code);
	return $code;
}
function wp_code_highlight_filter($content) {
	if(get_option('wp_code_highlight_line_numbers')=='enable'){
		$line_numbers=' linenums:1';
	}
	else{
		$line_numbers='';
	}
	return preg_replace("|<pre(.*?)>(.*?)</pre>|ise",
		"'<pre class=\"wp-code-highlight prettyprint$line_numbers\">'.my_stripslashes('$2').'</pre>'", $content);
}
add_filter('the_content', 'wp_code_highlight_filter', 0);
add_filter('comment_text', 'wp_code_highlight_filter', 0);

?>
<?php if(is_admin()){require_once('wp_code_highlight_admin.php');} ?>
<?php 
if(is_admin() && get_option('wp_code_highlight_button')!='disable'){
	add_action('admin_footer','wp_code_highlight_button_admin');
	function wp_code_highlight_button_admin(){
?>
	<script type="text/javascript">
	//<![CDATA[
	if(wp_code_highlight_toolbar = document.getElementById("ed_toolbar")){
		wp_code_highlight_tag = edButtons.length;
		edButtons[wp_code_highlight_tag] = new edButton('ed_highlight','wp-code-highlight','<pre>\n','\n</pre>\n','c');
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
} 
if(get_option("wp_code_highlight_deactivate")=='yes'){
	function wp_code_highlight_deactivate(){
		global $wpdb;
		$remove_options_sql = "DELETE FROM $wpdb->options WHERE $wpdb->options.option_name like 'wp_code_highlight_%'";
		$wpdb->query($remove_options_sql);
	}
	register_deactivation_hook(__FILE__,'wp_code_highlight_deactivate');
}
?>