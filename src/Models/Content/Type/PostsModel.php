<?php
namespace Models\Content\Type;
use Models\Content\BaseModel;
/**
 * A model for content imported using the Wordpress rest api.
 * @update 11/08/18
 * @author Michael McCulloch
 */
class PostsModel extends BaseModel {
  protected $dateTime;
  protected $imgUrl;
  protected $type;


  public function getImgUrl() {
    return $this->imgUrl;
  }

  public function getDateTime() {
    return $this->dateTime;
  }

  public function getType() {
    return $this->type;
  }

  public function setDateTime($_dateTime) {
    $this->dateTime = $_dateTime;
  }

  public function setImgUrl($_imgUrl) {
    $this->imgUrl = $_imgUrl;
  }

  public function setType($_type) {
    $this->type = $_type;
  }


}
?>
