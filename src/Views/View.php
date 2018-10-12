<?php
namespace Views;
/**
 * @update 10/10/18
 * @author Michael McCulloch
 */

class View {
  private $data;
  private $template;

  public function render() {
    include(LAYOUT);
  }

  public function getData() {
    return $this->data;
  }

  public function setData($_data) {
    $this->data = $_data;
  }

  public function setTemplate($_templatePath) {
    $this->template = $_templatePath;
  }
}
?>
