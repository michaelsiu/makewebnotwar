<?php
/**
 * Magazine Featured Content Template
 *
 * This template is used for the posts in the featured area on the
 * "Magazine" page template.
 *
 * @package WooFramework
 * @subpackage Template
 */

/**
 * Settings for this template file.
 *
 * This is where the specify the HTML tags for the title.
 * These options can be filtered via a child theme.
 *
 * @link http://codex.wordpress.org/Plugin_API#Filters
 */
 
 global $woo_options;
 
 $title_before = '<h2 class="title"><a href="' . get_permalink( get_the_ID() ) . '" rel="bookmark" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
 $title_after = '</a></h2>';
 
 $page_link_args = apply_filters( 'woothemes_pagelinks_args', array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) );
 
 woo_post_before();
?>
<div <?php post_class(); ?>>
<?php
	woo_post_inside_before();
	
	if ( ( ( isset($woo_options['woo_magazine_b_w']) ) && ( ( $woo_options['woo_magazine_b_w'] <= 0 ) || ( $woo_options['woo_magazine_b_w'] == '')  ) ) || ( !isset($woo_options['woo_magazine_b_w']) ) ) {	$woo_options['woo_magazine_b_w'] = '100'; }
	if ( ( isset($woo_options['woo_magazine_b_h']) ) && ( $woo_options['woo_magazine_b_h'] <= 0 )  ) { $woo_options['woo_magazine_b_h'] = '100'; }
	
	woo_image('width='.$woo_options['woo_magazine_b_w'].'&height='.$woo_options['woo_magazine_b_h'].'&class=thumbnail '.$woo_options['woo_magazine_b_align']);
		
	the_title( $title_before, $title_after );
	
	woo_post_meta();
?>
	<div class="entry">
	    <?php
	    	the_excerpt();
	    ?>
	</div><!-- /.entry -->
<?php
	woo_post_inside_after();
?>
</div><!-- /.post -->
<?php
	woo_post_after();
?>