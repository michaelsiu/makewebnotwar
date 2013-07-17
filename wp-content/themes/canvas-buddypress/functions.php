<?php

// Stop the theme from killing WordPress if BuddyPress is not enabled.
if ( !class_exists( 'BP_Core_User' ) ) {

	add_action('woo_header_inside', 'no_bp_plugin_installed');
	return false;
}
function no_bp_plugin_installed() {
	echo do_shortcode('[box type="note"]You need to <a href=\"http://buddypress.org/download/\">install and activate the BuddyPress plugin</a> for this theme to work![/box]');
}

// Load text domain for translation
load_theme_textdomain('buddypress');
load_theme_textdomain('buddypress', get_stylesheet_directory() . '/lang');

/*-----------------------------------------------------------------------------------*/
/* BuddyPress */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_bp_init') ) { 
	function woo_bp_init() { 
		global $wp_themes;
	
		/* Check to make sure the active theme is not bp-default */
		if ( 'bp-default' == get_option( 'template' ) )
			return false;
			
		/* Load the default BuddyPress javascript */
		wp_enqueue_script( 'bp-js', BP_PLUGIN_URL . '/bp-themes/bp-default/_inc/global.js', array( 'jquery' ) );
		
		/* Load the general JS file */
		wp_enqueue_script( 'general-js', get_stylesheet_directory_uri() . '/includes/js/general.js', array( 'jquery' ) );
	
		/* Add the wireframe BP page styles */
		wp_enqueue_style( 'bp-css', BP_PLUGIN_URL . '/bp-themes/bp-default/_inc/css/adminbar.css' );
	}
}

// Cater for newer version of Canvas, running the locate_template() function.
require_once ( get_template_directory() . '/includes/theme-functions.php' ); 	// Theme-specific functions from main Canvas theme (Canvas BuddyPress version gets loaded via locate_template() in Canvas)

require_once (STYLESHEETPATH . '/includes/ajax.php'); 		// BuddyPress Ajax Options

// Register custom BuddyPress widgets.
require_once (STYLESHEETPATH . '/includes/widgets/widget-woo-bplogin.php'); 			// Woo BuddyPress login widget
require_once (STYLESHEETPATH . '/includes/widgets/widget-woo-bpforumtopics.php'); 		// Woo BuddyPress forum topic tags widget
require_once (STYLESHEETPATH . '/includes/theme-functions.php'); 						// Theme-Specific Functions

// Test if BuddyPress plugin is installed
if (function_exists("bp_core_is_multisite")) 
	add_action( 'init', 'woo_bp_init' );

/*-----------------------------------------------------------------------------------*/
/* ADD CUSTOM FUNCTIONS BELOW */
/*-----------------------------------------------------------------------------------*/

/**
 * Filter the dropdown for selecting the page to show on front to include "Activity Stream"
 *
 * @param string $page_html A list of pages as a dropdown (select list)
 * @see wp_dropdown_pages()
 * @return string
 * @package BuddyPress Theme
 * @since 1.2
 */
function bp_dtheme_wp_pages_filter( $page_html ) {
	if ( !bp_is_active( 'activity' ) )
		return $page_html;

	if ( 'page_on_front' != substr( $page_html, 14, 13 ) )
		return $page_html;

	$selected = false;
	$page_html = str_replace( '</select>', '', $page_html );

	if ( bp_dtheme_page_on_front() == 'activity' )
		$selected = ' selected="selected"';

	$page_html .= '<option class="level-0" value="activity"' . $selected . '>' . __( 'Activity Stream', 'buddypress' ) . '</option></select>';
	return $page_html;
}
add_filter( 'wp_dropdown_pages', 'bp_dtheme_wp_pages_filter' );

// Member Buttons
add_action( 'bp_member_header_actions',    'bp_add_friend_button' );
add_action( 'bp_member_header_actions',    'bp_send_public_message_button' );
add_action( 'bp_member_header_actions',    'bp_send_private_message_button' );

// Group Buttons
add_action( 'bp_group_header_actions',     'bp_group_join_button' );
add_action( 'bp_group_header_actions',     'bp_group_new_topic_button' );
add_action( 'bp_directory_groups_actions', 'bp_group_join_button' );


/**
 * Hijack the saving of page on front setting to save the activity stream setting
 *
 * @param $string $oldvalue Previous value of get_option( 'page_on_front' )
 * @param $string $oldvalue New value of get_option( 'page_on_front' )
 * @return string
 * @package BuddyPress Theme
 * @since 1.2
 */
function bp_dtheme_page_on_front_update( $oldvalue, $newvalue ) {
	if ( !is_admin() || !is_super_admin() )
		return false;

	if ( 'activity' == $_POST['page_on_front'] )
		return 'activity';
	else
		return $oldvalue;
}
add_action( 'pre_update_option_page_on_front', 'bp_dtheme_page_on_front_update', 10, 2 );

/**
 * Load the activity stream template if settings allow
 *
 * @param string $template Absolute path to the page template 
 * @return string
 * @global WP_Query $wp_query WordPress query object
 * @package BuddyPress Theme
 * @since 1.2
 */
function bp_dtheme_page_on_front_template( $template ) {
	global $wp_query;

	if ( empty( $wp_query->post->ID ) )
		return locate_template( array( 'activity/index.php' ), false );
	else
		return $template;
}
add_filter( 'page_template', 'bp_dtheme_page_on_front_template' );

