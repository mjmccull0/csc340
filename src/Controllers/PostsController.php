<?php
namespace Controllers;
use Controllers\BaseController as BaseController;

/**
 * @update 11/01/18
 * @author Jacob Oleson
 * @author Michael McCulloch
 */

class PostsController extends BaseController {
  private $type = 'Posts';

  public function __construct() {
    parent::__construct();
  }

  //Displays the current Titles as well as an edit link for each entry
  public function indexAction() {
    if (!empty($_GET["name"])) {
      $data = $this->model::getRecordsByName($_GET["name"]);
    } else {
      $data = $this->model::getRecordsByType($this->type);
    }

    $this->view->setData($data);
    $this->view->setTemplate(POSTS_INDEX);
    $this->view->render();
  }

  //Administrator can edit titles as well as the active field
  public function editAction() {

    if (!empty($id = $_GET["id"])) {
      $this->view->setData($this->model::getById($id));
      $this->view->setTemplate(POSTS_EDIT);
      $this->view->render();
    }
  }

  //Need a way to reflect changes made by Administrator
  public function updateAction() {
    $this->model::updateRecord($_POST);

    $this->route::redirect(POSTS_INDEX_URL);
  }

  public function showAction() {
    // Need to add a way to only get active posts, somewhere in the model.
    $data = $this->model::getRecordsByType($this->type);
    $this->view->setData($data);
    $this->view->setTemplate(POSTS_SHOW);
    $this->view->setLayout(SHOW_LAYOUT);
    $this->view->render();
  }
}
?>
