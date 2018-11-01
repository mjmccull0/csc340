<?php
namespace Controllers;
use Controllers\BaseController as BaseController;

/**
 * @update 11/01/18
 * @author Michael McCulloch
 */

class SourceController extends BaseController {
  private $sources;

  public function __construct() {
    parent::__construct();
  }


  /**
   * This action is for adding new data sources.
   */
  public function addAction() {
    if (!empty($_POST)) {
      $this->model::create($_POST);
      return $this->route::redirect(SOURCE_INDEX_URL);
    }

    $this->view->setTemplate(SOURCE_ADD_TEMPLATE);
    $this->view->render();

  }


  /**
   * This action lists the data sources.
   */
  public function indexAction() {
    $this->view->setData($this->model::getSources());
    $this->view->setTemplate(SOURCE_INDEX);
    $this->view->render();
  }


  /**
   * This action allows for editing a data source.
   */
  public function editAction() {
    if (!empty($_GET["name"])) {
      $this->view->setData($this->model::getByName($_GET["name"]));
      $this->view->setTemplate(SOURCE_EDIT);
      $this->view->render();
    }

    // No name was given, this needs to be handled.

  }

  /**
   * This action handles the changes to a data source.
   */
  public function updateAction() {
    $this->model::updateSource($_POST);

    // Send the user to the index action.
    $this->route::redirect(SOURCE_INDEX_URL);

  }

}
?>
