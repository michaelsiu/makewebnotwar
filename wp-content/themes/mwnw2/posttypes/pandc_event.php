<?php

// initialize the custom post type
add_action( 'init', 'create_event_post_type', 0 );
// add custom meta boxes
add_action( 'add_meta_boxes', 'call_PAndCMetaboxes_add');  
add_action('save_post', 'call_PAndCMetaboxes_update');

function create_event_post_type() {
  // The various labels and button text for the custom post type
  $labels =   array(
    'name' => __( 'Events' ),
    'singular_name' => __( 'Events' ),
    'add_new' => 'Add Event',
    'add_new_item' => 'Add Event',
    'edit_item' => __('Edit Event'),
    'new_item' => 'Event',
    'view_item' => 'View Event',
    'search_items' => 'Search Events',
    'not_found' => 'No Events found',
    'not_found_in_trash' => 'No Events found in Trash'
  );

  // The arguments array for creating the Event custom post type
  $args =   array( 
    'labels' => $labels, 
    'public' => true, 
    'publicly_queryable' => true, 
    'show_ui' => true, 
    'query_var' => true, 
    'rewrite' => array('slug' => 'event', 'with_front' => false),
    'capability_type' => 'post', 
    'hierarchical' => false, 
    'menu_position' => 5, 
    'supports' => array('title', 'thumbnail')
  ); 

  // this function registers and actually creates the custom post type
  register_post_type('pandc_event', $args);
}

function pandc_events(){
  $args = array(
    'post_type' => 'pandc_event',
    'posts_per_page' => -1
  );
  $query = new WP_Query($args);
  return $query;
}

function event_info(){
  $meta = get_post_meta(get_the_ID());
  $values = array();
  if($meta){
    foreach($meta as $key => $value){
      $key = str_replace("pandc_event_", "" , $key);
      $values[$key] = $value[0];
    }

    if(!array_key_exists("paid", $values)){
      $values["paid"] = "Free";
    }

    return $values;
  }
  return false;
}

$pandc_metaboxes['pandc_event'] = array(
  array(
    'id' => 'pc_event_details',
    'title' => 'Event Details',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => 'Approved',
        'desc' => 'e.g. August Ember.js Meetup',
        'id' => 'pandc_event_approved',
        'type' => 'checkbox',
        'default' => '0'
      ),
      array(
        'name' => 'Name:',
        'desc' => 'e.g. August Ember.js Meetup',
        'id' => 'pandc_event_name',
        'type' => 'text',
        'default' => ''
      ),
      array(
        'name' => 'Location:',
        'desc' => 'e.g. People And Code, 26 Soho Street Unit 350, Toronto, Ontario, CANADA, M5T 1A8',
        'id' => 'pandc_event_location',
        'type' => 'text',
        'default' => ''
      ),
      array(
        'name'    => 'City:',
        'desc'    => 'e.g. Toronto',
        'id'      => 'pandc_event_city',
        'type'    => 'text',
        'default' => ''
      ),
      array(
        'name' => 'Type:',
        'desc' => 'e.g. Meetup/Workshop/Social etc.',
        'id' => 'pandc_event_type',
        'type' => 'text',
        'default' => 'Meetup'
      ),
      array(
        'name' => 'Event Date:',
        'desc' => 'eg. Aug 20th, 2013 @7:30pm',
        'id' => 'pandc_event_date',
        'type' => 'text',
        'default' => ''
      ),
      array(
        'name' => 'Paid Event?',
        'desc' => 'Is this a paid event?',
        'id' => 'pandc_event_paid',
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
        'name' => 'Event URL:',
        'desc' => 'e.g. http://www.meetup.com/Mobile-Startups-TO/events/104501262/',
        'id' => 'pandc_event_url',
        'type' => 'text',
        'default' => ''
      )
    )
  )
);

// the $meta_box array for each new custom post type created in this plugin.  Multi dimentional array - first level is the meta_box - second level is the custom field.



?>