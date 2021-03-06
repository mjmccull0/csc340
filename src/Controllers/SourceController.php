<?php
namespace Controllers;
use Views\View as View;

/**
 * @update 12/03/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */

class SourceController {
  protected $view;
  protected $model;


  /**
   * Constructor for the Source Controller. Sets all necessary attributes
   * to communicate with the Source Model and the View.
   */
  public function __construct() {
    $this->model = '\Models\SourceModel';
    $this->route = '\Util\Route';

    // Create a new view and give it data.
    $this->view = new View();
    $this->view->sources = $this->model::getSources();
    $this->view->baseUrl = '//' . $_SERVER['HTTP_HOST'] . '/';
    $this->view->setLayout(DEFAULT_LAYOUT);
  }


  /**
   * This action is for adding new data sources.
   */
  public function add() {
    if (!empty($_POST)) {
      $this->model::create($_POST);
      return $this->route::redirect($this->view->baseUrl);
    }

    $this->view->setTemplate(SRC_ADD_TEMPLATE);
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
    $this->view->setTemplate(SRC_INDEX);
    $this->view->render();
  }


  /**
   * This action allows for deleting data source.
   */
  public function delete() {
    if (!empty($_GET["name"])) {
      $this->model::delete($_GET['name']);
    }

    $this->route::redirect($this->view->baseUrl);
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
    $this->view->setTemplate(EDIT_TEMPLATE);
    $this->view->render();

    // No name was given, this needs to be handled.
  }


  /**
  * Sets the view to either prompt user to search by a keyword
  * or display the filtered data.
  */
  public function search() {
    if (!empty($_GET)) {
      $this->view->setData($this->model::getAll($_GET));
      $this->view->setTemplate(FILTER);
    } else {
      $this->view->setTemplate(SRC_SEARCH_TEMPLATE);
    }

    $this->view->render();
  }


  /**
   * Sets the view to see list all records we have for s given type.
   */
  public function view() {

    if (isset($_GET['name'])) {
      $this->view->source = $this->model::getByName($_GET['name']);
    }

    $this->view->setData($this->model::getAll($_GET));
    $this->view->setTemplate(SRC_VIEW);
    $this->view->render();
  }

  /**
   * Sets the view to dispaly all the data from the database in a
   * slideshow format.
   */
  public function show() {
    if (isset($_GET['name'])) {
      $this->view->source = $this->model::getByName($_GET['name']);
    }

    $this->view->setData($this->model::get($_GET));
    $this->view->setTemplate(SRC_SHOW);
    $this->view->setLayout(SHOW_LAYOUT);
    $this->view->render();
  }

  /**
   * This action handles the changes to a data source.
   */
  public function update() {
    $this->model::update($_POST);
    $redirectUrl = $this->view->baseUrl;

    if (isset($_GET['redirect'])) {
        $redirectUrl = $_GET['redirect'];
    }

    if (isset($_GET['name'])) {
      $redirectUrl = $this->view->baseUrl . '/view?name=' . $_GET['name'];
    }

    // Redirect the user to the page they clicked on the edit link.
    $this->route::redirect($redirectUrl);

  }

}
?>
