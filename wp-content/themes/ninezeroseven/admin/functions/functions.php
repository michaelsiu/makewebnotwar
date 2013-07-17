<?php


global $data;

// Styling for the custom post type icon
add_action( 'admin_head', 'nzs_custom_type_icons' );
function nzs_custom_type_icons() {
    global $pagenow;

    ?>
    <style type="text/css" media="screen">

	#icon-edit.icon32-posts-page-sections {background: url(<?php echo get_template_directory_uri(); ?>/admin/assets/images/icon-headers32.png) no-repeat;}
   	#icon-edit.icon32-posts-recent_works {background: url(<?php echo get_template_directory_uri(); ?>/admin/assets/images/icon-works32.png) no-repeat;}
   	#icon-edit.icon32-posts-one_page_portfolio {background: url(<?php echo get_template_directory_uri(); ?>/admin/assets/images/icon-portfolio32.png) no-repeat;}
   	#icon-edit.icon32-posts-team_members {background: url(<?php echo get_template_directory_uri(); ?>/admin/assets/images/icon-team32.png) no-repeat;}
   	#icon-edit.icon32-posts-parallax-sections {background: url(<?php echo get_template_directory_uri(); ?>/admin/assets/images/icon-parallax32.png) no-repeat;}

   	td input#nzs_parallax_size{width:60px !important;}

    </style>
    <?php if($pagenow == "nav-menus.php"): ?>

    <script type="text/javascript">

        jQuery(document).ready(function(){

            if(jQuery('#add-page-sections-hide').is(':checked')){
                return
            }else{
                jQuery('.wrap').prepend("<div class='page-section-alert' style='padding:5px;background-color:#FFFFE0;border:1px solid #E6DB55;margin:40px 5px 10px 5px;'><b>Page Sections Menu Not Visible</b><br/>Click on 'Screen Options' in top right corner and check 'Page Sections' for the menu to show up</div>");
            }

            jQuery('#add-page-sections-hide').click(function(){
                if(jQuery('#add-page-sections-hide').is(':checked')){
                    jQuery('.page-section-alert').hide();
                }
            })


        });

    </script>
<?php 
endif;
}

function ul_style_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter('mce_buttons_2', 'ul_style_buttons');

function ul_style_editor_options( $init_array ) {
    $style_formats = array(
        array(
            'title' => 'UL disc', 
            'selector' => 'ul', 
            'classes' => 'disc' 
        ),
        array(
            'title' => 'UL square', 
            'selector' => 'ul', 
            'classes' => 'square'
        )
        ,
        array(
            'title' => 'UL circle', 
            'selector' => 'ul', 
            'classes' => 'circle'
        )
    );
    $init_array['style_formats'] = json_encode( $style_formats );
    return $init_array;
}
add_filter( 'tiny_mce_before_init', 'ul_style_editor_options' );

include( get_template_directory() . '/assets/php/install-plugins.php' );

?>