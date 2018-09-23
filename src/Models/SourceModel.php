<?php
namespace Models;
/**
 * SourceModel manages DataSources. 
 * @update 9/23/18
 * @author Michael McCulloch
 */
class SourceModel {
  private $model;
  private $name;
  private $path;
  private $url;


  public function __toString() {
    return implode("|", array( $this->model, $this->name, $this->path, $this->url ) );
  }

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


  public function getModel() {
    return $this->model;
  }


  public function getName() {
    return $this->name;
  }


  public function getPath() {
    return $this->path;
  }


  public function getUrl() {
    return $this->url;
  }


  public function setModel($_model) {
    $this->model = $_model;
  }


  public function setName($_name) {
    $this->name = $_name;
  }


  public function setPath($_path) {
    $this->path = $_path;
  }


  public function setUrl($_url) {
    $this->url = $_url;
  }


}
?>
