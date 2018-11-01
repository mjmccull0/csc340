<?php
namespace Controllers;
use Controllers\BaseController as BaseController;

/**
 * Update 11/01/2018
 * @author Jacob Oleson
 * @author Michael McCulloch
 *
 */

class InstagramController extends BaseController {
  private $type = 'Instagram';

  public function __construct() {
    parent::__construct();
  }

  //Displays the current titles with photos (A work in progress )as well as an edit link
  public function indexAction() {
    $params = $_GET;
    if (!isset($params['type'])) {
      $params['type'] = $this->type;
    }

    $this->view->setData($this->model::getAll($params));
    $this->view->setTemplate(INSTAGRAM_INDEX);
    $this->view->render();
  }


  //Administrator can edit title and active property
  public function editAction() {

    if (!empty($_GET["id"])) {
      $this->view->setData($this->model::getById($_GET['id']));
      $this->view->setTemplate(INSTAGRAM_EDIT);
      $this->view->render();
    }
  }

  //Need a way to reflect the updates made by Administrator
  public function updateAction() {
    $this->model::updateRecord($_POST);

    $this->route::redirect(INSTAGRAM_INDEX_URL);
  }

  public function showAction() {
    $params = $_GET;
    if (!isset($params['type'])) {
      $params['type'] = $this->type;
    }
    $this->view->setData($this->model::get($params));
    $this->view->setTemplate(INSTAGRAM_SHOW);
    $this->view->setLayout(SHOW_LAYOUT);
    $this->view->render();
  }
}

 ?>
