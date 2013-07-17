<?php
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
 
 global $woo_options;

 woo_footer_top();
 	woo_footer_before();
?>
			<div id="footer" class="col-full">
			
				<?php woo_footer_inside(); ?>    
				
				<div id="bottomMenu" class="col-left">
					<?php if ( function_exists('has_nav_menu') && has_nav_menu('quick-bottom-menu') ) {
						wp_nav_menu( array(
							'theme_location'	=> 'quick-bottom-menu', 
							'menu_class'		=> 'menu', 
							'container'			=> null, 
							'fallback_cb'		=> 'emptymenu_fallback', 
							'separator'			=> '|',
							'depth' 			=> 1,
							'walker'			=> new Custom_Menu()
						) );
					} ?>
					<?php if ( function_exists('has_nav_menu') && has_nav_menu('bottom-menu') ) {
						wp_nav_menu( array(
							'theme_location'	=> 'bottom-menu', 
							'menu_class'		=> 'menu', 
							'container'			=> null, 
							'fallback_cb'		=> 'emptymenu_fallback', 
							'separator'			=> '|',
							'depth' 			=> 1,
							'walker'			=> new Custom_Menu()
						) );
					} ?>
				</div>
				
				<div id="credit" class="col-right">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/images/microsoftPartnerNetwork.gif" />
					<br />
					<?php echo sprintf( __( '&copy; %s Microsoft. All rights reserved. Hosted for Microsoft by iWeb' , 'webnotwar' ) , date('Y') ); ?>
				</div>
				
			</div><!-- /#footer  -->
			
			<?php woo_footer_after(); ?>    
			
			</div><!-- /#wrapper -->
			
			<div class="fix"></div><!--/.fix-->
			
			<?php wp_footer(); ?>
			<?php woo_foot(); ?>
		</div><!-- /#container3 --></div><!-- /#container2 --></div><!-- /#container1 -->
	</body>
</html>