<?php
/**
 * A model for Instagram content.
 * @update 9/13/18
 * @author Michael McCulloch
 */
class InstagramModel extends BaseModel {
  private $caption;
  private $imgUrl;
  private $thumbnailUrl;


  public function getCaption() {
    return $this->caption;
  }


  public function getImgUrl() {
    return $this->imgUrl;
  }

  public function getThumbnailUrl() {
    return $this->thumbnailUrl;
  }


  public function setCaption($_caption) {
    $this->caption = $_caption;
  }


  public function setImgUrl($_imgUrl) {
    $this->imgUrl = $_imgUrl;
  }


  public function setThumbnailUrl($_thumbnailUrl) {
    $this->thumbnailUrl = $_thumbnailUrl;
  }

}
?>
