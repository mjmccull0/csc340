<?php
/**
 * Bootstrap default sources of data.
 */
use DataSources\WpDataSource as WpDataSource;
use DataSources\InstagramDataSource as InstagramDataSource;
use DataSources\YoutubeDataSource as YoutubeDataSource;

WpDataSource::create(
  array(
    'name' => 'posts',
    'url' => 'https://newsandfeatures.uncg.edu/wp-json/wp/v2/posts?_embed',
    'model' => 'Models\WpModel'
  )
);

InstagramDataSource::create(
  array(
    'name' => 'instagram',
    'url' => 'https://www.instagram.com/uncg/',
    'model' => 'Models\InstagramModel'
  )
);

YoutubeDataSource::create(
  array(
    'name' => 'youtube',
    'url' => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCZMafMiPPwm96bp843d5TZQ',
    'model' => 'Models\YoutubeModel'
  )
);

?>
