<?php 
/* Custom Walker
 *
 * version : 1.0
 * author : Maxime Lefrancois
 * 
 */

// Custom walker : show image is exists
class Custom_Menu extends Walker {
    var $firstElement   = true;
    var $currentDepth   = 0;
	var $selectedDepth	= 0;
    var $selectedBranch = false;
	var $start			= 0;
	var $toggle			= false;
	var $isEmpty		= true;
   
    /**
     * @see Walker::$tree_type
     * @since 3.0.0
     * @var string
     */
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

    /**
     * @see Walker::$db_fields
     * @since 3.0.0
     * @todo Decouple this.
     * @var array
     */
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function start_lvl(&$output, $depth) {
		if ($this->start>0 && ($depth+1 < $this->start || $this->selectedBranch==false)) return;
	   
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    /**
     * @see Walker::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function end_lvl(&$output, $depth) {
		if ($this->start>0 && ($depth+1 < $this->start || $this->selectedBranch==false)) return;
       
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param int $current_page Menu item ID.
     * @param object $args
	 *
	 * Added options :
	 * @param int		start		At what depth should the menu start appearing
	 * @param string	separator	Element that separate the items (any kind of html)
	 * @param string	image_type	To use an image instead of the text, 
	 * @param string	image_path	
     */
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$this->start 	= $args->start;
		$this->toggle	= $args->toggle;

        $class_names = $value = '';

		if ( function_exists( $args->filter ) ) $item = call_user_func_array( $args->filter , array( $item , $args , $depth ) );

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
		// Add the name of the page
		$classes[] = sanitize_title($item->title);
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );


		$class_names = ' class="' . esc_attr( $class_names ) . '"';
       
	   	// Classes that indicate the page being selected or the parent of that page being selected
        $classTriggers = array('current-menu-item', 'current-menu-parent', 'current_menu_item', 'current_menu_parent', 'current-menu-ancestor', 'current_menu_ancestor');
		
		// If the current item got one of the classes in $classTriggers, then this section of the menu is selected
		if (count(array_intersect($item->classes, $classTriggers))>0)        $this->selectedBranch = true;   
		// If a section has already been selected, we have to make sure on the way back in the menu tree that the next sections are not selected
        elseif ($this->selectedBranch == true && ($depth+1) < $this->start)  $this->selectedBranch = false;
				
		// If attribute "start" has been intanciated, make sure to only show the items starting from this depth level under the selected section.
		if ($this->start>0 && ($depth+1 < $this->start || $this->selectedBranch==false)) return;
		
		// Show only to the level selected and his kids, not the kids of the kids
        #$classTriggers = array('current-menu-item', 'current_menu_item');
		#if (count(array_intersect($item->classes, $classTriggers))>0)	$this->selectedDepth = $depth+1;
		//else if ($depth+1 < $this->selectedDepth+1)						$this->selectedDepth = 0;
	
		#echo $this->selectedDepth, ' - ', ($depth+1),'<br>';

		#if ($this->toggle==true && $depth+1 > $this->selectedDepth+2) return;
		
		//if ($this->toggle==true && $this->selectedDepth==true && $depth+2 > $this->selectedDepth) return;
		
		// Filter the $item
		
		
       
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        // Add the separator
        if (!empty($args->separator) && !$this->firstElement){
            $output .= $indent . '<li class="separator">'.$args->separator.'</li>';
        }

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
       
        if (!empty($item->url) && !empty($args->transform)) $item->url = call_user_func($args->transform, $item->url);
       
		// Fix the logout links
		//if ( ! empty( $item->url ) && strpos( $item->url , 'wp-login.php?action=logout' ) > -1 ) $item->url = wp_logout_url( $_SERVER['REQUEST_URI'] );
		
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

	    $item_output 	= $args->before;
        $item_output 	.= '<a'. $attributes .'>';
		
		$imagePath 		= get_bloginfo('template_url') . '/' . $args->image_path . sanitize_title( trim( $item->title ) ) . '.' . $args->image_type;
		$imageRootPath	= 'wp-content/themes/' . basename(get_bloginfo('template_url')) . '/' . $args->image_path . sanitize_title( trim( $item->title ) ) . '.' . $args->image_type;
       	   
	   	if ( ( !empty( $args->image_path ) || !empty( $args->image_type ) ) && file_exists( $imageRootPath ) ){
			$imageClass = '';
			
			if ( !empty( $args->image_class ) || !empty( $args->image_selected_class ) ){
				$isSelected = count( array_intersect( $item->classes , $classTriggers ) ) > 0;
				$imageClass = !empty( $args->image_selected_class ) && $isSelected  ? $args->image_selected_class : ( !empty( $args->image_class ) ? $args->image_class : '' );
				
				if ( !empty( $imageClass ) ) $imageClass = ' class="' . $imageClass . '"';
			}			
			
			$item_output .= $args->link_before . '<img src="'. $imagePath .'"' . $imageClass . '" />' . $args->link_after;
		}else{
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		}
                        
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
   
        if (!$depth) $this->currentDepth = 0;
        $this->firstElement = $this->currentDepth != $depth ? true : false;
        $this->currentDepth = $depth;
		
		$this->isEmpty = false;
    }

    /**
     * @see Walker::end_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     */
    function end_el(&$output, $item, $depth) {
		if ($this->start>0 && ($depth+1 < $this->start || $this->selectedBranch==false)) return;
       
        $output .= "</li>\n";
    }
}

function emptymenu_fallback (){}

?>