<?php 
/*
Author: Douglas Karr
Author URI: http://www.dknewmedia.com
Description: Sidebar
*/

?>
<div class="postbox-container" style="width:35%; margin-left: 10px">
        <div class="metabox-holder">	
            <div class="meta-box-sortables">
                <div id="wtblog" class="postbox">
					<h3 class="hndle"><span style="background: url(<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/w.png) no-repeat; padding: 0 0 10px 25px;">Webtrends Blog</span></h3>
					<div class="inside" style="padding: 10px;">
						<div id="blog1" style="min-height:100px"><img src="<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/load.gif" style="margin: 20px 0 0 120px;"></div>
						<script id="page" language="javascript" type="text/javascript">
                        $.post(ajaxurl, { action: "wpwt_getblog" }, function(response) {
                                $("#blog1").html(response).fadeIn();
                        }, "text");
                        </script>
                        <p style="height:16px"><a href="http://blog.webtrends.com/feed" target="_blank" style="background: url(<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/feed.png) no-repeat; padding: 0 0 10px 25px;">Subscribe to the Webtrends Blog</a></p>
                	</div>
				</div>
                <div id="wtaccount" class="postbox">
					<h3 class="hndle"><span style="background: url(<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/twitter.gif) no-repeat; padding: 0 0 10px 25px;">Webtrends on Twitter</span></h3>
					<div class="inside" style="padding: 10px;">
						<div id="twitter1" style="min-height:100px"><img src="<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/load.gif" style="margin: 20px 0 0 120px;"></div>
						<script id="page" language="javascript" type="text/javascript">
                        $.post(ajaxurl, { action: "wpwt_gettwitter" }, function(response) {
                                $("#twitter1").html(response).fadeIn();
                        }, "text");
                        </script>
                   	</div>
				</div>
                <div id="wtblog" class="postbox">
					<h3 class="hndle"><span style="background: url(<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/cog.png) no-repeat; padding: 0 0 10px 25px;">Webtrends Support</span></h3>
					<div class="inside" style="padding: 10px;">
                        <div id="twitter2" style="min-height:100px"><img src="<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/load.gif" style="margin: 20px 0 0 120px;"></div>
						<script id="page" language="javascript" type="text/javascript">
                        $.post(ajaxurl, { action: "wpwt_gettwitter2" }, function(response) {
                                $("#twitter2").html(response).fadeIn();
                        }, "text");
                        </script>
                	</div>
				</div>
                <div id="author" style="text-align: center; font-size: 10px">Developed by <a href="http://www.dknewmedia.com">DK New Media, LLC</a></div>
            </div>
        </div>
    </div>
</div>