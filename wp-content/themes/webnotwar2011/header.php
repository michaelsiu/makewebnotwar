<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
 
 // Setup the tag to be used for the header area (`h1` on the front page and `span` on all others).
 $heading_tag = 'span';
 if ( is_front_page() ) { $heading_tag = 'h1'; }
 
 // Get our website's name, description and URL. We use them several times below so lets get them once.
 $site_title = get_bloginfo( 'name' );
 $site_url = home_url( '/' );
 $site_description = get_bloginfo( 'description' );
 
 global $woo_options;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="all" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Kameron' rel='stylesheet' type='text/css'>

<?php if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); } ?>
<?php wp_head(); ?>
<?php woo_head(); ?>
<!-- Google Analytics Social Button Tracking -->
<script type="text/javascript" src="http://app.tabpress.com/js/ga_social_tracking.js"></script>
<!-- Load Twitter JS-API asynchronously -->
<script>
(function(){
var twitterWidgets = document.createElement('script');
twitterWidgets.type = 'text/javascript';
twitterWidgets.async = true;
twitterWidgets.src = 'http://platform.twitter.com/widgets.js';
// Setup a callback to track once the script loads.
twitterWidgets.onload = _ga.trackTwitter;
document.getElementsByTagName('head')[0].appendChild(twitterWidgets);
})();
</script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
</head>
<body <?php body_class( nvi_get_current_url_classes() ); ?>>
	<!-- START OF SmartSource Data Collector TAG -->
	<!-- Copyright (c) 1996-2009 WebTrends Inc.  All rights reserved. -->
	<!-- Version: MS.3.0.0 -->
	<script src="http://js.microsoft.com/library/mnp/2/wt/js/wt.js" type="text/javascript"></script>
	
	<!-- ----------------------------------------------------------------------------------- -->
	<!-- Warning: The two script blocks below must remain inline. Moving them to an external -->
	<!-- JavaScript include file can cause serious problems with cross-domain tracking.      -->
	<!-- ----------------------------------------------------------------------------------- -->
	<script type="text/javascript">
	//<![CDATA[
	var _tag=new WebTrends();
	_tag.dcsid="dcsw88y810000004f23t1fg6o_7w5b";
	// _tag.fpcdom=".domain.com";
	_tag.dcsGetId();
	_tag.trackevents=true;
	//]]>>
	</script>
	
	<script type="text/javascript">
	//<![CDATA[
	// Add custom parameters here.
	//_tag.DCSext.param_name=param_value;
	_tag.dcsCollect();
	//]]>>
	</script>
	
	<noscript>
	<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="//m.webtrends.com/dcsgsg5i910000g0r58g2aocx_8t7f/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=MS.3.0.0"/></div>
	</noscript>
	<!-- END OF SmartSource Data Collector TAG -->

	<div id="container1"><div id="container2"><div id="container3">
		
		<?php woo_top(); ?>
		
		<div id="wrapper">        
			<div id="header" class="col-full">
				<?php woo_header_before(); ?>
				
				<?php woo_header_inside(); ?>	
						   	
				<div class="logo">
					<?php 
					// Website heading/logo and description text.
					$logoUrl = isset($woo_options['woo_logo']) && $woo_options['woo_logo'] ? $woo_options['woo_logo'] : get_bloginfo('stylesheet_directory') . '/images/logo.png' ;
					echo '<a href="' . $site_url . '" title="' . $site_description . '"><img src="' . $logoUrl . '" alt="' . $site_title . '" /></a>' . "\n";
					?>
				</div>
				
				<div class="mainMenu">
					<?php if ( $site_description ) { echo '<span class="site-description">' . $site_description . '</span>' . "\n"; } ?>
					
					<?php woo_header_after(); ?>					
				</div>					   
			</div><!-- /#header -->
