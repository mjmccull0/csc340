<?php

namespace Util;
/**
* @author Jacob Oleson
* @author Michael McCulloch
* Route url to appropriate controller and action.
*/

class Route {

  // Handle URL and send it to specified controller.
  public static function get() {

    $url = trim($_SERVER["REQUEST_URI"], "/");
    $params = explode("/", $url);

    // Try to reach a controller for testing purposes.
    $controllerName = ucfirst(array_shift($params));

    // Default to IndexController if a controller is not specified.
    if (empty($controllerName)) {
      $controllerName = "Index";
    }

    $controllerPath = "\\Controllers\\" . $controllerName . "Controller";
    $controllerAction = array_shift($params);

    // Default to indexActoin if an action is not specified.
    if (empty($controllerAction)) {
      $controllerAction = "index";
    }

    // Concatenate the controller action with the Action suffix.
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
