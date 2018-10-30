<?php
namespace Models;
use Translators\DataStore as DataStore;
/**
 * @update 10/29/18
 * @author Michael McCulloch
 */

class SourceModel {
  public static function getById(string $_id) {
    $record = DataStore::getById($_id);
    $model = 'Models\\' . $record['type'] . 'Model';

    return $model::load($record);
  }

  public static function getSources() {
    return DataStore::getSources();
  }

  public static function getByName(string $_name) {
    return DataStore::getSourceByName($_name);
  }

  public static function getRecords() {
    return DataStore::getRecords();
  }

  public static function getRecordsByName(string $_name) {
    $records = DataStore::getRecordsByName($_name);
    $models = array();

    $model = 'Models\\' . $records[0]['type'] . 'Model';

    foreach ($records as $record) {
      array_push($models, $model::load($record));
    }

    return $models;
  }

  public static function getRecordsByType(string $_type) {
    $records = DataStore::getRecordsByType($_type);

    $models = array();

    $model = 'Models\\' . $records[0]['type'] . 'Model';

    foreach ($records as $record) {
      array_push($models, $model::load($record));
    }

    return $models;
  }

  public static function create(array $_post) {
    DataStore::createSource($_post);
  }

  public function delete() {
  }

  public function update(array $_post) {
    DataStore::updateSource($_post);
  }

  public function updateRecord(array $_post) {
    DataStore::updateRecord($_post);
  }

}
