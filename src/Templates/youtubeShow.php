<!-- 
View for youtube player.
@update 11/04/18
@author Michael McCulloch
-->
<?php
$cids = array();
foreach ($this->data as $record) {
  array_push($cids, $record->getCid());
}
?>
  <iframe id="player" type="text/html" class="fullscreen"
    src="<?php echo YOUTUBE_SHOW_URL . implode(',', $cids); ?>" frameborder="0"></iframe>
