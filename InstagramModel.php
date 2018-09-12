<?php
/**
 * @update 9/12/18
 * @author Michael McCulloch
 */
class InstagramModel {
  private $active;
  private $caption;
  private $id;
  private $imgUrl;
  private $thumbnailUrl;

  public static function load($_params = array()) {
    $model = new InstagramModel();

    foreach($_params as $key => $value) {
      $methodName = 'set' . ucfirst($key);
      $model->$methodName($value);
    }

    return $model;
  }

  public function getActive() {
    return $this->active;
  }

  public function getId() {
    return $this->id;
  }

  public function getCaption() {
    return $this->caption;
  }

  public function getImgUrl() {
    return $this->imgUrl;
  }

  public function getThumbnailUrl() {
    return $this->thumbnailUrl;
  }

  public function setActive($_flag) {
    $this->active = $_flag;
  }

  public function setCaption($_caption) {
    $this->caption = $_caption;
  }

  public function setId($_id) {
    $this->id = $_id;
  }

  public function setImgUrl($_imgUrl) {
    $this->imgUrl = $_imgUrl;
  }

  public function setThumbnailUrl($_thumbnailUrl) {
    $this->thumbnailUrl = $_thumbnailUrl;
  }

}
?>
