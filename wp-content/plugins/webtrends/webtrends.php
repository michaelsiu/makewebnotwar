<?php
/*
Plugin Name: Webtrends
Plugin URI: http://marketingtechblog.com/projects/webtrends/
Description: A plugin for integrating <a href="http://www.webtrends.com/" target="_blank">Webtrends</a> On Demand Analytics Customers.
Version: 2.0.1
Author: Douglas Karr
Author URI: http://www.dknewmedia.com/
*/

load_plugin_textdomain('wpwt', $path = 'wp-content/plugins/webtrends');

define('WEBTRENDS_COMPATIBLE', version_compare(phpversion(), '5', '>='));
if (!WEBTRENDS_COMPATIBLE) {
	trigger_error('Webtrends requires PHP 5 or greater.', E_USER_ERROR);
}

include_once(ABSPATH . WPINC . '/feed.php');

function wpwt_addwebtrends() {
	if (function_exists('add_menu_page')) {
		$page = add_submenu_page('index.php', __('Webtrends'), __('Webtrends'), '0', 'webtrends', 'wpwt_addwebtrendsnalytics_page');
		add_action('admin_print_scripts-'.$page, 'wpwt_javascript');
	}
	if (function_exists('add_options_page')) {
		$settings = add_options_page('Webtrends', 'Webtrends', 'administrator', __FILE__, 'wpwt_addwebtrendsadmin_page');
		add_action('admin_print_scripts-'.$settings, 'wpwt_javascript');
    }
}

function wpwt_addwebtrendsadmin_page() {
    include(dirname(__FILE__).'/admin.php');
}

function wpwt_addwebtrendsnalytics_page() {
    include(dirname(__FILE__).'/analytics.php');
}

function wpwt_code() {
	echo "\n".'<!-- Begin Webtrends WordPress Plugin 1.6.2 -->'."\n";
	$site_url = get_settings('siteurl');
	$wpwt_dscid = stripslashes(get_option('wpwt_dscid'));
	$wpwt_timezone = stripslashes(get_option('wpwt_timezone'));
	$wpwt_domain = stripslashes(get_option('wpwt_domain'));
	echo '<script  type="text/javascript" src="'.$site_url.'/wp-content/plugins/webtrends/webtrends.js"></script>'."\n"; 
	echo '<script type="text/javascript">'."\n";
	echo '/* <![CDATA[ */'."\n";
	echo 'var _tag=new WebTrends(); '."\n";
	echo '_tag.dcsid="'.$wpwt_dscid.'"; '."\n";
	echo '_tag.domain="statse.webtrendslive.com"'."\n";
	echo '_tag.timezone='.$wpwt_timezone.'; '."\n";
	echo '_tag.fpcdom=".'.$wpwt_domain.'"; '."\n";
	echo '_tag.dcsGetId(); '."\n";
	echo '_tag.dcsCollect();'."\n";
	echo '/* ]]> */'."\n";
	echo '</script>'."\n";
	echo '<noscript>'."\n";
	echo '<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="http://statse.webtrendslive.com/'.$wpwt_dscid.'/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=8.6.2"/></div>
</noscript>'."\n";
	echo '<!-- End Webtrends -->'."\n";
}

function wpwtRequest($login, $password, $url) {
	// create a new cURL resource
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERPWD, $login.":".$password);
	$output = curl_exec($ch);
	return $output;
}

function wpwt_admin_init() {
	wp_register_script('wpwt_jqry', path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) ). '/js/jquery.js'));
	wp_register_script('wpwt_flot', path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) ). '/js/jquery.flot.js'));
	wp_register_script('wpwt_data', path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) ). '/js/massage-analytics-dump.js'));
}
	
function wpwt_javascript() {
	$canvasie = path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) )."/js/excanvas.min.js");
	echo "<!--[if IE]><script language='javascript' type='text/javascript' src='".$canvasie."'></script><![endif]-->\n";
	wp_enqueue_script( 'wpwt_jqry' );
	wp_enqueue_script( 'wpwt_flot' );
	wp_enqueue_script( 'wpwt_data' );
	echo "<style type='text/css'>\n";
	echo "td.legendLabel { font-size: 9.5px; padding: 5px }\n";
	echo "#pagedata td a, #pagedata td, #tooltip { font-size: 11.5px; padding: 4px 0 0 2px; }\n";
	echo ".highlight { background:#F0F0F0; }\n";
	echo ".normal { background:#FFFFFF; }\n";
	echo "</style>";
}

function wpwt_getchart() {
	$wpwt_account = stripslashes(get_option('wpwt_account'));
	$wpwt_username = stripslashes(get_option('wpwt_username'));
	$wpwt_password = stripslashes(get_option('wpwt_password'));
	$wpwt_profileid = stripslashes(get_option('wpwt_profileid'));
	
	$wpwt_login = $wpwt_account.'\\'.$wpwt_username;
	$wtws_chart = "https://ws.webtrends.com/v2/ReportService.svc/keymetrics/".$wpwt_profileid."/?start_period=current_day-28&end_period=current_day-1&format=json";
	$response_chart = wpwtRequest($wpwt_login, $wpwt_password, $wtws_chart);
	echo $response_chart;
  	die;
}

