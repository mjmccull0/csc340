<?php

namespace Util;
/**
* @author Jacob Oleson
* @author Michael McCulloch
*
*/

class Route {

  //Handle URL and send it to appropriate controller
  public static function get() {

    $url = trim($_SERVER["REQUEST_URI"], "/");
    $params = explode("/", $url);

    // Try to reach a controller for testing purposes.
    $controllerName = ucfirst(array_shift($params));
    if(empty($controllerName)) {
      $controllerName = "Index";
    }

    $controllerPath = "\\Controllers\\" . $controllerName . "Controller";
    $controllerAction = array_shift($params);

    if(empty($controllerAction)) {
      $controllerAction = "index";
    }

    //Concatenate the controller action with the Action suffix
    $controllerAction = $controllerAction . "Action";

    /**
    * Still need some way to handle urls that don't map to certain controllers
    * or actions.
    */

    $controller = new $controllerPath();

    return $controller->$controllerAction();
  }
}
?>
