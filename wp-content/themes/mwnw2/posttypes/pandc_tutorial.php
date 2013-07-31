<?php

// initialize the custom post type
add_action( 'init', 'create_tutorial_post_type', 0 );
// add custom meta boxes
add_action( 'add_meta_boxes', 'call_PAndCMetaboxes_add');  
add_action('save_post', 'call_PAndCMetaboxes_update');

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
    'menu_position' => 5, 
    'supports' => array('title', 'thumbnail')
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
        'name' => 'Name:',
        'desc' => 'e.g. August Ember.js Meetup',
        'id' => 'pandc_tutorial_name',
        'type' => 'text',
        'default' => ''
      ),
      array(
        'name' => 'Location:',
        'desc' => 'e.g. People And Code, 26 Soho Street Unit 350, Toronto, Ontario, CANADA, M5T 1A8',
        'id' => 'pandc_tutorial_location',
        'type' => 'text',
        'default' => ''
      ),
      array(
        'name'    => 'City:',
        'desc'    => 'e.g. Toronto',
        'id'      => 'pandc_tutorial_city',
        'type'    => 'text',
        'default' => ''
      ),
      array(
        'name' => 'Type:',
        'desc' => 'e.g. Meetup/Workshop/Social etc.',
        'id' => 'pandc_tutorial_type',
        'type' => 'text',
        'default' => 'Meetup'
      ),
      array(
        'name' => 'Tutorial Date:',
        'desc' => 'eg. Aug 20th, 2013 @7:30pm',
        'id' => 'pandc_tutorial_date',
        'type' => 'text',
        'default' => ''
      ),
      array(
        'name' => 'Paid Tutorial?',
        'desc' => 'Is this a paid tutorial?',
        'id' => 'pandc_tutorial_paid',
        'type' => 'radio',
        'options' => array(
          array(
            'name' => 'Paid',
            'value' => 'Paid'
          ),
          array(
            'name' => 'Free',
            'value' => 'Free'
          ),
        )
      ),
      array(
        'name' => 'Tutorial URL:',
        'desc' => 'e.g. http://www.meetup.com/Mobile-Startups-TO/tutorials/104501262/',
        'id' => 'pandc_tutorial_url',
        'type' => 'text',
        'default' => ''
      )
    )
  )
);

// the $meta_box array for each new custom post type created in this plugin.  Multi dimentional array - first level is the meta_box - second level is the custom field.



?>