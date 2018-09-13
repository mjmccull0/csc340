<?php
/**
 * A base model for content.
 * @update 9/13/18
 * @author Michael McCulloch
 */
class BaseModel {
  private $active;
  private $id;

  public static function load($_params = array()) {
    $model = new static();

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


  public function setActive($_flag) {
    $this->active = $_flag;
  }


  public function setId($_id) {
    $this->id = $_id;
  }


}
?>
