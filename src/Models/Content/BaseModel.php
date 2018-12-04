<?php
namespace Models\Content;
use Translators\DataStore as DataStore;
/**
 * A base model for content.
 * @update 11/08/18
 * @author Michael McCulloch
 */
class BaseModel {
  private $active;
  private $cid;
  private $id;
  private $sourceName;
  private $title;

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

  public function save() {
      DataStore::saveRecord($this->toArray());
  }

  public function update() {
      DataStore::updateRecord($this->toArray());
  }

  public function toArray() {
    return get_object_vars($this);
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

  public function getSourceName() {
    return $this->sourceName;
  }

  public function getTitle() {
    return $this->title;
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

  public function setSourceName(string $_name) {
    $this->sourceName = $_name;
  }

  public function setTitle(string $_title) {
    $this->title = $_title;
  }

}
?>
