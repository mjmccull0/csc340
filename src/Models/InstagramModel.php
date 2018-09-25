<?php
namespace Models;
/**
 * A model for Instagram content.
 * @update 9/25/18
 * @author Michael McCulloch
 */
class InstagramModel extends BaseModel {
  private $imgUrl;
  private $thumbnailUrl;
  private $title;


  public function getImgUrl() {
    return $this->imgUrl;
  }

  public function getThumbnailUrl() {
    return $this->thumbnailUrl;
  }


  public function getTitle() {
    return $this->title;
  }


  public function setImgUrl($_imgUrl) {
    $this->imgUrl = $_imgUrl;
  }


  public function setThumbnailUrl($_thumbnailUrl) {
    $this->thumbnailUrl = $_thumbnailUrl;
  }


  public function setTitle($_title) {
    $this->title = $_title;
  }


}
?>
