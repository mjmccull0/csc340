<?php
namespace Controllers;
use Controllers\BaseController as BaseController;
use Util\Route as Route;

/**
 * @update 10/24/18
 * @author Jacob Oleson
 * @author Michael McCulloch
 */

class PostsController extends BaseController {
private $name = 'posts';

  public function __construct() {
    parent::__construct();
  }

  //Displays the current Titles as well as an edit link for each entry
  public function indexAction() {

    $this->view->setData($this->db->get($this->name));
    $this->view->setTemplate(POSTS_INDEX);
    $this->view->render();
  }

  //Administrator can edit titles as well as the active field
  public function editAction() {

    if (!empty($id = $_GET["id"])) {
      $this->view->setData($record = $this->db->fetchById($this->name,$id));
      $this->view->setTemplate(POSTS_EDIT);
      $this->view->render();
    }
  }

  //Need a way to reflect changes made by Administrator
  public function updateAction() {

  }

  public function show() {

  }
}
?>
