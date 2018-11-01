<?php
namespace Controllers;
use Controllers\BaseController as BaseController;
use Models\SourceModel as SourceModel;
use Util\Route as Route;

/**
 * Update 10/29/2018
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

    if (!empty($_GET["name"])) {
      $data = SourceModel::getRecordsByName($_GET["name"]);
    } else {
      $data = SourceModel::getRecordsByType($this->type);
    }

    
    $this->view->setData($data);
    $this->view->setTemplate(INSTAGRAM_INDEX);
    $this->view->render();
  }


  //Administrator can edit title and active property
  public function editAction() {

    if (!empty($_GET["id"])) {
      $this->view->setData(SourceModel::getById($_GET['id']));
      $this->view->setTemplate(INSTAGRAM_EDIT);
      $this->view->render();
    }
  }

  //Need a way to reflect the updates made by Administrator
  public function updateAction() {
    SourceModel::updateRecord($_POST);

    Route::redirect(INSTAGRAM_INDEX_URL);
  }

  public function showAction() {
    $data = SourceModel::getRecordsByType($this->type);
    $this->view->setData($data);
    $this->view->setTemplate(INSTAGRAM_SHOW);
    $this->view->setLayout(SHOW_LAYOUT);
    $this->view->render();
  }
}

 ?>
