<?php
namespace Controllers;

use Views\View as View;
/**
 * @update 10/27/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */

class BaseController {
  protected $view;

  protected function __construct() {

    // Create a new view and give it data.
    $this->view = new View();

  }

  public function indexAction() {
  }


}
?>
