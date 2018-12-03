<?php
namespace Models\Content\Type;
use Models\Content\BaseModel;
/**
 * A model for Twitter content.
 * @update 11/25/18
 * @author Mikael Williams
 */
class TwitterModel extends BaseModel {
  protected $imgUrl;
  protected $type;
  
  public function getImgUrl() {
	return $this->imgUrl;
  }

  public function getType() {
    return $this->type;
  }
  
  public function setImgUrl($_imgUrl) {
    $this->imgUrl = $_imgUrl;
  }

  public function setType($_type) {
    $this->type = $_type;
  }

}
?>
