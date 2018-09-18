<?php
class Util {
  /**
   * This method takes a model as a parameter and returns
   * the fields of the model.
   * @param string $_model name of a model.
   */
  public static function fields($_model) {
      $fields = array();

      $reflector = new ReflectionObject($_model::load());

      // Collect the property names from the loaded model.
      foreach($reflector->getProperties() as $property) {
	array_push($fields, $property->name);
      }

      // If model has parent classes, recursively get their
      // properties.
      if ($parentClass = $reflector->getParentClass()) {
	$fields = array_merge(Util::fields($parentClass->getName()), $fields);
        sort($fields);
      }

      return $fields;
  }


  /**
   * Takes a relative url and returns the appropriate 
   * controller and action.
   * @param string $_path relative url path. 
   */
  public static function getRoute($_path) {
    $_path = trim($_path, "/");

    // If the provided path does not indicate a 
    // controller use the IndexController.
    if (empty($_path)) {
      $controller = new IndexController();
      return $controller->indexAction();
    }

    // Create an array from the provided relative url path.
    $path = explode("/", $_path);

    // The first element of the array should be the name of a 
    // controller.
    $controllerName = ucfirst(array_shift($path)) . 'Controller';

    if (!empty($path)) {
      $actionName = array_shift($path) . 'Action';
    } else {
      $actionName = "indexAction";
    }
    
    if (!empty($path)) {
      $params = array_shift($path);
    } else {
      $params = array();
    }

    // Create an instance of the requested controller,
    // if it exists.
    if (class_exists($controllerName)) {
      $controller = new $controllerName($params);
    }

    // Return the requested action, if it exists.
    if (method_exists($controller, $actionName)) {
      return $controller->$actionName();
    }

    // Do something to handle requests that do not map
    // to existing controllers or actions.

  }

}
?>
