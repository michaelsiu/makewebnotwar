<?php include('header.php'); ?>

<div id="home">
    <header class="topBanner">
        <div class="row">
            <div class="large-12 columns">
                <img src="<?php bloginfo('template_url'); ?>/images/mwnw-logo.png" class="logo">
            </div>
        </div>
        <div class="row">
            <div class="large-6 columns">
                <h1>Open Source.<br/>Open Data.<br/>Open Learning. </h1>
                <h2>Supporting a better and open Web.</h2>
            </div>
            <div class="large-6 columns featured">
                <img src="<?php bloginfo('template_url'); ?>/images/cloud-white.png">
            </div>
        </div>
        <div class="row">
            <ul class="slider">
                <li class="currentSlide"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </header>
    <div id="main">

      <div class="icons">
        <div class="row">
          <div class="large-4 columns">
              <div class="panel">
                <h3>Latest News</h3>
                <?php 
                  $args = array(
                    'posts_per_page' => -1
                  );
                  $query = new WP_Query( $args );
                  if($query->have_posts()):
                ?>
                <ul>
                  <?php
                      while($query->have_posts()): $query->the_post();
                  ?>
                  <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                  <?php
                    endwhile;
                  ?>
                </ul>
                <?php
                    endif;
                  ?>
              </div>
          </div>
          <div class="large-8 columns">
          <div class="row">
            <div class="large-6 columns">
              <div class="large-3 columns">
                <img src="<?php bloginfo('template_url'); ?>/images/icon1.png">
              </div>
              <div class="large-9 columns">
                <h4>Open source learning</h4>
                <p>Ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>

            <div class="large-6 columns">
              <div class="large-3 columns">
                <img src="<?php bloginfo('template_url'); ?>/images/icon2.png">
              </div>
              <div class="large-9 columns">
                <h4>Find open data sets</h4>
                <p>Ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="large-6 columns">
              <div class="large-3 columns">
                <img src="<?php bloginfo('template_url'); ?>/images/icon3.png">
              </div>
              <div class="large-9 columns">
                <h4>Powered by a community</h4>
                <p>Ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
            <div class="large-6 columns">
              <div class="large-3 columns">
                <img src="<?php bloginfo('template_url'); ?>/images/icon1.png">
              </div>
              <div class="large-9 columns">
                <h4>Only 5 Robot Overlords!</h4>
                <p>Ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
        <div class="row">
        <div class="ctaArea">
          <div class="large-12 columns">
            <div class="large-9 columns">
              <p>ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="large-3 columns">
              <a href="#" class="button">Download Cool 2.0</a>
              <a href="#" class="button">Cool Runnings 2.0</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<?php include('footer.php'); ?>