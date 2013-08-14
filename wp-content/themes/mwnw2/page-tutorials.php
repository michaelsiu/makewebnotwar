<?php include('header.php'); ?>
  <nav id="subNav">
      <ul>
          <li>Tutorials</li>
          <li>Glossary</li>
          <li>Resources</li>
      </ul>
  </nav>
  <div id="learning">
    <div class="row">
      <?php 
        $tutorials = pandc_tutorials();
        if($tutorials->have_posts()):
      ?>
      <div class="large-8 columns">
        <h1>Tutorials</h1>
        <table>
          <thead>
            <tr>
              <th width="200">Title</th>
              <th>Description</th>
              <th width="50">Topic</th>
            </tr>
          </thead>
          <tbody>
      <?php
        while($tutorials->have_posts()): $tutorials->the_post();
          $tutorial_info = tutorial_info();
          if($tutorial_info["approved"]):
      ?>
            <tr>
              <td><a href="<?php the_permalink();?>"><?php the_title(); ?></a></td>
              <td><?php the_excerpt(); ?></td>
              <td><?php the_tags(" ", ", ", ""); ?></td>
            </tr>
      <?php 
          endif;
        endwhile;
      ?>
          </tbody>
        </table>
      <?php
        endif;
      ?>
      </div>
      <div class="large-4 columns">
        <div class="panel">
          <h3>Resources</h3>
           <table>
            <thead>
              <tr>
                <th>Title</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Open Goverment Data Initiative</td>
              </tr>
              <tr>
                <td>Where to find opend data sources</td>
              </tr>
              <tr>
                <td>Title Goes Here Someday Title Goes Here Someday</td>
              </tr>
              <tr>
                <td>Title Goes Here Someday Title Goes Here Someday</td>
              </tr>
              <tr>
                <td>Title Goes Here Someday Title Goes Here Someday</td>
              </tr>
            </tbody>
          </table>
          <a href="#">See More Resources >></a>

        </div>
        <div class="panel callout">
          <h3>Other Stuff</h3>
          <p>
            ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.
          </p>
        </div>
      </div>
    </div>
  </div>
<?php include('footer.php'); ?>