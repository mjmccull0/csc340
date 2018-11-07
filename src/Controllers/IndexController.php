<?php
namespace Controllers;
/**
 * @update 11/04/18
 * @author Michael McCulloch
 * @author Mikael Williams
 */
class IndexController extends BaseController {
  private $params;

  public function __construct() {
    parent::__construct();
  }

  public function indexAction() {
    echo "IndexController::indexAction";
  }

  public function editAction() {
    echo "IndexController::editAction";
  }
}
?>
