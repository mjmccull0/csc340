<?php
namespace Models\Content\Type;
use Models\Content\BaseModel;
/**
 * YoutubeModel provides a way to interact with YouTube
 * videos which have been imported from Youtube.
 * @update 11/08/18
 * @author Michael McCulloch
 */
class YoutubeModel extends BaseModel {
  private $type = YOUTUBE;

  public function setType($_type) {
    $this->type = $_type;
  }

  public function getType() {
    return $this->type;
  }
}
?>
