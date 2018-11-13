<?php
namespace Util;
/**
* Update 11/13/18
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

    //Still need some way to incoprotate if new controllers needed to be added.
    //$controllerName = ucfirst(array_shift($params));

    /* Default to SourceController if a controller is not specified.
    *  Even though we are currently routing to one controller, I think
    *  it's in our best interest to keep the functionality of route the same
    *  in the case where we need to add more.
    */

    /**if (empty($controllerName)) {
    *  $controllerName = "Source";
    *}
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


  //Helper function
  private static function getController($_controllerPath, $_controllerAction) {

    $controller = new $_controllerPath;

    return $controller->$_controllerAction();
  }


  //Helper function
  private static function error() {

      echo "\nThe file you are trying to access does not exist. It be like that sometimes.";
  }

  /**
   * Send to user's browser to the provided relative url.
   */
  public static function redirect($_relativeUrl) {
    header("Location: " . $_relativeUrl);
  }

  public static function getUrl() {
    return trim($_SERVER["REQUEST_URI"], "/");
  }
}
?>
