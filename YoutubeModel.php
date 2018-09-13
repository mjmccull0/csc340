<?php
/**
 * YoutubeModel provides a way to interact with YouTube
 * videos which have been imported by a YoutubeDataSource.
 * @update 9/13/18
 * @author Michael McCulloch
 */
class YoutubeModel {
  private $active;
  private $id;
  private $title;


  public static function load($_params = array()) {
    $model = new YoutubeModel();

    foreach($_params as $key => $value) {
      $model->$key = $value;
    }

    return $model;
  }


  public function getActive() {
    return $this->active;
  }


  public function getId() {
    return $this->id;
  }


  public function getTitle() {
    return $this->title;
  }


  public function setActive($_flag) {
    $this->active = $_flag;
  }


  public function setId($_id) {
    $this->id = $_id;
  }


  public function setTitle($_title) {
    $this->title = $_title;
  }


}
?>
