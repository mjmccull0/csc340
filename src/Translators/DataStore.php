<?php
namespace Translators;
use DB\TextDB as StorageManager;
/**
 * @update 11/08/18
 * @author Michael McCulloch
 */

class DataStore {

  public static function addSource(array $_source) {
    StorageManager::addSource($_source);
  }

  // FIXME: maybe removed after refactoring model save.
  public static function add(array $_source, array $_records) {
    StorageManager::add($_source, $_records);
  }

  public static function delete(string $_name) {
    StorageManager::delete($_name);
  }

  public static function saveRecord(array $_record) {
    StorageManager::saveRecord($_record);
  }

  public static function get(array $_params) {
    return StorageManager::get($_params);
  }

  public static function getAll(array $_params) {
    return StorageManager::getAll($_params);
  }

  public static function getById(int $_id) {
    return StorageManager::getById($_id); 
  } 


  public static function createSource(array $_post) {
    StorageManager::createSource($_post); 
  } 

  public static function getSourceByName(string $_name) {
    return StorageManager::getSourceByName($_name);
  }

  public static function getSourceByType(string $_type) {
    return StorageManager::getSourceByType($_type);
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

  public static function sourceExists(string $_name) {
    return StorageManager::sourceExists($_name);
  }

  public static function updateDB() {
    StorageManager::updateDB();
  }

  public static function updateSource(array $_post) {
    StorageManager::updateSource($_post);
  }

  public static function updateRecord(array $_post) {
    StorageManager::updateRecord($_post);
  }
}
