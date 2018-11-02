<?php
namespace Controllers;
use Controllers\BaseController as BaseController;

/**
 * update 11/02/18
 *
 * @author Jacob Oleson
 * @author Michael McCulloch
 *
 */

class YoutubeController extends BaseController {
private $type = "Youtube";


  public function __construct() {
    parent::__construct();
  }

  //Displays the current Titles as well as an edit link for each entry
  public function indexAction() {
    $params = $_GET;
    if (!isset($params['type'])) {
      $params['type'] = $this->type;
    }

    $this->view->setData($this->model::getAll($params));
    $this->view->setTemplate(YOUTUBE_INDEX);
    $this->view->render();
  }

  public function editAction() {
    if (!empty($id = $_GET["id"])) {
      $this->view->setData($this->model::getById($id));
      $this->view->setTemplate(YOUTUBE_EDIT);
      $this->view->render();
    }
  }

  public function updateAction() {
    $this->model::updateRecord($_POST);

    $this->route::redirect(YOUTUBE_INDEX_URL);
  }

  public function showAction() {
    $params = $_GET;
    if (!isset($params['type'])) {
      $params['type'] = $this->type;
    }

    $records = $this->model::get($params);

    $this->view->setData($this->model::getCids($records));
    $this->view->setLayout(SHOW_LAYOUT);
    $this->view->setTemplate(YOUTUBE_SHOW);
    $this->view->render();
     
  }
}

 ?>
