<?php global $woo_options; ?>
<?php get_header(); ?>

    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">
    
    	<div id="main-sidebar-container">    

            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <div id="main">  
            	<?php woo_loop_before(); ?>
<!-- BUDDYPRESS CODE START -->
<div id="bp">
		
		<form action="" method="post" id="members-directory-form" class="dir-form">
		
			<div class="dir-header">

				<h3><?php _e( 'Members Directory', 'buddypress' ) ?></h3>

				<?php do_action( 'bp_before_directory_members_content' ) ?>

				<div id="members-dir-search" class="dir-search">
					<span><?php _e('Search all members:','buddypress'); ?></span>
					<?php bp_directory_members_search_form() ?>
				</div><!-- #members-dir-search -->
			
				<div class="fix"></div>
				
			</div><!-- /.dir-header -->

			<div class="item-list-tabs">
				<ul>
					<li class="selected" id="members-all">
						<a class="tabFilter" href="<?php bp_root_domain() ?>/<?php echo BP_MEMBERS_SLUG; ?>"><?php printf( __( '<span>All Members</span><strong>(%s)</strong>', 'buddypress' ), bp_get_total_member_count() ) ?></a>
					</li>

					<?php if ( is_user_logged_in() && function_exists( 'bp_get_total_friend_count' ) && bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>
						<li id="members-personal"><a class="tabFilter" href="<?php echo bp_loggedin_user_domain() . BP_FRIENDS_SLUG . '/my-friends/' ?>"><?php printf( __( '<span>My Friends</span><strong>(%s)</strong>', 'buddypress' ), bp_get_total_friend_count( bp_loggedin_user_id() ) ) ?></a></li>
					<?php endif; ?>

					<?php do_action( 'bp_members_directory_member_types' ) ?>

					<li id="members-order-select" class="last filter">

						<?php _e( 'Display', 'buddypress' ) ?>
						<br />
						<select>
							<option value="active"><?php _e( 'Last Active', 'buddypress' ) ?></option>
							<option value="newest"><?php _e( 'Newest Registered', 'buddypress' ) ?></option>

							<?php if ( bp_is_active( 'xprofile' ) ) : ?>
								<option value="alphabetical"><?php _e( 'Alphabetical', 'buddypress' ) ?></option>
							<?php endif; ?>

							<?php do_action( 'bp_members_directory_order_options' ) ?>
						</select>
					</li>
				</ul>
			</div><!-- .item-list-tabs -->

			<div id="members-dir-list" class="members dir-list">
				<?php locate_template( array( 'members/members-loop.php' ), true ) ?>
			</div><!-- #members-dir-list -->

			<?php do_action( 'bp_directory_members_content' ) ?>

			<?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ) ?>

			<?php do_action( 'bp_after_directory_members_content' ) ?>

		</form><!-- #members-directory-form -->

</div><!-- /#bp -->
<!-- BUDDYPRESS CODE END -->
			<?php woo_loop_after(); ?>
            </div><!-- /#main -->
            <?php woo_main_after(); ?>
    
			<?php locate_template( array( 'sidebar.php' ), true ) ?>
	
		</div><!-- /#main-sidebar-container -->         

		<?php locate_template( array( 'sidebar.alt.php' ), true ) ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?>

<?php get_footer(); ?>