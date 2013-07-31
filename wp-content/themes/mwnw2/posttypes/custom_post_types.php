<?php

// load custom metaboxes helpers
if(!class_exists('PCMetaboxes')){
  include_once(dirname(__FILE__).'/../libs/pandc_metaboxes.php');
}

// load custom post types
include_once('pandc_event.php');
include_once('pandc_tutorial.php');


function call_PAndCMetaboxes_add(){
  $metaboxes = new PAndCMetaboxes();
  $metaboxes->metaboxes_add();
}

function call_PAndCMetaboxes_update($post_id){
  $metaboxes = new PAndCMetaboxes();
  $metaboxes->metaboxes_update($post_id);
}

?>