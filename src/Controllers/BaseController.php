<?php
namespace Controllers;
use Views\View as View;

/**
 * @update 11/05/18
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
    $this->view->sources = $this->model::getSources();
    $this->view->baseUrl = '//' . $_SERVER['HTTP_HOST'] . '/';
  }

  public function index() {
  }


}
?>
