<?php
namespace Controllers;
use Controllers\BaseController as BaseController;
use Util\Route as Route;

/**
 * @update 10/22/18
 * @author Jacob Oleson
 */

class WpController extends BaseController {
private $name = 'posts';

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
