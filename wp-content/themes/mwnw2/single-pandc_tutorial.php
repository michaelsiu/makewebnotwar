<?php include('header.php'); ?>

<div id="tutorial">
  <?php while (have_posts()) : the_post(); ?>
  <div class="row">
    <div class="large-4 columns author">
      <p>
        <img src="<?php bloginfo('template_url'); ?>/images/profile-male-2.png">
      </p>
      <h4><?php the_author(); ?></h4>
      <h5>Techical Partner<br/>at<br/><a href="http://www.peopleandcode.com" alt="People and Code">People &amp; Code</a></h5>
      <ul>
        <li>Email: <a href="mailto:ray@peopleandcode.com">ray@peopleandcode.com</a></li>
        <li>Twitter: <a href="http://www.twitter.com/raykao">@raykao</a></li>
      </ul>
    </div>
    <div class="large-8 columns">
       

      <h2><?php the_title(); ?></h2>
      <h4>By: <?php the_author(); ?>, <?php the_date(); ?></h5>
      <?php the_content(); ?>
    </div>
  </div>
  <?php endwhile; ?>
</div>

<?php include('footer.php'); ?> 