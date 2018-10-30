<?php
/**
 * Bootstrap default sources of data.
 * @update 9/27/18
 * @author Michael McCulloch
 */
use DataSources\WpDataSource as WpDataSource;
use DataSources\InstagramDataSource as InstagramDataSource;
use DataSources\YoutubeDataSource as YoutubeDataSource;

WpDataSource::create(
  array(
    'type' => 'Posts',
    'name' => 'UNCG Posts',
    'url' => 'https://newsandfeatures.uncg.edu/wp-json/wp/v2/posts?_embed'
  )
);

InstagramDataSource::create(
  array(
    'type' => 'Instagram',
    'name' => 'UNCG Instagram',
    'url' => 'https://www.instagram.com/uncg/'
  )
);

YoutubeDataSource::create(
  array(
    'type' => 'Youtube',
    'name' => 'UNCG YouTube Channel',
    'url' => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCZMafMiPPwm96bp843d5TZQ'
  )
);

?>
