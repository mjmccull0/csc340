<?php
namespace Controllers;
use Controllers\BaseController as BaseController;

/**
 * @update 11/04/18
 * @author Michael McCulloch
 */

class SourceController extends BaseController {

  public function __construct() {
    parent::__construct();
  }


  /**
   * This action is for adding new data sources.
   */
  public function add() {
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
  public function index() {
    if (isset($_GET['type'])) {
      $data = $this->model::getSourcesByType($_GET['type']);
    } else {
      $data = $this->model::getSources();
    }

    $this->view->setData($data);
    $this->view->setTemplate(SOURCE_INDEX);
    $this->view->render();
  }


  /**
   * This action allows for editing a data source.
   */
  public function edit() {
    $this->view->isSource = true;

    if (!empty($_GET["name"])) {
      $data = $this->model::getByName($_GET['name']);
      $this->view->source = $this->model::getByName($_GET['name']);
    }

    if (!empty($_GET['id'])) {
      $data = $this->model::getById($_GET['id']);
      $this->view->isSource = false;
    }

    $this->view->setData($data);
    $this->view->setTemplate(SOURCE_EDIT);
    $this->view->render();

    // No name was given, this needs to be handled.

  }

  public function view() {

    if (isset($_GET['name'])) {
      $this->view->source = $this->model::getByName($_GET['name']);
    }

    $this->view->setData($this->model::getAll($_GET));
    $this->view->setTemplate(SOURCE_VIEW);
    $this->view->render();
  }

  public function show() {
    if (isset($_GET['name'])) {
      $this->view->source = $this->model::getByName($_GET['name']);
    }

    $this->view->setData($this->model::get($_GET));
    $this->view->setTemplate(SOURCE_SHOW);
    $this->view->setLayout(SHOW_LAYOUT);
    $this->view->render();
  }

  /**
   * This action handles the changes to a data source.
   */
  public function update() {
    $this->model::update($_POST);

    $redirectUrl = SOURCE_INDEX_URL;
    if (isset($_GET['name'])) {
      $redirectUrl = SOURCE_INDEX_URL . '/view?name=' . $_GET['name'];
    }

    // Redirect the user to the page they clicked on the edit link.
    $this->route::redirect($redirectUrl);

  }

}
?>
