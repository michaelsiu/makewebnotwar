<?php 
include( 'nvi.menu.walker.php' );

register_nav_menus( array( 'quick-bottom-menu' => __( 'Bottom Menu 1' ) ) );
register_nav_menus( array( 'bottom-menu' => __( 'Bottom Menu 2' ) ) );

/* Login extras
--------------------------------------------------------------------------------------------- */
function add_custom_login_css (){
	?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/login.css" media="all" />
	<?php 
}
add_action( 'login_head', 'add_custom_login_css', 10 );

/* Layout extras
--------------------------------------------------------------------------------------------- */
add_action( 'woo_head', 'clear_woo_top_navigation', 11 );
add_action( 'woo_top', 'nvi_top_navigation', 11 );
add_filter( 'wp_nav_menu_items' , 'add_home_link' , 10 , 2 );

function clear_woo_top_navigation (){
	remove_action( 'woo_top', 'woo_top_navigation');
}

function nvi_top_navigation (){	
	if ( function_exists('has_nav_menu') && has_nav_menu('top-menu') ) { ?>
	
	<div id="top">
		<div class="col-full">
			<?php 
			wp_nav_menu( array(
				'theme_location'	=> 'top-menu', 
				'menu_id' 			=> 'top-nav',
				'sort_column' 		=> 'menu_order',
				'menu_class'		=> 'menu', 
				'container'			=> 'ul', 
				'fallback_cb'		=> 'emptymenu_fallback', 
				'separator'			=> '|',
				'depth' 			=> 1,
				'walker'			=> new Custom_Menu()
			) );
			?>
		</div>
	</div><!-- /#top -->
	
	<?php 
	}
}

function add_home_link ( $nav , $args ){
	if ( $args->theme_location == 'primary-menu' ){
		$siteUrl 	= home_url( '/' );
		$isCurrent	= $siteUrl == get_permalink();		
		return '<li id="menuHomeItem"' . ( $isCurrent ? ' class="current-menu-item"' : '' ) .'><a href="'.$siteUrl. '"><span>' . __( 'Home' , 'webnotwar' ) . '</span></a></li>' . $nav;
	}
	return $nav;
}

function nvi_get_current_url_classes (){
	$links = explode( '/' , $_SERVER["REQUEST_URI"] );
	foreach ( $links as $iLink => $link ) $links[ $iLink ] = $link ? 'link-' . $link : '';
	return join( ' ' , $links );
}

/* Posts extras
--------------------------------------------------------------------------------------------- */
add_action( 'woo_head', 'clear_woo_conditionals', 11 );
function clear_woo_conditionals (){
	// remove default embed size
	remove_action('woo_post_inside_before','canvas_get_embed');
	add_action('woo_post_inside_before','webnotwar_get_embed');
}

function nvi_the_date (){
	if ( is_page() ) { return; }
	?>
	<div class="post-date">
		<span class="month"><?php echo get_the_date( 'F' ); ?></span>
		<span class="day"><?php echo get_the_date( 'j' ); ?></span>
	</div>
	<?php
}

function nvi_grid_post_meta() {
 	if ( is_page() ) return; 	
 	$post_info = '<span class="small">' . __( 'By', 'webnotwar' ) . '</span> [post_author_posts_link] ' . __( 'in', 'webnotwar' ) . '</span> [post_categories before=""] ' . ' [post_edit]';
	printf( '<div class="post-meta">%s</div>' . "\n", apply_filters( 'woo_filter_post_meta', $post_info ) );
}

function webnotwar_get_embed (){
	$embed = woo_embed( 'width=600&height=400' );
	
	if ( $embed != '' ) {
	?>
	<div class="post-embed">
		<?php echo $embed; ?>
	</div><!-- /.post-embed -->
	<?php 
	}
}

function get_social_icons (){
	?>
	<div class="sharing">
		<!-- google +1 -->
		<g:plusone size="medium" annotation="none"></g:plusone>			
		<!-- twitter -->
		<a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
		<!-- facebook -->
		<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
		<script type="text/javascript">_ga.trackFacebook();</script>
		<fb:like href="<?php echo get_bloginfo( 'url' ) . $_SERVER["REQUEST_URI"]; ?>" send="false" layout="button_count" width="30" show_faces="false"></fb:like>
	</div>
	<?php
}

/* Events templates
--------------------------------------------------------------------------------------------- */
add_action( 'woo_head', 'set_events_templates', 11 );
function set_events_templates (){
	update_option( 'dbem_single_event_format' , get_event_template( 'template-event.php' ) );
	update_option( 'dbem_event_list_item_format' , get_event_template( 'template-eventlist.php' ) );
	update_option( 'dbem_event_list_item_format_header' , get_event_template( 'template-eventlist-head.php' ) );
	update_option( 'dbem_category_page_format' , get_event_template( 'template-category.php' ) );
	update_option( 'dbem_single_location_format' , get_event_template( 'template-location.php' ) );
}

function get_event_template ( $url ){
	ob_start();
	em_locate_template( $url , true );
	$template = ob_get_contents();
	ob_end_clean();
	return $template;
}