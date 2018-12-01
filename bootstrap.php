<?php
/**
 * Bootstrap default sources of data.
 * @update 11/06/18
 * @author Michael McCulloch
 */
use Models\SourceModel as SourceModel;
$sources = array (
  array(
    'name' => 'UNCG Posts',
    'wp-site-url' => 'https://newsandfeatures.uncg.edu'
  ),
  array(
    'name' => 'UNCG Instagram',
    'instagram-account' => 'uncg'
  ),
  array(
    'name' => 'UNCG YouTube Channel',
    'channel_id' => 'UCZMafMiPPwm96bp843d5TZQ'
  )
);

foreach ($sources as $source) {
  if (!SourceModel::sourceExists($source['name'])) {
    SourceModel::create($source);
  }
}
?>
