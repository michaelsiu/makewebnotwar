<?php include('header.php'); ?>
<div id="about">
  <header>
    <div class="row">
      <div class="large-10 push-1 columns">
        <h1>Mission</h1>
        <p>
          <img src="<?php bloginfo('template_url'); ?>/images/mission.png">
        </p>
        <p>
          ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia mollit anim id est laborum.
        </p>
      </div>
    </div>
  </header>
  <section id="latest_news">
    <div class="row">
      <div class="large-10 push-1 columns">
        <h2>Latest News</h2>
        <?php
          wp_reset_query();
          $query = new WP_Query(array('posts_per_page' => 2));
          if($query->have_posts()):
            while($query->have_posts()):
              $query->the_post();
        ?>
        <div class="news">
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <p>
              <?php the_date(); ?>
          </p>
          <?php the_excerpt(); ?>
        </div>
        <?php
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </section>
  <section class="contact">
    <div class="row">
      <div class="large-10 push-1 columns">
        <h2>Contact</h2>
        <p>          
          <img src="<?php bloginfo('template_url'); ?>/images/contact.png">
        </p>
        <p>
          ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt anim id est laborum.
        </p>
        <p class="contact_info">
          Email: <a href="mailto:hello@webnotwar.ca">Hello@WebNotWar.ca</a> | Twitter: <a href="http://www.twttier.com/webnotwar">@WebNotWar</a> 
        </p>
      </div>
    </div>
  </section>
  <section class="team">
    <div class="row">
      <div class="large-12 columns">
        <h2>Team</h2>
        <p class="tmpBadge">
          <img src="<?php bloginfo('template_url'); ?>/images/community4.png">
        </p>
      </div>
    </div>
    <div class="row member">
      <div class="large-4 columns">
        <img src="<?php bloginfo('template_url'); ?>/images/profile-female.png">
      </div>
      <div class="large-8 columns">
        <h3>Bonnie Lui</h3>
        <h5>Managing Partner at <a href="http://www.peopleandcode.com" alt="People and Code" target="blank">People &amp; Code</a></h5>
        <p>
          ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <ul>
          <li class="email">Email: <a href="mailto:bonnie@peopleandcode.com" target="blank">bonnie@peopleandcode.com</a></li>
          <li class="twitter">Twitter: <a href="http://www.twitter.com/thebonnielui" target="blank">@thebonnielui</a></li>
        </ul>
      </div>
    </div>
    <div class="row member">
      <div class="large-8 columns">
        <h3>Bryan Xu</h3>
        <h5>Managing Partner at <a href="http://www.ideanotion.net" alt="Idea Notion" target="blank">Idea Notion</a></h5>
        <p>
          ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <ul>
          <li class="email">Email: <a href="mailto:bryan@ideanotion.net" target="blank">bryan@ideanotion.net</a></li>
          <li class="twitter">Twitter: <a href="http://www.twitter.com/_bryanxu" target="blank">@_bryanxu</a></li>
        </ul>
      </div>
      <div class="large-4 columns">
        <img src="<?php bloginfo('template_url'); ?>/images/profile-male-1.png">
      </div>
    </div>
    <div class="row member">
      <div class="large-4 columns">
        <img src="<?php bloginfo('template_url'); ?>/images/profile-male-2.png">
      </div>
      <div class="large-8 columns">
        <h3>Keith Loo</h3>
        <h5>Open Platforms Lead at <a href="http://www.microsoft.com/en-ca/default.aspx" alt="Microsoft Canada" target="blank">Microsoft Canada</a></h5>
        <p>
          ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <ul>
          <li class="email">Email: <a href="mailto:keithloo@microsoft.com" target="blank">keithloo@microsoft.com</a></li>
          <li class="twitter">Twitter: <a href="http://www.twitter.com/thekeithloo" target="blank">@thekeithloo</a></li>
        </ul>
      </div>
    </div>
  </section>
</div>
<?php include('footer.php'); ?>