<?

/** 

	Code adopted from Joost de Valk
	http://yoast.com/ 
	
	and developed by Douglas Karr, DK New Media
	http://www.dknewmedia.com 
	
	This code provides a custom feed that can be utilized 
	to present the last 45 days worth of blog posts
	
**/

function dknm_rss_date( $timestamp = null ) {
  $timestamp = ($timestamp==null) ? time() : $timestamp;
  echo date(DATE_RSS, $timestamp);
}

function dknm_rss_text_limit($string, $length, $replacer = '...') {
  $string = strip_tags($string);
  if(strlen($string) > $length)
    return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
  return $string;
}

function dknm_filter_where($where = '') {
    //posts in the last 45 days
    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-45 days')) . "'";
    return $where;
}
add_filter('posts_where', 'dknm_filter_where');

$posts = query_posts($query_string);

$lastpost = $numposts - 1;

header("Content-Type: application/rss+xml; charset=UTF-8");
echo '<?xml version="1.0"?>';
?><rss version="2.0">
<channel>
  <title><?php bloginfo('name'); ?></title>
  <link><?php bloginfo('siteurl'); ?></link>
  <description><?php bloginfo('description'); ?></description>
  <language><?php bloginfo('language'); ?></language>
  <pubDate><?php dknm_rss_date( strtotime($ps[$lastpost]->post_date_gmt) ); ?></pubDate>
  <lastBuildDate><?php dknm_rss_date( strtotime($ps[$lastpost]->post_date_gmt) ); ?></lastBuildDate>
  <managingEditor><?php bloginfo('admin_email'); ?></managingEditor>
<?php foreach ($posts as $post) { ?>
  <item>
    <title><?php echo get_the_title($post->ID); ?></title>
    <link><?php echo get_permalink($post->ID); ?></link>
    <description><?php echo '<![CDATA['.dknm_rss_text_limit($post->post_content, 25).'<a href="'.get_permalink($post->ID).'" target="_blank">...</a>'.']]>';  ?></description>
    <pubDate><?php dknm_rss_date( strtotime($post->post_date_gmt) ); ?></pubDate>
    <guid><?php echo get_permalink($post->ID); ?></guid>
  </item>
<?php } ?>
</channel>
</rss>