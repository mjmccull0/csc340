<?php
namespace Models;
use Translators\DataStore as DataStore;
/**
 * @update 10/27/18
 * @author Michael McCulloch
 */

class SourceModel {
  public static function getSources() {
    return DataStore::getSources();
  }

  public static function getByName(string $_name) {
    return DataStore::getSourceByName($_name);
  }

  public static function create(array $_post) {
    DataStore::createSource($_post);
  }

  public function delete() {
  }

  public function update(array $_post) {
    DataStore::updateSource($_post);
  }

}
