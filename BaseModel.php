<?php
/**
 * A base model for content.
 * @update 9/17/18
 * @author Michael McCulloch
 */
class BaseModel {
  private $active;
  private $id;

  public static function load($_params = array()) {
    $model = new static();

    // Use the model's setter methods to build an
    // instance of a model.
    foreach($_params as $key => $value) {
      $setMethod = 'set' . ucfirst($key);
      $model->{$setMethod}($value);
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