function wpwt_getpage() {
	$wpwt_account = stripslashes(get_option('wpwt_account'));
	$wpwt_username = stripslashes(get_option('wpwt_username'));
	$wpwt_password = stripslashes(get_option('wpwt_password'));
	$wpwt_profileid = stripslashes(get_option('wpwt_profileid'));
	
	$wpwt_login = $wpwt_account.'\\'.$wpwt_username;
	$wtws_pages = "https://ws.webtrends.com/v2/ReportService/profiles/".$wpwt_profileid."/reports/82b447d2ae34/?start_period=current_day-28&end_period=current_day-1&format=json&range=1*25";
	$response_pages = wpwtRequest($wpwt_login, $wpwt_password, $wtws_pages);
    include_once('getpage.php');
  	die;
}

function wpwt_getoverview() {
	$wpwt_account = stripslashes(get_option('wpwt_account'));
	$wpwt_username = stripslashes(get_option('wpwt_username'));
	$wpwt_password = stripslashes(get_option('wpwt_password'));
	$wpwt_profileid = stripslashes(get_option('wpwt_profileid'));
	
	$wpwt_login = $wpwt_account.'\\'.$wpwt_username;
	$wtws_overview = "http://ws.webtrends.com/v2/ReportService.svc/keymetrics/".$wpwt_profileid."/?start_period=current_day-28&end_period=current_day-1&format=html";
	$response_overview = wpwtRequest($wpwt_login, $wpwt_password, $wtws_overview);
    echo $response_overview;
  	die;
}

	
function wpwt_getprofileid($account, $username, $password, $checked="") {
	$wpwt_login = $account.'\\'.$username;
	$wtws_profile = "https://ws.webtrends.com/v2/ReportService/profiles/?format=json";
	$response_profile = wpwtRequest($wpwt_login, $password, $wtws_profile);
    $profile = json_decode($response_profile, true); 
	if(is_array($profile)) {
		echo "<p><label style=\"width:100px;text-align:right; float:left; display:block\">Profile ID:</label>&nbsp;";
		echo "<select name=\"wpwt_profileid\" id=\"wpwt_profileid\">";
		foreach ($profile as $profileid) {
			echo "<option value=\"".$profileid['ID']."\" ";
			if($profileid['ID']==$checked) {
				echo "selected=\"selected\"";	
			}
			echo ">".$profileid['name']."</option>";
		}
		echo "</select>";
		echo "<p style=\"margin-left:110px; font-size: 11px\"><strong>Congratulations!</strong> We were able to identify your account. Please verify your profile ID.</p>";
	} else {
		echo "<p style=\"margin-left:110px; font-size: 11px; color:red; font-weight:bold\">We were unable to authenticate your account.<br />Please check your Account, Username and Password and try again.</p>";	
	}
}

function wpwt_gettwitter() {
	$rss = fetch_feed('http://twitter.com/statuses/user_timeline/13839372.rss');
	$maxitems = $rss->get_item_quantity(5); 
	$rss_items = $rss->get_items(0, $maxitems); 
	echo "<ul style='list-style:square; margin-left: 20px'>";
	foreach ( $rss_items as $item ) :
		$title = $item->get_title();
		if (substr($title,0,5)!="links") {
			echo "<li>";
			echo substr($title,11,150);
			echo " <a href='".$item->get_permalink()."' title='".$title."' target='_blank'>read&nbsp;&raquo;</a>";
			echo "</li>";
	} endforeach;
	echo "</ul>";
	die;
}

function wpwt_gettwitter2() {
	$rss = fetch_feed('http://twitter.com/statuses/user_timeline/19579223.rss');
	$maxitems = $rss->get_item_quantity(5); 
	$rss_items = $rss->get_items(0, $maxitems); 
	echo "<ul style='list-style:square; margin-left: 20px'>";
	foreach ( $rss_items as $item ) : 
		$title = $item->get_title();
		if (substr($title,0,5)!="links") {
			echo "<li>";
			echo substr($title,15,150);
			echo " <a href='".$item->get_permalink()."' title='".$title."' target='_blank'>read&nbsp;&raquo;</a>";
			echo "</li>";
	} endforeach;
	echo "</ul>";
	die;
}

function wpwt_getblog() {
	$rss = fetch_feed('http://blogs.webtrends.com/feed/');
	$maxitems = $rss->get_item_quantity(5); 
	$rss_items = $rss->get_items(0, $maxitems); 
	echo "<ul style='list-style:square; margin-left: 20px'>";
	foreach ( $rss_items as $item ) :
		$title = $item->get_title();
		if (substr($title,0,5)!="links") {
		echo "<li>";
		echo $title;
		echo " <a href='".$item->get_permalink()."' title='".$title."' target='_blank'>read&nbsp;&raquo;</a>";
		echo "</li>";
	 } endforeach;
	echo "</ul>";
	die;
}

add_action('admin_init', 'wpwt_admin_init');
add_action('admin_menu', 'wpwt_addwebtrends');
add_action('wp_footer','wpwt_code',90);
add_action('wp_ajax_wpwt_getchart', 'wpwt_getchart' );
add_action('wp_ajax_wpwt_getpage', 'wpwt_getpage' );
add_action('wp_ajax_wpwt_getoverview', 'wpwt_getoverview' );
add_action('wp_ajax_wpwt_gettwitter', 'wpwt_gettwitter' );
add_action('wp_ajax_wpwt_gettwitter2', 'wpwt_gettwitter2' );
add_action('wp_ajax_wpwt_getblog', 'wpwt_getblog' );
add_action('admin_header', 'wpwt_javascript');
?>