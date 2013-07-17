<?php
/*
Author: Douglas Karr
Author URI: http://www.dknewmedia.com
Description: Analytics
*/

$url_admin = get_option('siteurl') . '/wp-admin/admin.php?page=webtrends/webtrends.php'; 
$url_analytics = get_option('siteurl') . '/wp-admin/plugins/webtrends/analytics.php'; 
$url_feed = get_option('siteurl') . '/wp-admin/plugins/webtrends/feed.php'; 
$url_plugin = dirname(__FILE__);

add_option('wpwt_account', __('', 'wpwt'));
add_option('wpwt_username', __('', 'wpwt'));
add_option('wpwt_password', __('', 'wpwt'));
add_option('wpwt_timezone', __('', 'wpwt'));
add_option('wpwt_domain', __('', 'wpwt'));
add_option('wpwt_profileid', __('', 'wpwt'));
add_option('wpwt_dscid', __('', 'wpwt'));

if ($_POST['stage']=='process') {
	update_option('wpwt_account', trim($_POST['wpwt_account']));
	update_option('wpwt_username', trim($_POST['wpwt_username']));
	update_option('wpwt_password', trim($_POST['wpwt_password']));
	update_option('wpwt_timezone', trim($_POST['wpwt_timezone']));
	update_option('wpwt_domain', trim($_POST['wpwt_domain']));
	update_option('wpwt_dscid', trim($_POST['wpwt_dscid']));
	update_option('wpwt_profileid', trim($_POST['wpwt_profileid']));
}

$wpwt_account = stripslashes(get_option('wpwt_account'));
$wpwt_username = stripslashes(get_option('wpwt_username'));
$wpwt_password = stripslashes(get_option('wpwt_password'));
$wpwt_timezone = stripslashes(get_option('wpwt_timezone'));
$wpwt_domain = stripslashes(get_option('wpwt_domain'));
$wpwt_profileid = stripslashes(get_option('wpwt_profileid'));
$wpwt_dscid = stripslashes(get_option('wpwt_dscid'));

