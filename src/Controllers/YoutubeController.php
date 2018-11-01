<?php
namespace Controllers;
use Controllers\BaseController as BaseController;

/**
 * update 11/01/18
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
    if (!empty($_GET["name"])) {
      $data = $this->model::getRecordsByName($_GET["name"]);
    } else {
      $data = $this->model::getRecordsByType($this->type);
    }

    $this->view->setData($data);
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
    if (!empty($_GET["name"])) {
      $records = $this->model::getRecordsByName($_GET["name"]);
    } else {
      $records = $this->model::getRecordsByName($this->name);
    }

    $cids = array();
    foreach ($records as $record) {
      array_push($cids, $record->getCid());
    }

    $this->view->setData(implode(',', $cids));
    $this->view->setLayout(SHOW_LAYOUT);
    $this->view->setTemplate(YOUTUBE_SHOW);
    $this->view->render();
     
  }
}

 ?>
