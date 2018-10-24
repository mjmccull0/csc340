<?php
namespace Controllers;
use Controllers\BaseController as BaseController;
use Util\Route as Route;

/**
 * Update 10/24/2018
 * @author Jacob Oleson
 *
 */

class InstagramController extends BaseController {
private $name = 'instagram';

  public function __construct() {
    parent::__construct();
  }

  //Displays the current titles with photos (A work in progress )as well as an edit link
  public function indexAction() {

    $this->view->setData($this->db->get($this->name));
    $this->view->setTemplate(INSTAGRAM_INDEX);
    $this->view->render();
  }


  //Administrator can edit title and active property
  public function editAction() {

    if (!empty($id = $_GET["id"])) {
      $this->view->setData($record = $this->db->fetchById($this->name,$id));
      $this->view->setTemplate(INSTAGRAM_EDIT);
      $this->view->render();
    }
  }

  //Need a way to reflect the updates made by Administrator
  public function updateAction() {

  }

  public function show() {

  }
}

 ?>
