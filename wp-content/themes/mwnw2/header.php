<!doctype html>
<head>
  <title>Make Web Not War</title>
  
  <link href='http://fonts.googleapis.com/css?family=Lato:300,700' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/normalize.css">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/foundation.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/layout.css">
  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script type="text/javascript" src="//use.typekit.net/hru4gfv.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
  <?php wp_head(); ?>
</head>
<body>
  <nav id="mainNav">
    <div id="moreMenu" class="open">
      <div class="row">
        <div class="large-2 columns test">
          <a href="<?php bloginfo('url'); ?>">
            <img src="<?php bloginfo('template_url'); ?>/images/mwnw-logo.png">
          </a>
        </div>
        <div class="large-10 columns">
          <ul class="large-3 columns">
            <li>
              <h3><a href="<?php bloginfo('url'); ?>/learn">Learn</a></h3>
              <ul>
                <li><a href="<?php bloginfo('url'); ?>/tutorials">Tutorials</a></li>
                <li><a href="<?php bloginfo('url'); ?>/opendata">Open Data</a></li>
                <li><a href="<?php bloginfo('url'); ?>/resources">Resources</a></li>
                <li><a href="<?php bloginfo('url'); ?>/glossary">Glossary</a></li>
              </ul>
            </li>
          </ul>
          <ul class="large-3 columns">
            <h3><a href="<?php bloginfo('url'); ?>/community">Community</a></h3>
            <ul>
              <li><a href="<?php bloginfo('url'); ?>/events">Events</a></li>
              <li><a href="<?php bloginfo('url'); ?>/partners" >Partners</a></li>
            </ul>
          </ul>
          <ul class="large-3 columns">
            <h3>About</h3>
            <ul>
              <li><a href="<?php bloginfo('url'); ?>/mission">Mission</a></li>
              <li><a href="<?php bloginfo('url'); ?>/news">News</a></li>
              <li><a href="<?php bloginfo('url'); ?>/contact">Contact</a></li>
            </ul>
          </ul>
          <ul class="large-3 columns">
            <h3>Search</h3>
            <ul>
              <li>
                
                  <div class="row collapse">
                    <div class="small-10 columns">
                      <input type="text" placeholder="Search">
                    </div>
                    <div class="small-2 columns">
                      <a href="#" class="button prefix">Go</a>
                    </div>
                  </div>
                
              </li>
            </ul>
          </ul>
        </div>
      </div>
    </div>
    <ul class="menu">
      <li><a href="<?php bloginfo('url'); ?>" class="current-menu-item">Home</a></li>
      <li><a href="<?php bloginfo('url'); ?>/learn">Learn</a></li>
      <li><a href="<?php bloginfo('url'); ?>/community">Community</a></li>
      <li><a href="<?php bloginfo('url'); ?>/about">About</a></li>
      <li class="menuMore"><a href="">More<span></span></a></li>
    </ul>
  </nav>