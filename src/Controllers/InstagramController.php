<?php
namespace Controllers;
use Controllers\BaseController as BaseController;
use Models\InstagramModel as InstagramModel;
use DataSources\InstagramDataSource as InstagramDataSource;

/**
 * 10/21/18
 * @author Jacob Oleson
 *
 */

class InstagramController extends BaseController {
private $name = 'instagram';

  public function __construct() {
    parent::__construct();
  }

}

 ?>
