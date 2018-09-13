<?php
/**
 * YoutubeModel provides a way to interact with YouTube
 * videos which have been imported by a YoutubeDataSource.
 * @update 9/13/18
 * @author Michael McCulloch
 */
class YoutubeModel extends BaseModel {
  private $title;


  public function getTitle() {
    return $this->title;
  }


  public function setTitle($_title) {
    $this->title = $_title;
  }

}
?>