/**
 * Return the ID of a page set as the home page.
 *
 * @return false|int ID of page set as the home page
 * @package BuddyPress Theme
 * @since 1.2
 */
function bp_dtheme_page_on_front() {
	if ( 'page' != get_option( 'show_on_front' ) )
		return false;

	return apply_filters( 'bp_dtheme_page_on_front', get_option( 'page_on_front' ) );
}

/**
 * Force the page ID as a string to stop the get_posts query from kicking up a fuss.
 *
 * @global WP_Query $wp_query WordPress query object
 * @package BuddyPress Theme
 * @since 1.2
 */
function bp_dtheme_fix_get_posts_on_activity_front() {
	global $wp_query;

	if ( !empty($wp_query->query_vars['page_id']) && 'activity' == $wp_query->query_vars['page_id'] )
		$wp_query->query_vars['page_id'] = '"activity"';
}
add_action( 'pre_get_posts', 'bp_dtheme_fix_get_posts_on_activity_front' );

/**
 * WP 3.0 requires there to be a non-null post in the posts array
 *
 * @param array $posts Posts as retrieved by WP_Query
 * @global WP_Query $wp_query WordPress query object
 * @return array
 * @package BuddyPress Theme
 * @since 1.2.5
 */
function bp_dtheme_fix_the_posts_on_activity_front( $posts ) {
	global $wp_query;

	// NOTE: the double quotes around '"activity"' are thanks to our previous function bp_dtheme_fix_get_posts_on_activity_front()
	if ( empty( $posts ) && !empty( $wp_query->query_vars['page_id'] ) && '"activity"' == $wp_query->query_vars['page_id'] )
		$posts = array( (object) array( 'ID' => 'activity' ) );

	return $posts;
}
add_filter( 'the_posts', 'bp_dtheme_fix_the_posts_on_activity_front' );

/*-----------------------------------------------------------------------------------*/
/* Navigation */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_nav')) {
	function woo_nav() { 
	global $woo_options;
	?>
	
	<?php woo_nav_before(); ?>
	
	<div id="navigation" class="col-full">
		
		<?php woo_nav_inside(); ?>
		<?php
		if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
			wp_nav_menu( array( 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
		} else {
		?>
		<ul id="main-nav" class="nav fl">
			<?php 
			if ( get_option('woo_custom_nav_menu') == 'true' ) {
				if ( function_exists('woo_custom_navigation_output') )
					woo_custom_navigation_output("name=Woo Menu 1");
	
			} else { ?>
				
				<?php if ( is_page() ) $highlight = "page_item"; else $highlight = "page_item current_page_item"; ?>
				<li class="<?php echo $highlight; ?>"><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'buddypress') ?></a></li>
				
				<?php if ( bp_is_active( 'activity' ) ) : ?>
					<li<?php if ( bp_is_page( BP_ACTIVITY_SLUG ) ) : ?> class="selected"<?php endif; ?>>
						<a href="<?php echo site_url() ?>/<?php echo BP_ACTIVITY_SLUG ?>/" title="<?php _e( 'Activity', 'buddypress' ) ?>"><?php _e( 'Activity', 'buddypress' ) ?></a>
					</li>
				<?php endif; ?>

				<li<?php if ( bp_is_page( BP_MEMBERS_SLUG ) || bp_is_member() ) : ?> class="selected"<?php endif; ?>>
					<a href="<?php echo site_url() ?>/<?php echo BP_MEMBERS_SLUG ?>/" title="<?php _e( 'Members', 'buddypress' ) ?>"><?php _e( 'Members', 'buddypress' ) ?></a>
				</li>

				<?php if ( bp_is_active( 'groups' ) ) : ?>
					<li<?php if ( bp_is_page( BP_GROUPS_SLUG ) || bp_is_group() ) : ?> class="selected"<?php endif; ?>>
						<a href="<?php echo site_url() ?>/<?php echo BP_GROUPS_SLUG ?>/" title="<?php _e( 'Groups', 'buddypress' ) ?>"><?php _e( 'Groups', 'buddypress' ) ?></a>
					</li>

					<?php if ( bp_is_active( 'forums' ) && ( function_exists( 'bp_forums_is_installed_correctly' ) && !(int) bp_get_option( 'bp-disable-forum-directory' ) ) && bp_forums_is_installed_correctly() ) : ?>
						<li<?php if ( bp_is_page( BP_FORUMS_SLUG ) ) : ?> class="selected"<?php endif; ?>>
							<a href="<?php echo site_url() ?>/<?php echo BP_FORUMS_SLUG ?>/" title="<?php _e( 'Forums', 'buddypress' ) ?>"><?php _e( 'Forums', 'buddypress' ) ?></a>
						</li>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( bp_is_active( 'blogs' ) && bp_core_is_multisite() ) : ?>
					<li<?php if ( bp_is_page( BP_BLOGS_SLUG ) ) : ?> class="selected"<?php endif; ?>>
						<a href="<?php echo site_url() ?>/<?php echo BP_BLOGS_SLUG ?>/" title="<?php _e( 'Blogs', 'buddypress' ) ?>"><?php _e( 'Blogs', 'buddypress' ) ?></a>
					</li>
				<?php endif; ?>
				
				<?php wp_list_pages('sort_column=menu_order&depth=6&title_li=&exclude='); ?>
	
			<?php } ?>
		</ul><!-- /#nav -->
		<?php } ?>		
	</div><!-- /#navigation -->
	
	<?php woo_nav_after(); ?>
	
	<?php 
	}
}


/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
?>