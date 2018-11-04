<?php
namespace Models;
use Translators\DataStore as DataStore;
/**
 * @update 11/03/18
 * @author Michael McCulloch
 */

class SourceModel {

  private $name;
  private $type;
  private $url;

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

  /**
   * Get active records.
   */
  public function get(array $_params) {
    return self::objectify(DataStore::get($_params));
  }

  /**
   * Get both active and inactive records.
   */
  public static function getAll(array $_params) {
    return self::objectify(DataStore::getAll($_params));
  }

  /**
   * Get a record by id.
   */
  public static function getById(string $_id) {
    return self::load(DataStore::getById($_id));
  }

  /**
   * Get the content ids from an array of data objects.
   */
  public function getCids(array $_records) {
    $cids = array();

    foreach ($_records as $record) {
      array_push($cids, $record->getCid());
    }

    return $cids;
  }

  public static function getSources() {
    $sources = array();

    foreach(DataStore::getSources() as $source) {
      array_push($sources, self::loadSource($source)); 
    }
    return $sources;
  }

  public static function loadSource(array $_source) {
    $source = new self();

    foreach ($_source as $key => $value) {
      $source->$key = $value;
    }

    return $source;
  }

  public static function getByName(string $_name) {
    $source = new self();

    foreach (DataStore::getSourceByName($_name) as $key => $value) {
      $source->$key = $value;
    }

    return $source;
  }

  public function getType() {
    return $this->type;
  }

  public function getName() {
    return $this->name;
  }

  public function getUrl() {
    return $this->url;
  }


  public function delete() {
  }

  private static function objectify(array $_records) {
    $records = array();

    foreach ($_records as $record) {
      array_push($records, self::load($record));
    }

    return $records;
  }

  private static function load(array $_record) {
    $model = 'Models\\' . $_record['type'] . 'Model';
    return $model::load($_record);
  }

  public function updateSource(array $_post) {
    DataStore::updateSource($_post);
  }

  public function updateRecord(array $_post) {
    DataStore::updateRecord($_post);
  }

}
