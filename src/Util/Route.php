<?php
namespace Util;
/**
* Update 12/04/18
* @author Jacob Oleson
* @author Michael McCulloch
* Route URL to appropriate Controller and Action.
*/

class Route {

  // Handle URL and send it to specified Controller.
  public static function route() {

    $url = self::getUrl();

    // Ignore any query string in the url.
    $url = explode('?', $url);
    $url = reset($url);

    $params = explode("/", $url);

    // Try to reach a Controller for testing purposes.
    /*
    $controllerName = ucfirst(array_shift($params));

    // Default to IndexController if a controller is not specified.
    if (empty($controllerName)) {
      $controllerName = "Index";
    }
     */
    $controllerName = "Source";

    $controllerPath = "\\Controllers\\" . $controllerName . "Controller";

    //Check if specified Controller exists
    if (class_exists($controllerPath)) {

      //Continue on with getting Action.
      $controllerAction = array_shift($params);

      //Default to indexAction if no specified action.
      if (empty($controllerAction)) {
        $controllerAction = "index";
      }

      //If Action in Controller exists, do it.
      if (method_exists($controllerPath, $controllerAction)) {
        Route::getController($controllerPath, $controllerAction);
      }

      //In the case the Controller exists, but their Action does not.
      else {
        Route::getController($controllerPath, "index");
      }
    }

    //If controller doesn't exist, route to error message
    else {
      Route::error();
    }
  }


  /**
   * After information has been collected, calls specified controller.
   */
  private static function getController($_controllerPath, $_controllerAction) {

    $controller = new $_controllerPath;

    return $controller->$_controllerAction();
  }


  /**
   * If no controller could be found/loaded, routes user to an error message.
   */
  private static function error() {

      echo "The file you are trying to access does not exist. Go back and think
       about what you have done. ";
  }


  /**
   * Send to user's browser to the provided relative url.
   */
  public static function redirect($_relativeUrl) {
    header("Location: " . $_relativeUrl);
  }


  /**
   * Getter for the url.
   */
  public static function getUrl() {
    return trim($_SERVER["REQUEST_URI"], "/");
  }
}
?>
