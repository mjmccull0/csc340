<?php
namespace Translators;
use DB\TextDB as StorageManager;
/**
 * @update 10/29/18
 * @author Michael McCulloch
 */

class DataStore {
  public static function getById(int $_id) {
    return StorageManager::getById($_id); 
  } 


  public static function createSource(array $_post) {
    StorageManager::createSource($_post); 
  } 

  public static function getSourceByName(string $_name) {
    return StorageManager::getSourceByName($_name);
  }

  public static function getRecords() {
    return StorageManager::getRecords();
  }

  public static function getRecordsByName(string $_name) {
    return StorageManager::getRecordsByName($_name);
  }

  public static function getRecordsByType(string $_type) {
    return StorageManager::getRecordsByType($_type);
  }

  public static function getSources() {
    return StorageManager::getSources();
  }

  public static function updateSource(array $_post) {
    StorageManager::updateSource($_post);
  }

  public static function updateRecord(array $_post) {
    StorageManager::updateRecord($_post);
  }
}
