<?php
namespace Controllers;
/**
* @author Jacob Oleson
*
*/

class Controller {

  public function createView($_viewName) {

  }

  //Should also fetch specific data if specified.
  public function fetchData($_dataTypeName) {

    use DB\TextDB as TextDB;

    $db = TextDB::connect();
  }
}
?>
