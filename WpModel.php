<?php
/**
 * @update 9/10/18
 * @author Michael McCulloch
 */
class WpModel extends Model {
  private $imgUrl;
  private $dateTime;

  public static function load($_params = array()) {
    $model = new WpModel();

    foreach($_params as $key => $value) {
      $methodName = 'set' . ucfirst($key);
      $model->$methodName($value);
    }

    return $model;
  }

  public function getImgUrl() {
    return $this->imgUrl;
  }

  public function getDateTime() {
    return $this->dateTime;
  }

  public function setImgUrl($_imgUrl) {
    $this->imgUrl = $_imgUrl;
  }

  public function setDateTime($_dateTime) {
    $this->dateTime = $_dateTime;
  }
}
?>