if($wpwt_timezone=="") {
	$wpwt_timezone=get_option('gmt_offset');
}
if($wpwt_domain=="") {
	$wpwt_domain=str_replace("http://","",get_bloginfo('url'));
}
if($wpwt_code=="") {
	$wpwt_code = $analytics;
	$wpwt_code = preg_replace('/\bthis.dcsid=*"[0-9A-Za-z]*"/','this.dcsid=\"'.$wpwt_dscid.'\"',$wpwt_code);
	$wpwt_code = preg_replace('/\bthis.timezone=*"[0-9,-]*"/','this.timezone=\"'.$wpwt_timezone.'\"',$wpwt_code);
	$wpwt_code = preg_replace('/\bthis.fpcdom=*"[\.A-Za-z0-9]*"/','this.fpcdom=\"'.$wpwt_domain.'\"',$wpwt_code);
}
?>
<?php if ( !empty($_POST['submit'] ) ) : ?>
<div id="message" class="updated fade"><p><strong><?php _e('Options saved.') ?></strong></p></div>
<?php endif; ?>
<div class="wrap">
    <h2><a href="http://www.webtrends.com" target="_blank"><img src="<?php echo $site_url; ?>/wp-content/plugins/webtrends/images/logo.png"></a> <?php _e("Configuration",'webtrends'); ?></h2>
    <div class="postbox-container" style="width: 600px;">
        <div class="metabox-holder">	
            <div class="meta-box-sortables">
                <form action="" method="post" id="webtrends">
                    <div id="webtrends_credentials" class="postbox">
						<h3 class="hndle"><span>Webtrends Credentials</span></h3>
						<div class="inside" style="padding:15px">
                        <?php 
							$err1 = 0;
							if (strlen(get_option('wpwt_account'))<1) { $err1 = $err1 + 1; }
							if (strlen(get_option('wpwt_username'))<1) { $err1 = $err1 + 1; }
							if (strlen(get_option('wpwt_password'))<1) { $err1 = $err1 + 1; }
											
							if($err1>0) { ?>
							<p><span style="color:red; font-weight:bold">All fields must be filled in properly to view Webtrends data in your Dashboard.</span></p>
                        	<?php } ?>
                        	<p><label style="width:100px;text-align:right; float:left; display:block">Account:</label>&nbsp;<input id="wpwt_account" name="wpwt_account" type="text" value="<?php echo $wpwt_account; ?>" /></p>
                            <p><label style="width:100px;text-align:right; float:left; display:block">Username:</label>&nbsp;<input id="wpwt_username" name="wpwt_username" type="text" value="<?php echo $wpwt_username; ?>" /></p>
                            <p><label style="width:100px;text-align:right; float:left; display:block">Password:</label>&nbsp;<input id="wpwt_password" name="wpwt_password" type="password" value="<?php echo $wpwt_password; ?>" /></p>
							<?php wpwt_getprofileid($wpwt_account, $wpwt_username, $wpwt_password, $wpwt_profileid); ?></p>
						</div>
					</div>
                    <div id="webtrends_code" class="postbox">
						<h3 class="hndle"><span>Webtrends Code</span></h3>
						<div class="inside" style="padding:15px">
                        	<?php 
							$err2 = 0;
							if (strlen(get_option('wpwt_dscid'))<1) { $err2 = $err2 + 1; }
							if (strlen(get_option('wpwt_timezone'))<1) { $err2 = $err2 + 1; }
							if (strlen(get_option('wpwt_domain'))<1) { $err2 = $err2 + 1; }
											
							if($err2>0) { ?>
							<p><span style="color:red; font-weight:bold">All fields must be filled in properly to ensure Webtrends is collecting data.</span></p>
                        	<?php } ?>
                        	<p><label style="width:100px;text-align:right; float:left; display:block">DSCID:</label>&nbsp;<input id="wpwt_dscid" name="wpwt_dscid" type="text" value="<?php echo $wpwt_dscid; ?>" size="40" /></p>
                            <p style="margin-left:110px; font-size: 10px"><strong>What's my Webtrends Data Collection Server ID?</strong> The unique ID associated with your Webtrends data source. Valid dcsids use the format:<br />
                            dcsxxxxxxxxxxxxxxxxxxxxxx_xxxx
                            </p>
                            <p><label style="width:100px;text-align:right; float:left; display:block">Timezone:</label>&nbsp;
