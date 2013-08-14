  <footer>
    <div class="row">
      <div class="large-12 columns">
        <h3>Brought to you by</h3>
      </div>
    </div>
    <div class="row partners">
      <div class="large-4 columns">
        <p>
          <img src="<?php bloginfo('template_url'); ?>/images/microsoft-logo.png" alt="Microsoft">
        </p>
      </div>
      <div class="large-4 columns">
        <img src="<?php bloginfo('template_url'); ?>/images/peopleandcode-logo.png" alt="People &amp; Code">
      </div>
      <div class="large-4 columns">
                <img src="<?php bloginfo('template_url'); ?>/images/ideanotion-logo.png" alt="Idea Notion">
      </div>
    </div>
  </footer>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/foundation.min.js"></script>
  <script>
    $(document).foundation();
    $(document).ready(function(){
      var x = false;
      setInterval(function(){
        if(x){
          $('.topBanner').css('background-color', '#f78a51');
          x = false;
        } else {
          $('.topBanner').css('background-color', '#442145');
          x = true;
        }
      }, 5000);
    });
  </script>
  <script src="<?php bloginfo('template_url'); ?>/js/app.js"></script>
</body>
</html>