<?php
/*-----------------------------------------------------------------------------------

CLASS INFORMATION

Description: A widget to display the BuddyPress login form / user profile.
Date Created: 2011-02-28.
Author: Matty.
Since: 0.07.


TABLE OF CONTENTS

- function Woo_Widget_BPLogin () (constructor)
- function widget ()
- function update ()
- function form ()

- Register the widget on `widgets_init`.

-----------------------------------------------------------------------------------*/

class Woo_Widget_BPLogin extends WP_Widget {

	/*----------------------------------------
	  Woo_Widget_BPLogin()
	  ----------------------------------------
	  
	  * The constructor. Sets up the widget.
	----------------------------------------*/
	
	function Woo_Widget_BPLogin () {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-bplogin', 'description' => __('Displays a login form if the user isn\'t logged in, and the user\'s profile and notices if they are.', 'woothemes' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget-bplogin' );

		/* Create the widget. */
		$this->WP_Widget( 'widget-bplogin', __('Woo - BuddyPress Login / Profile', 'woothemes' ), $widget_ops, $control_ops );
		
	} // End Woo_Widget_BPLogin()

	/*----------------------------------------
	  widget()
	  ----------------------------------------
	  
	  * Displays the widget on the frontend.
	----------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );	
		
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
			
		/* Before widget (defined by themes). */
		echo $before_widget;

		if ( is_user_logged_in() ) {

			do_action( 'bp_before_sidebar_me' );
			
			/* Widget content. */
?>
			<div id="sidebar-me" class="widget">
			<a href="<?php echo bp_loggedin_user_domain() ?>">
				<?php bp_loggedin_user_avatar( 'type=thumb&width=40&height=40' ) ?>
			</a>

			<h4><?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?></h4>
			<a class="logout" href="<?php echo wp_logout_url( bp_get_root_domain() ) ?>"><?php _e( 'Log Out', 'buddypress' ) ?> &rarr;</a>
			
			<div class="fix"></div>
			
			<?php if ( function_exists( 'bp_message_get_notices' ) ) : ?>
				<div class="notices">
					<?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
				</div>
			<?php endif; ?>

			<?php do_action( 'bp_sidebar_me' ) ?>
		</div>
<?php
			do_action( 'bp_after_sidebar_me' );

		} else {
		
?>
		<?php do_action( 'bp_before_sidebar_login_form' ) ?>
		
		<div id="login-widget" class="widget">
<?php
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) { echo $before_title . $title . $after_title; }
?>
			<p id="login-text">
				<?php _e( 'To start connecting please log in first.', 'buddypress' ) ?>
				<?php if ( bp_get_signup_allowed() ) : ?>
					<?php printf( __( ' You can also <a href="%s" title="Create an account">create an account</a>.', 'buddypress' ), site_url( BP_REGISTER_SLUG . '/' ) ) ?>
				<?php endif; ?>
			</p>
			
			<form name="login-form" id="sidebar-login-form" class="standard-form" action="<?php echo site_url( 'wp-login.php', 'login_post' ) ?>" method="post">
			
				<p>
					<label><?php _e( 'Username', 'buddypress' ) ?>
					<input type="text" name="log" id="sidebar-user-login" class="input" value="<?php echo esc_attr(stripslashes($user_login)); ?>" /></label>
				</p>
				
				<p>
					<label><?php _e( 'Password', 'buddypress' ) ?>
					<input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" /></label>
				</p>
				
				<p class="submit">
					<span class="forgetmenot"><label><?php _e( 'Remember Me', 'buddypress' ) ?><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" /></label></span>
			
					<?php do_action( 'bp_sidebar_login_form' ) ?>
					<input class="button" type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e('Log In'); ?>" tabindex="100" />
					<input type="hidden" name="testcookie" value="1" />
				</p>
				
			</form>
		
		</div>

		<?php do_action( 'bp_after_sidebar_login_form' ) ?>
<?php
		
		} // End IF Statement ( is_user_logged_in() )

		/* After widget (defined by themes). */
		echo $after_widget;
		
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
		$defaults = array( 'title' => __('Login', 'woothemes' ) );
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title for "login" form:','woothemes'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>

<?php
	
	} // End form()
	
} // End Class

/*----------------------------------------
  Register the widget on `widgets_init`.
  ----------------------------------------
  
  * Registers this widget.
----------------------------------------*/

add_action( 'widgets_init', create_function( '', 'return register_widget("Woo_Widget_BPLogin");' ), 1 );
?>