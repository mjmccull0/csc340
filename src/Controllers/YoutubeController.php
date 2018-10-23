<?php
namespace Controllers;
use Controllers\BaseController as BaseController;

/**
 * 10/21/18
 * @author Jacob Oleson
 *
 */

class YoutubeController extends BaseController {
private $name = "youtube";


  public function __construct() {
    parent::__construct();
  }

  public function indexAction() {
    $this->sources = $this->db->get($this->name);
    //$this->view->setTemplate(SOURCE_INDEX);
    //$this->view->render();
    $this->view->display($this->sources);
  }
}

 ?>
