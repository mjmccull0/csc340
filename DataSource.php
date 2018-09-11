<?php
interface DataSource {
  public function add($_array);
  public static function create($_options);
  public function import();
  public function save($_record);
  public function getPath();
  public function getUrl();
  public function setUrl($_url);
  public function setPath($_path);
}
?>
