<?php
namespace Controllers;
use Views\View as View;

/**
 * @update 11/01/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */

class BaseController {
  protected $view;
  protected $model;

  protected function __construct() {
    $this->model = '\Models\SourceModel';

    $this->route = '\Util\Route';

    // Create a new view and give it data.
    $this->view = new View();

  }

  public function indexAction() {
  }


}
?>
