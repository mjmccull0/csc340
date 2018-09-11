<?php
/**
 * @date 9/9/18
 * @author Michael McCulloch
 */
interface DataObjectInterface {
  public function fetchAll();
  public function fetchById($_id);
  public function save($_array);
  public static function create($_options);
}

?>
