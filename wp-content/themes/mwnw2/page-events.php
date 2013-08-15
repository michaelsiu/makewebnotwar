<?php include('header.php'); ?>
<nav id="subNav">
    <ul>
        <li>Events</li>
        <li>Partners</li>
    </ul>
</nav>

<div id="events">

  <div class="row">
    <div class="large-12 columns">      
      <h1>Events</h1>
      <span class="right"><a href="#" class="small button success">Submit an Event</a></span>
      <p>Find a technology event in your city.</p>
      <div class="row collapse">
        <div class="small-10 columns">
          <input type="text" placeholder="Find an event by name, city, topic or date">
        </div>
        <div class="small-2 columns">
          <a href="#" class="button prefix">Go!</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="large-12 columns">
      <h2 class="month"><a href="#">&lt;&lt;</a> July <a href="#">&gt;&gt;</a></h2>
    </div>
  </div>

  <div class="row">
    <div class="large-12 columns">
      <h6>Upcoming Events</h6>
      <?php 
        $args = array(
          'post_type' => 'pandc_event',
          'orderby' => 'meta_value',
          'meta_key' => 'pandc_event_approved', 
          'posts_per_page' => -1
        );
        $query = new WP_Query($args);
        if($query->have_posts()): 
      ?>
      <table>
        <thead>
          <tr>
            <th>Event</th>
            <th>Location</th>
            <th>City</th>
            <th>Topic</th>
            <th>Type</th>
            <th></th>
            <th>Date</th>
            <th>More info</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            while($query->have_posts()): 
              $query->the_post();
              $event_info = event_info();
              if($event_info["approved"]):
          ?>
            <tr>
              <td>
                <a href="<?php echo $event_info["url"]; ?>" target="blank">
                  <?php echo $event_info["name"]; ?>
                </a>
              </td>
              <td>
                <a href="http://maps.bing.com/?q=<?php echo $event_info['query_address']; ?>" alt="<?php echo $event_info['location_name']; ?>" target="blank">
                  <?php echo $event_info["formatted_address"]; ?>
                </a>
              </td>
              <td>
                <?php echo $event_info["city"]; ?>
              </td>
              <td>
                <?php echo $event_info["topic"]; ?>
              </td>
              <td>
                <?php echo $event_info["type"]; ?>
              </td>
              <td>
                <span class='label <?php echo($event_info["paid"] === "Paid") ? "secondary" : ""; ?>'>
                  <?php echo $event_info["paid"]; ?>
                </span>
              </td>
              <td>
                <?php echo $event_info["date"]; ?>
              </td>
              <td>
                <a href="<?php echo $event_info["url"]; ?>" target="blank">
                  Link
                </a>
              </td>
            </tr>
            <?php endif; ?>
          <?php endwhile; ?>
        </tbody>
      </table>
      <?php else: ?>
        <p>There currently are no events.</p>
      <?php endif; ?>
    </div>
  </div>

</div>
<?php include('footer.php'); ?>