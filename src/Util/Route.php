<?php

namespace Util;
/**
* @author Jacob Oleson
* @author Michael McCulloch
* Route URL to appropriate Controller and Action.
*/

class Route {

  // Handle URL and send it to specified Controller.
  public static function route() {

    $url = trim($_SERVER["REQUEST_URI"], "/");
    $params = explode("/", $url);
    
    // Try to reach a Controller for testing purposes.
    $controllerName = ucfirst(array_shift($params));

    // Default to IndexController if a controller is not specified.
    if (empty($controllerName)) {
      $controllerName = "Index";
    }

    $controllerPath = "\\Controllers\\" . $controllerName . "Controller";

    //Check if specified Controller exists
    if (class_exists($controllerPath)) {

      //Continue on with getting Action.
      $controllerAction = array_shift($params);

      //Default to indexAction if no specified action.
      if (empty($controllerAction)) {
        $controllerAction = "indexAction";
      }

      //If Action in Controller exists, do it.
      if (method_exists($controllerPath, $controllerAction)) {
        Route::getController($controllerPath, $controllerAction);
      }

      //In the case the Controller exists, but their Action does not.
      else {
        Route::getController($controllerPath, "indexAction");
      }
    }

    //If controller doesn't exist, route to error message
    else {
      Route::error();
    }
  }


  //Helper function
  public static function getController($_controllerPath, $_controllerAction) {

    $controller = new $_controllerPath;

    return $controller->$_controllerAction();
  }


  //Helper function
  public static function error() {

      echo "\nCOULD NOT FIND FILE >:(";
  }
}
?>
