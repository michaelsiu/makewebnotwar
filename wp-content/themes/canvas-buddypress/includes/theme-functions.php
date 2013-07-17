<?php
/**
 * Generates the BuddyPress breadcrumbs
 *
 * @global Object $bp The BuddyPress $bp object
 * @since 0.15
 * @param array $trail A reference to the trail array from the above function
 * @return array
 */
 
 add_filter( 'woo_breadcrumbs', 'woo_bp_breadcrumbs' );
 
 function woo_bp_breadcrumbs ( $breadcrumb ) {
 
 	global $bp;
 	
 	/* Get the text domain. */
	$textdomain = 'woothemes';

	/* Create an empty array for the trail. */
	$trail = array();
	$path = '';

	/* Set up the default arguments for the breadcrumb. */
	$defaults = array(
		'separator' => '&raquo;',
		'before' => '<span class="breadcrumb-title">' . __( 'You are here:', $textdomain ) . '</span>',
		'after' => false,
		'front_page' => true,
		'show_home' => __( 'Home', $textdomain ),
		'echo' => true
	);

	/* Allow singular post views to have a taxonomy's terms prefixing the trail. */
	if ( is_singular() )
		$defaults["singular_{$wp_query->post->post_type}_taxonomy"] = false;

	/* Apply filters to the arguments. */
	$args = apply_filters( 'woo_breadcrumbs_args', $args );

	/* Parse the arguments and extract them for easy variable naming. */
	extract( wp_parse_args( $args, $defaults ) );
 	
 	if ( ! empty( $bp->displayed_user->fullname ) ) { // looking at a user or self
		$trail[] = '<a href="'. $bp->displayed_user->domain .'" title="'. strip_tags( $bp->displayed_user->userdata->display_name) .'">'. strip_tags( $bp->displayed_user->userdata->display_name ) .'</a>';
		// if we have multi-level nesting
		if (bp_loggedin_user_id() && bp_displayed_user_id() == bp_loggedin_user_id() || $bp->current_component == 'activity'){
			if (is_numeric($bp->current_action)) {
				$trail['trail_end'] = ucwords($bp->current_component);
			} else {
				$trail[] = '<a href="'. $bp->displayed_user->domain . $bp->current_component .'" title="'. ucwords($bp->current_component) .'">'. ucwords($bp->current_component) .'</a>';
				if($bp->current_action == 'just-me') {
					$trail['trail_end'] = __('Personal', $text_domain);
				} else {
					$trail['trail_end'] = ucwords( str_replace('-', ' ', $bp->current_action ) );
				}
			}
		} else {
	 		$trail['trail_end'] =  ucwords( $bp->current_component );
		}
	} else if ( $bp->is_single_item ) { // we're on a single item page
		$trail[] = '<a href="/'. $bp->current_component .'" title="'. ucwords( $bp->current_component ) .'">'. ucwords( $bp->current_component ) .'</a>';
		$trail[] = '<a href="/'. $bp->current_component .'/'. $bp->current_item .'" title="'.$bp->bp_options_title.'">'. $bp->bp_options_title .'</a>';
		// this *should* contain the name but it seems that the nab array hasn't yet been sorted so we need to resort to looking for the name value ourselves
		$trail_name = $bp->bp_options_nav[$bp->current_component][$bp->current_action]['name'];
		if(!$trail_name) {
			foreach($bp->bp_options_nav[$bp->current_component] as $value) {
				if ($value['slug'] == $bp->current_action) {
					$trail_name = $value['name'];
					break;
				}
			}
		}
		if ($bp->action_variables) {
			$trail[] = '<a href="/'. $bp->current_component . '/' . $bp->current_item . '/' . $bp->current_action .'" title="'. ucwords($bp->current_action) .'">'. ucwords($bp->current_action) .'</a>';
			$trail['trail_end'] = ucwords( str_replace('-', ' ', $bp->action_variables[0]) );
		} else {
			$trail['trail_end'] = $trail_name;
		}
	} else if ( $bp->is_directory ) { // this is a top level directory page
		if ( !$bp->current_component )
			$trail['trail_end'] = sprintf( __( '%s Directory', $text_domain ), ucwords( BP_MEMBERS_SLUG ) );
		else
			 $trail['trail_end'] = sprintf( __( '%s Directory', $text_domain ), ucwords( $bp->current_component ) );
	} else if ( bp_is_register_page() ) {
		$trail['trail_end'] = __( 'Create an Account', $text_domain );
	} else if ( bp_is_activation_page() ) {
		$trail['trail_end'] = __( 'Activate your Account', $text_domain );
	} else if ( bp_is_group_create() ) {
		$trail[] = '<a href="/'. $bp->current_component .'" title="'. ucwords($bp->current_component) .'">'. ucwords($bp->current_component) .'</a>';
		if ($bp->action_variables) {
			$trail[] = '<a href="/'. $bp->current_component . '/' . $bp->current_action .'" title="'. __( 'Create a Group', $text_domain ) .'">'. __( 'Create a Group', $text_domain ) .'</a>';
			$trail['trail_end'] = ucwords( str_replace('-', ' ', $bp->action_variables[1]) );
		} else {
			$trail['trail_end'] = __( 'Create a Group', $text_domain );
		}
	} else if ( bp_is_create_blog() ) {
		$trail[] = '<a href="/'. $bp->current_component .'" title="'. ucwords($bp->current_component) .'">'. ucwords($bp->current_component) .'</a>';
		$trail['trail_end'] = __( 'Create a Blog', $text_domain );
	}
 
 	/* Connect the breadcrumb trail if there are items in the trail. */
	if ( is_array( $trail ) && count( $trail ) > 0 ) {

		/* Open the breadcrumb trail containers. */
		$breadcrumb = '<div class="breadcrumb breadcrumbs woo-breadcrumbs"><div class="breadcrumb-trail">';

		/* If $before was set, wrap it in a container. */
		if ( !empty( $before ) )
			$breadcrumb .= '<span class="trail-before">' . $before . '</span> ';

		/* Wrap the $trail['trail_end'] value in a container. */
		if ( !empty( $trail['trail_end'] ) )
			$trail['trail_end'] = '<span class="trail-end">' . $trail['trail_end'] . '</span>';

		/* Format the separator. */
		if ( !empty( $separator ) )
			$separator = '<span class="sep">' . $separator . '</span>';

		/* Join the individual trail items into a single string. */
		$breadcrumb .= join( " {$separator} ", $trail );

		/* If $after was set, wrap it in a container. */
		if ( !empty( $after ) )
			$breadcrumb .= ' <span class="trail-after">' . $after . '</span>';

		/* Close the breadcrumb trail containers. */
		$breadcrumb .= '</div></div>';
	}
 
 	return $breadcrumb;
 
 } // End woo_bp_breadcrumbs()
?>