<select id="wpwt_timezone" name="wpwt_timezone">
<option value="" <?php if($wpwt_timezone=="") { echo "selected='selected'"; } ?>>Select a time zone</option>
<option value=" ">--------------------------</option>
<option value="-11" <?php if($wpwt_timezone=="-11") { echo "selected='selected'"; } ?>>(GMT-11:00) Midway Island,Samoa</option>
<option value="-10" <?php if($wpwt_timezone=="-10") { echo "selected='selected'"; } ?>>(GMT-10:00) Hawaii</option>
<option value="-9" <?php if($wpwt_timezone=="-9") { echo "selected='selected'"; } ?>>(GMT-09:00) Alaska</option>
<option value="-8" <?php if($wpwt_timezone=="-8") { echo "selected='selected'"; } ?>>(GMT-08:00) Pacific Time (US &amp; Canada); Tijuana</option>
<option value="-7" <?php if($wpwt_timezone=="-7") { echo "selected='selected'"; } ?>>(GMT-07:00) Mountain Time (US &amp; Canada)</option>
<option value="  ">--------------------------</option>
<option value="-6" <?php if($wpwt_timezone=="-6") { echo "selected='selected'"; } ?>>(GMT-06:00) Central Time (US &amp; Canada),Mexico City</option>
<option value="-5" <?php if($wpwt_timezone=="-5") { echo "selected='selected'"; } ?>>(GMT-05:00) Eastern Time (US &amp; Canada)</option>
<option value="-4" <?php if($wpwt_timezone=="-4") { echo "selected='selected'"; } ?>>(GMT-04:00) Antigua,La Paz,Puerto Rico</option>
<option value="-3" <?php if($wpwt_timezone=="-3") { echo "selected='selected'"; } ?>>(GMT-03:00) Buenos Aires,Georgetown</option>
<option value="-2" <?php if($wpwt_timezone=="-2") { echo "selected='selected'"; } ?>>(GMT-02:00) Mid Atlantic</option>
<option value="   ">--------------------------</option>
<option value="-1" <?php if($wpwt_timezone=="-1") { echo "selected='selected'"; } ?>>(GMT-01:00) Azores,Cape Verde Islands</option>
<option value="0" <?php if($wpwt_timezone=="0") { echo "selected='selected'"; } ?>>(GMT+00:00) Greenwich Mean Time: London,Dublin,Lisbon</option>
<option value="1" <?php if($wpwt_timezone=="1") { echo "selected='selected'"; } ?>>(GMT+01:00) Central European Standard Time,West Central Africa</option>
<option value="2" <?php if($wpwt_timezone=="2") { echo "selected='selected'"; } ?>>(GMT+02:00) Athens,Istanbul,Jerusalem,Helsinki</option>
<option value="3" <?php if($wpwt_timezone=="3") { echo "selected='selected'"; } ?>>(GMT+03:00) Kuwait,Moscow,St.Petersburg,Nairobi</option>
<option value="3.5" <?php if($wpwt_timezone=="3.5") { echo "selected='selected'"; } ?>>(GMT+03:30) Iran</option>
<option value="    ">--------------------------</option>
<option value="4" <?php if($wpwt_timezone=="4") { echo "selected='selected'"; } ?>>(GMT+04:00) Abu Dhabi,Muscat,Baku</option>
<option value="4.5" <?php if($wpwt_timezone=="4.5") { echo "selected='selected'"; } ?>>(GMT+04:30) Kabul</option>
<option value="5" <?php if($wpwt_timezone=="5") { echo "selected='selected'"; } ?>>(GMT+05:00) Islamabad,Karachi,Tashkent</option>
<option value="5.5" <?php if($wpwt_timezone=="5.5") { echo "selected='selected'"; } ?>>(GMT+05:30) Calcutta,Chennai,Mumbai,New Delhi</option>
<option value="5.75" <?php if($wpwt_timezone=="5.75") { echo "selected='selected'"; } ?>>(GMT+05:45) Kathmandu</option>
<option value="6" <?php if($wpwt_timezone=="6") { echo "selected='selected'"; } ?>>(GMT+06:00) Astana,Dhaka,Sri Jayawardenepura</option>
<option value="     ">--------------------------</option>
<option value="7" <?php if($wpwt_timezone=="7") { echo "selected='selected'"; } ?>>(GMT+07:00) Bangkok,Hawaii,Jakarta,Krasnoyark</option>
<option value="8" <?php if($wpwt_timezone=="8") { echo "selected='selected'"; } ?>>(GMT+08:00) Beijing,Kuala Lumpur,Perth,Singapore</option>
<option value="9" <?php if($wpwt_timezone=="9") { echo "selected='selected'"; } ?>>(GMT+09:00) Tokyo,Seoul,Jayapura,Irkutsk</option>
<option value="9.5" <?php if($wpwt_timezone=="9.5") { echo "selected='selected'"; } ?>>(GMT+09:30) Adelaide,Darwin</option>
<option value="10" <?php if($wpwt_timezone=="10") { echo "selected='selected'"; } ?>>(GMT+10:00) Brisbane,Sydney,Hobart,Guam</option>
<option value="11" <?php if($wpwt_timezone=="11") { echo "selected='selected'"; } ?>>(GMT+11:00) Magadan,Solomon Is.,New Caledonia</option>
<option value="      ">--------------------------</option>
<option value="12" <?php if($wpwt_timezone=="12") { echo "selected='selected'"; } ?>>(GMT+12:00) Auckland,Fiji,Kamchatka,Marshall Is.</option>
</select></p>
                            <p><label style="width:100px;text-align:right; float:left; display:block">Domain:</label>&nbsp;<input id="wpwt_domain" name="wpwt_domain" type="text" value="<?php echo $wpwt_domain; ?>" /></p>
						</div>
					</div>
                    <div class="submit" style="text-align:right">
                    <input type="hidden" name="stage" id="stage" value="process" /> 
                    <input type="submit" class="button-primary" name="submit" value="<?php _e("Update Webtrends Settings", 'wpwt'); ?> &raquo;" />
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include('wt_sidebar.php'); ?>