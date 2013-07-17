<?php get_header() ?>

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

		<form action="" method="post" id="groups-directory-form" class="dir-form">
		
			<div class="dir-header">
			
				<h3><?php _e( 'Groups Directory', 'buddypress' ) ?></h3>
				<?php if ( is_user_logged_in() ) : ?><a class="button" href="<?php echo bp_get_root_domain() . '/' . BP_GROUPS_SLUG . '/create/' ?>"><?php _e( 'Create a Group', 'buddypress' ) ?></a><?php endif; ?>

				<?php do_action( 'bp_before_directory_groups_content' ) ?>

				<div id="group-dir-search" class="dir-search">
					<span><?php _e('Search all groups:','buddypress'); ?></span>
					<?php bp_directory_groups_search_form() ?>
				</div><!-- #group-dir-search -->
			
			</div><!-- /.dir-header -->
			
			<div class="fix"></div>
			
			<div class="item-list-tabs">
				<ul>
					<li class="selected" id="groups-all"><a class="tabFilter" href="<?php bp_root_domain() ?>"><?php printf( __( '<span>All Groups</span><strong>(%s)</strong>', 'buddypress' ), bp_get_total_group_count() ) ?></a></li>

					<?php if ( is_user_logged_in() && bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>
						<li id="groups-personal"><a class="tabFilter" href="<?php echo bp_loggedin_user_domain() . BP_GROUPS_SLUG . '/my-groups/' ?>"><?php printf( __( '<span>My Groups</span><strong>(%s)</strong>', 'buddypress' ), bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) ?></a></li>
					<?php endif; ?>

					<?php do_action( 'bp_groups_directory_group_types' ) ?>

					<li id="groups-order-select" class="last filter">

						<?php _e( 'Order By:', 'buddypress' ) ?><br />
						<select>
							<option value="active"><?php _e( 'Last Active', 'buddypress' ) ?></option>
							<option value="popular"><?php _e( 'Most Members', 'buddypress' ) ?></option>
							<option value="newest"><?php _e( 'Newly Created', 'buddypress' ) ?></option>
							<option value="alphabetical"><?php _e( 'Alphabetical', 'buddypress' ) ?></option>

							<?php do_action( 'bp_groups_directory_order_options' ) ?>
						</select>
					</li>
				</ul>
			</div><!-- .item-list-tabs -->

			<div id="groups-dir-list" class="groups dir-list">
				<?php locate_template( array( 'groups/groups-loop.php' ), true ) ?>
			</div><!-- #groups-dir-list -->

			<?php do_action( 'bp_directory_groups_content' ) ?>

			<?php wp_nonce_field( 'directory_groups', '_wpnonce-groups-filter' ) ?>

		</form><!-- #groups-directory-form -->

		<?php do_action( 'bp_after_directory_groups_content' ) ?>

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