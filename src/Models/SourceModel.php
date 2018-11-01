<?php
namespace Models;
use Translators\DataStore as DataStore;
/**
 * @update 11/01/18
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
    // Construct a url for the new data source.
    if (isset($_post['channel_id'])) {
      $_post['url'] = YOUTUBE_CHANNEL_URL . '?channel_id=' . $_post['channel_id'];
      unset($_post['channel_id']);
    }

    if (isset($_post['wp-site-url'])) {
      $_post['url'] = $_post['wp-site-url'] . WP_JSON_URL;
      unset($_post['wp-site-url']);
    }

    if (isset($_post['instagram-account'])) {
      $_post['url'] = INSTAGRAM_URL . '/' . $_post['instagram-account'] . '/';
      unset($_post['instagram-account']);
    }

    DataStore::createSource($_post);
  }

  public function delete() {
  }

  public function updateSource(array $_post) {
    DataStore::updateSource($_post);
  }

  public function updateRecord(array $_post) {
    DataStore::updateRecord($_post);
  }

}
