<?php
/**
 * @update 9/10/18
 * @author Michael McCulloch
 */
class Model {
  private $active;
  private $id;
  private $title;

  public function getActive() {
    return $this->active;
  }

  public function getId() {
    return $this->id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setActive($_flag) {
    $this->active = $_flag;
  }

  public function setId($_id) {
    $this->id = $_id;
  }

  public function setTitle($_title) {
    $this->title = $_title;
  }
}
?>
