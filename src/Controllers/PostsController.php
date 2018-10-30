<?php
namespace Controllers;
use Controllers\BaseController as BaseController;
use Models\SourceModel as SourceModel;
use Util\Route as Route;

/**
 * @update 10/29/18
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
      $data = SourceModel::getRecordsByName($_GET["name"]);
    } else {
      $data = SourceModel::getRecordsByType($this->type);
    }

    $this->view->setData($data);
    $this->view->setTemplate(POSTS_INDEX);
    $this->view->render();
  }

  //Administrator can edit titles as well as the active field
  public function editAction() {

    if (!empty($id = $_GET["id"])) {
      $this->view->setData(SourceModel::getById($id));
      $this->view->setTemplate(POSTS_EDIT);
      $this->view->render();
    }
  }

  //Need a way to reflect changes made by Administrator
  public function updateAction() {
    SourceModel::updateRecord($_POST);

    Route::redirect(POSTS_INDEX_URL);
  }

  public function showAction() {
  }
}
?>
