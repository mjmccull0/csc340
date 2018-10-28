<?php
namespace Translators;
use DB\TextDB as StorageManager;
/**
 * @update 10/27/18
 * @author Michael McCulloch
 */

class DataStore {

  public static function createSource(array $_post) {
    StorageManager::createSource($_post); 
  } 

  public static function getSourceByName(string $_name) {
    return StorageManager::getSourceByName($_name);
  }

  public static function getSources() {
    return StorageManager::getSources();
  }

  public static function updateSource(array $_post) {
    StorageManager::updateSource($_post);
  }
}
