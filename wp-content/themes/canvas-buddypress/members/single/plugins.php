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

			<?php do_action( 'bp_before_member_plugin_template' ) ?>

			<div id="item-header">
				<?php locate_template( array( 'members/single/member-header.php' ), true ) ?>
			</div>

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav">
					<ul>
						<?php bp_get_displayed_user_nav() ?>

						<?php do_action( 'bp_members_directory_member_types' ) ?>
					</ul>
				</div>
			</div>

			<div id="item-body">

				<div class="item-list-tabs no-ajax" id="subnav">
					<ul>
						<?php bp_get_options_nav() ?>
					</ul>
				</div>

				<?php do_action( 'bp_template_content' ) ?>

				<?php do_action( 'bp_directory_members_content' ) ?>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_plugin_template' ) ?>

</div><!-- /#bp -->
<!-- BUDDYPRESS CODE END -->
			<?php woo_loop_after(); ?>
            </div><!-- /#main -->
            <?php woo_main_after(); ?>
    
			<?php locate_template( array( 'sidebar.php' ), true ) ?>
			
		</div><!-- /#main-sidebar-container -->         

		<?php locate_template( array( 'sidebar.alt.php' ), true ) ?>

		<?php do_action( 'bp_after_member_plugin_template' ) ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?>

<?php get_footer(); ?>