  <footer>
    <div class="row">
      <div class="large-5 columns">
        <h3>Make Web Not War is...</h3>
        <p>ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat.</p>
      </div>
      <div class="large-7 columns">
        <h3>Latest Article</h3>
        <p>ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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