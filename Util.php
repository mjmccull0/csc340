<?php
class Util {
  /**
   * This method takes a model as a parameter and returns
   * the fields of the model.
   */
  public static function fields($_model) {
      $reflector = new ReflectionObject($_model::load());

      $fields = array();

      foreach($reflector->getProperties() as $property) {
	array_push($fields, $property->name);
      }

      return $fields;
  }
}
?>
