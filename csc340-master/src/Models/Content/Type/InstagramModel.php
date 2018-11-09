<?php
namespace Models\Content\Type;
use Models\Content\BaseModel;
/**
 * A model for Instagram content.
 * @update 11/06/18
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
