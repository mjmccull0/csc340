<?php
/**
 * @update 9/17/18
 * @author Michael McCulloch
 * @author Mikael Williams
 */
class IndexController {
  private $params;

  public function __construct($_params = array()) {
    if (isset($_params)) {
      $this->params = $_params;
    }
  }

  public function indexAction() {
    echo "IndexController::indexAction";
  }

  public function editAction() {
    echo "IndexController::editAction";
  }
}
?>
