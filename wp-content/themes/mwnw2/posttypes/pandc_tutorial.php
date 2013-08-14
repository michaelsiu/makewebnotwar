<?php
// initialize the custom post type
add_action( 'init', 'create_tutorial_post_type', 0 );

function create_tutorial_post_type() {
  // The various labels and button text for the custom post type
  $labels =   array(
    'name' => __( 'Tutorials' ),
    'singular_name' => __( 'Tutorials' ),
    'add_new' => 'Add Tutorial',
    'add_new_item' => 'Add Tutorial',
    'edit_item' => __('Edit Tutorial'),
    'new_item' => 'Tutorial',
    'view_item' => 'View Tutorial',
    'search_items' => 'Search Tutorials',
    'not_found' => 'No Tutorials found',
    'not_found_in_trash' => 'No Tutorials found in Trash'
  );

  // The arguments array for creating the Tutorial custom post type
  $args =   array( 
    'labels' => $labels, 
    'public' => true, 
    'publicly_queryable' => true, 
    'show_ui' => true, 
    'query_var' => true, 
    'rewrite' => array('slug' => 'tutorial', 'with_front' => false),
    'capability_type' => 'post', 
    'hierarchical' => false, 
    'taxonomies' => array('post_tag'),
    'menu_position' => 5, 
    'supports' => array('title', 'thumbnail', 'editor')
  ); 

  // this function registers and actually creates the custom post type
  register_post_type('pandc_tutorial', $args);
}

function pandc_tutorials(){
  $args = array(
    'post_type' => 'pandc_tutorial',
    'posts_per_page' => -1
  );
  $query = new WP_Query($args);
  return $query;
}

function tutorial_info(){
  $meta = get_post_meta(get_the_ID());
  $values = array();
  if($meta){
    foreach($meta as $key => $value){
      $key = str_replace("pandc_tutorial_", "" , $key);
      $values[$key] = $value[0];
    }

    if(!array_key_exists("paid", $values)){
      $values["paid"] = "Free";
    }

    return $values;
  }
  return false;
}

$pandc_metaboxes['pandc_tutorial'] = array(
  array(
    'id' => 'pc_tutorial_details',
    'title' => 'Tutorial Details',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => 'Approved',
        'desc' => 'e.g. August Ember.js Meetup',
        'id' => 'pandc_tutorial_approved',
        'type' => 'checkbox',
        'default' => '0'
      ),
      array(
        'name' => 'Another Check',
        'desc' => 'e.g. August Ember.js Meetup',
        'id' => 'pandc_tutorial_check',
        'type' => 'checkbox',
        'default' => '0'
      )
    )
  )
);

?>