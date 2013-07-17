<?php 
/*
Author: Douglas Karr
Author URI: http://www.dknewmedia.com
Description: Analytics
*/

$site_url = get_settings('siteurl');
$wpwt_pluginurl = $site_url."/wp-admin/options-general.php?page=webtrends/webtrends.php";

?>
<div class="wrap">
    <div style="height: 30px; width: 183px; margin: 15px 0 5px 0;"><a href="http://www.webtrends.com" target="_blank"><img src="<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/logo.png"></a></div>
    <div class="postbox-container" style="width:600px;">
        <div class="metabox-holder">	
            <div class="meta-box-sortables">
                <div id="webtrends_credentials" class="postbox">
                    <h3 class="hndle"><span>Chart</span></h3>
                    <div class="inside" style="padding:15px">
                        <?php 
						
						$err = 0;
						if (strlen(get_option('wpwt_account'))<1) { $err = $err + 1; }
						if (strlen(get_option('wpwt_username'))<1) { $err = $err + 1; }
						if (strlen(get_option('wpwt_password'))<1) { $err = $err + 1; }
						if (strlen(get_option('wpwt_profileid'))<1) { $err = $err + 1; }
										
						if($err>0) { ?>
							<p><span style="color:red; font-weight:bold">You must fill in your Webtrends credentials.</span> <a href="<?php echo $wpwt_pluginurl ?>">Update &raquo;</a></p>
						<?php } else { ?>
                        <div id="placeholder" style="width:565px;height:400px"><img src="<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/load.gif" style="margin: 175px 0 0 250px;"></div>
                        <div id="legend" style="width:350px; margin: 15px 0 0 125px;"></div>
                        <script id="source" language="javascript" type="text/javascript">
						$.post(ajaxurl, { action: "wpwt_getchart" }, function(response) {
								$.plot($("#placeholder"), fromAnalyticsDumpToFlotData(response), { 
									xaxis: { mode: 'time' }, 
									legend: { container: '#legend', noColumns: 2 }, 
									lines: { show: true }, 
									points: { show: false }, 
									grid: { hoverable: true, clickable: true }});
								
								function showTooltip(x, y, contents) {
								$('<div id="tooltip">' + contents + '</div>').css( {
									position: 'absolute',
									display: 'none',
									top: y + 5,
									left: x + 5,
									border: '1px solid #000',
									padding: '3px',
									'background-color': '#fff',
									opacity: 0.80
								}).appendTo("body").fadeIn(200);
							}
							
							var previousPoint = null;
							$("#placeholder").bind("plothover", function (event, pos, item) {
								$("#x").text(pos.x.toFixed(2));
								$("#y").text(pos.y.toFixed(2));
							
									if (item) {
										if (previousPoint != item.datapoint) {
											previousPoint = item.datapoint;
											
											$("#tooltip").remove();
											var x = item.datapoint[0].toFixed(2),
												y = item.datapoint[1].toFixed(0);
											
											showTooltip(item.pageX, item.pageY,
														item.series.label + " = " + y);
										}
									}
									else {
										$("#tooltip").remove();
										previousPoint = null;            
									}
								
							});
							
							$("#placeholder").bind("plotclick", function (event, pos, item) {
								if (item) {
									$("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
									plot.highlight(item.series, item.datapoint);
								}
							});
						}, "json");
						</script>
                        <?php } ?>
                    </div>
                </div>
                <?php if($err<1) { ?>
				<?php /**
				<div id="webtrends_overview" class="postbox" style="width: 600px">
                    <h3 class="hndle"><span>Overview</span></h3>
                    <div class="inside" style="padding:15px">
                    <div id="overview" style="width:565px;min-height:100px"><img src="<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/load.gif" style="margin: 40px 0 0 250px;"></div>
                    <script id="page" language="javascript" type="text/javascript">
                    $.post(ajaxurl, { action: "wpwt_getoverview" }, function(response) {
							$("#overview").html(response).fadeIn();
					}, "text");
                    </script>
                    </div>
                </div>
				**/ ?>
                <div id="webtrends_code" class="postbox" style="width: 600px">
                    <h3 class="hndle"><span>Page Details</span></h3>
                    <div class="inside" style="padding:15px">
                    <div id="pagedata" style="width:565px;min-height:100px"><img src="<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/load.gif" style="margin: 40px 0 0 250px;"></div>
                    <script id="page" language="javascript" type="text/javascript">
                    $.post(ajaxurl, { action: "wpwt_getpage" }, function(response) {
							$("#pagedata").html(response).fadeIn();
					}, "text");
                    </script>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php include('wt_sidebar.php'); ?>