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

<div class="activity no-ajax">
	<?php if ( bp_has_activities( 'display_comments=threaded&include=' . bp_current_action() ) ) : ?>

		<ul id="activity-stream" class="activity-list item-list">
		<?php while ( bp_activities() ) : bp_the_activity(); ?>

			<?php locate_template( array( 'activity/entry.php' ), true ) ?>

		<?php endwhile; ?>
		</ul>

	<?php endif; ?>
</div>

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

<?php get_footer() ?>