<?php
// initialize the custom post type
add_action( 'init', 'create_glossary_post_type', 0 );

function create_glossary_post_type() {
  // The various labels and button text for the custom post type
  $labels =   array(
    'name' => __( 'Glossary' ),
    'singular_name' => __( 'Glossary' ),
    'add_new' => 'Add New Glossary Entry',
    'add_new_item' => 'Add New Glossary Entry',
    'edit_item' => __('Edit Glossary'),
    'new_item' => 'Glossary',
    'view_item' => 'View Glossary Entry',
    'search_items' => 'Search Glossary',
    'not_found' => 'No Glossary Entry found',
    'not_found_in_trash' => 'No Glossary Entry found in Trash'
  );

  // The arguments array for creating the Glossary custom post type
  $args =   array( 
    'labels' => $labels, 
    'public' => true, 
    'publicly_queryable' => true, 
    'show_ui' => true, 
    'query_var' => true, 
    'rewrite' => array('slug' => 'glossary', 'with_front' => false),
    'capability_type' => 'post', 
    'hierarchical' => false, 
    'taxonomies' => array('post_tag'),
    'menu_position' => 5, 
    'supports' => array('title', 'thumbnail', 'editor')
  ); 

  // this function registers and actually creates the custom post type
  register_post_type('pandc_glossary', $args);
}

function pandc_glossarys(){
  $args = array(
    'post_type' => 'pandc_glossary',
    'posts_per_page' => -1
  );
  $query = new WP_Query($args);
  return $query;
}

function glossary_info(){
  $meta = get_post_meta(get_the_ID());
  $values = array();
  if($meta){
    foreach($meta as $key => $value){
      $key = str_replace("pandc_glossary_", "" , $key);
      $values[$key] = $value[0];
    }

    if(!array_key_exists("paid", $values)){
      $values["paid"] = "Free";
    }

    return $values;
  }
  return false;
}

?>