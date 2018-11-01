<?php
namespace Models;
/**
 * A base model for content.
 * @update 10/29/18
 * @author Michael McCulloch
 */
class BaseModel {
  private $active;
  private $cid;
  private $id;

  public static function load($_params = array()) {
    $model = new static();

    // Use the model's setter methods to build an
    // instance of a model.
    foreach($_params as $key => $value) {
      $setMethod = 'set' . ucfirst($key);
      if (method_exists($model, $setMethod)) {
        $model->{$setMethod}($value);
      }
    }

    return $model;
  }


  public function getActive() {
    return $this->active;
  }

  public function getCid() {
    return $this->cid;
  }


  public function getId() {
    return $this->id;
  }


  public function setActive($_flag) {
    $this->active = $_flag;
  }


  public function setCid($_cid) {
    $this->cid = $_cid;
  }


  public function setId($_id) {
    $this->id = $_id;
  }



}
?>
