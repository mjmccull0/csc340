<?php
/**
 * @update 9/12/18
 * @author Michael McCulloch
 */
class WpModel {
  private $active;
  private $dateTime;
  private $id;
  private $imgUrl;
  private $title;

  public static function load($_params = array()) {
    $model = new WpModel();

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

  public function getImgUrl() {
    return $this->imgUrl;
  }

  public function getDateTime() {
    return $this->dateTime;
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

  public function setDateTime($_dateTime) {
    $this->dateTime = $_dateTime;
  }

  public function setImgUrl($_imgUrl) {
    $this->imgUrl = $_imgUrl;
  }

  public function setTitle($_title) {
    $this->title = $_title;
  }

}
?>
