<?php
namespace Controllers;

use Views\View as View;
use DB\TextDB as TextDB;
/**
 * @update 10/21/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */

class BaseController {
  protected $db;
  protected $view;

  protected function __construct() {
    // Get access to the data.
    $this->db = TextDB::connect();

    // Create a new view and give it data.
    $this->view = new View();

  }

  public function indexAction() {
  }


}
?>
