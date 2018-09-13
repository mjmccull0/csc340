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
}
?>
