<?php
/**
 * A model for content imported using the Wordpress rest api.
 * @update 9/13/18
 * @author Michael McCulloch
 */
class WpModel extends BaseModel {
  private $dateTime;
  private $imgUrl;
  private $title;


  public function getImgUrl() {
    return $this->imgUrl;
  }


  public function getDateTime() {
    return $this->dateTime;
  }


  public function getTitle() {
    return $this->title;
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
