<?php
/*-----------------------------------------------------------------------------------

CLASS INFORMATION

Description: A widget to display the BuddyPress forum topic tags on the forum pages.
Date Created: 2011-02-28.
Author: Matty.
Since: 0.07.


TABLE OF CONTENTS

- function Woo_Widget_BPForumTopics () (constructor)
- function widget ()
- function update ()
- function form ()

- Register the widget on `widgets_init`.

-----------------------------------------------------------------------------------*/

class Woo_Widget_BPForumTopics extends WP_Widget {

	/*----------------------------------------
	  Woo_Widget_BPForumTopics()
	  ----------------------------------------
	  
	  * The constructor. Sets up the widget.
	----------------------------------------*/
	
	function Woo_Widget_BPForumTopics () {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-forumtopics', 'description' => __('Displays the BuddyPress forum topic tags on the forum pages.', 'woothemes' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget-bpforumtopics' );

		/* Create the widget. */
		$this->WP_Widget( 'widget-bpforumtopics', __('Woo - BuddyPress Forum Topic Tags', 'woothemes' ), $widget_ops, $control_ops );
		
	} // End Woo_Widget_BPForumTopics()

	/*----------------------------------------
	  widget()
	  ----------------------------------------
	  
	  * Displays the widget on the frontend.
	----------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		/* Show forum tags on the forums directory */
		if ( BP_FORUMS_SLUG == bp_current_component() && bp_is_directory() ) {
		
		echo $before_widget;
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );

			/* Before widget (defined by themes). */
			echo $before_widget;

			/* Display the widget title if one was input (before and after defined by themes). */
			if ( $title ) { echo $before_title . $title . $after_title; }
			
			if ( function_exists('bp_forums_tag_heat_map') ) { ?>
				<div id="tag-text"><?php bp_forums_tag_heat_map(); ?></div>
			<?php } // End IF Statement ?>
		</div>
		<?php
			/* After widget (defined by themes). */
			echo $after_widget;
		
		} // End IF Statement
		
	} // End widget()

	/*----------------------------------------
	  update()
	  ----------------------------------------
	  
	  * Function to update the settings from
	  * the form() function.
	  
	  * Params:
	  * - Array $new_instance
	  * - Array $old_instance
	----------------------------------------*/
	
	function update ( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
		
	} // End update()

	/*----------------------------------------
	  form()
	  ----------------------------------------
	  
	  * The form on the widget control in the
	  * widget administration area.
	  
	  * Make use of the get_field_id() and 
	  * get_field_name() function when creating
	  * your form elements. This handles the confusing stuff.
	  
	  * Params:
	  * - Array $instance
	----------------------------------------*/

	function form ( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Forum Topic Tags', 'woothemes' ) );
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','woothemes'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p><em><?php _e( 'Please note that this widget will only display on the forum pages, if used.', 'woothemes' ); ?></em></p>

<?php
	
	} // End form()
	
} // End Class

/*----------------------------------------
  Register the widget on `widgets_init`.
  ----------------------------------------
  
  * Registers this widget.
----------------------------------------*/

add_action( 'widgets_init', create_function( '', 'return register_widget("Woo_Widget_BPForumTopics");' ), 1 );
?>