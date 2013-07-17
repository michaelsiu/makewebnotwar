<?php get_header() ?>

    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">
    
    	<div id="main-sidebar-container">    

            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <div id="main">  
            
<!-- BUDDYPRESS CODE START -->
<div id="bp">

			<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>

			<?php do_action( 'bp_before_group_home_content' ) ?>

			<div id="item-header">
				<?php locate_template( array( 'groups/single/group-header.php' ), true ) ?>
			</div>

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav">
					<ul>
						<?php bp_get_options_nav() ?>

						<?php do_action( 'bp_group_options_nav' ) ?>
					</ul>
				</div>
			</div>

			<div id="item-body">
				<?php do_action( 'bp_before_group_body' ) ?>

				<?php if ( bp_is_group_admin_page() && bp_group_is_visible() ) : ?>
					<?php locate_template( array( 'groups/single/admin.php' ), true ) ?>

				<?php elseif ( bp_is_group_members() && bp_group_is_visible() ) : ?>
					<?php locate_template( array( 'groups/single/members.php' ), true ) ?>

				<?php elseif ( bp_is_group_invites() && bp_group_is_visible() ) : ?>
					<?php locate_template( array( 'groups/single/send-invites.php' ), true ) ?>

				<?php elseif ( bp_is_group_forum() && bp_group_is_visible() ) : ?>
					<?php locate_template( array( 'groups/single/forum.php' ), true ) ?>

				<?php elseif ( bp_is_group_membership_request() ) : ?>
					<?php locate_template( array( 'groups/single/request-membership.php' ), true ) ?>

				<?php elseif ( bp_group_is_visible() && bp_is_active( 'activity' ) ) : ?>
					<?php locate_template( array( 'groups/single/activity.php' ), true ) ?>

				<?php elseif ( !bp_group_is_visible() ) : ?>
					<?php /* The group is not visible, show the status message */ ?>

					<?php do_action( 'bp_before_group_status_message' ) ?>

					<div id="message">
						<p class="woo-sc-box note"><?php bp_group_status_message() ?></p>
					</div>

					<?php do_action( 'bp_after_group_status_message' ) ?>

				<?php else : ?>
					<?php
						/* If nothing sticks, just load a group front template if one exists. */
						locate_template( array( 'groups/single/front.php' ), true );
					?>
				<?php endif; ?>

				<?php do_action( 'bp_after_group_body' ) ?>
			</div>

			<?php do_action( 'bp_after_group_home_content' ) ?>

			<?php endwhile; endif; ?>

</div><!-- /#bp -->
<!-- BUDDYPRESS CODE END -->

            </div><!-- /#main -->
            <?php woo_main_after(); ?>
    
			<?php locate_template( array( 'sidebar.php' ), true ) ?>
	
		</div><!-- /#main-sidebar-container -->         

		<?php locate_template( array( 'sidebar.alt.php' ), true ) ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?>

<?php get_footer(); ?>