<?php
namespace DB;

use Interfaces\Connector as Connector;

/**
 * @update 11/05/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */
class TextDB implements Connector {

  private static function addToSourceFile(array $_source) {

    $sources = array();
    // Get the current known sources.
    if (file_exists(DATA_SOURCES)) {
      $sources = unserialize(file_get_contents(DATA_SOURCES));
    }

    if (array_key_exists($_source['name'], $sources)) {
      // Handle the name collision.
    } else {
      $_source['path'] = DATA_DIR . $_source['name'];
      $sources[$_source['name']] =  $_source;
    }

    file_put_contents(DATA_SOURCES, serialize($sources));

  }

  public static function add(array $_source, array $_records) {
    if (file_exists($_source['path'])) {
      $records = unserialize(file_get_contents($_source['path']));

      foreach($_records as $record) {
        if (array_key_exists($record['cid'], $records)) {
          // Skip this item, it is already in our records.
          continue;
        } else {
          // Add the new item to our records.
          $records[$record['cid']] = $record;
        }
      }

    } else {
      $_source['path'] = DATA_DIR . $_source['name'];

      // Create an associative array with the item id as the key.
      $cids = array();

      foreach($_records as $record) {
        array_push( $cids, $record['cid'] );
      }

      $records = array_combine($cids, $_records);

    }
    // Save the records for this source.
    file_put_contents($_source['path'], serialize($records));

    self::import();
  }

  public static function createSource(array $_post) {
    if (!self::sourceExists($_post['name'])) {
      self::addToSourceFile($_post);
    }
  }

  public static function get(array $_params) {
    $records = array();

    if (isset($_params['type'])) {
      return self::getActive(self::getRecordsByType($_params['type']));
    }

    if (isset($_params['name'])) {
      return self::getActive(self::getRecordsByName($_params['name']));
    }
  }

  private static function getActive(array $_records) {
    $records = array();

    foreach ($_records as $record) {
      if ($record['active']) {
        array_push($records, $record);
      }
    }

    return $records;
  }

  public static function getAll(array $_params) {
    if (isset($_params['type'])) {
      return self::getRecordsByType($_params['type']);
    }

    if (isset($_params['name'])) {
      return self::getRecordsByName($_params['name']);
    }
  }


  /**
   * Returns a record given an id.
   */
  public static function getById(int $_id) {
    $records = unserialize(file_get_contents(DB_FILE));
    return $records[$_id];
  }


  private static function getRecords() {
    if (file_exists(DB_FILE)) {
      return unserialize(file_get_contents(DB_FILE));
    } else {
      self::import();
      return self::getRecords();
    }
  }


  public static function getRecordsByName(string $_name) {
    $source = self::getSources()[$_name];
    $sourceRecords = array();
    $records = self::getRecords();

    foreach ($records as $key => $record) {
      if ($record['name'] == $_name) {
        $record['id'] = $key;
        array_push($sourceRecords, $record);
      }
    }
      
    return $sourceRecords;
  }

  public static function getRecordsByType(string $_type) {

    $records = array();

    foreach (self::getRecords() as $id => $record) {
      if ($record['type'] == $_type) {
        $record['id'] = $id;
        array_push($records, $record);
      }
    }

    return $records;
  }

  public static function getSourceByName(string $_name) {
    return self::getSources()[$_name];
  }

  public static function getSourceByType(string $_type) {
    $sources = array();

    foreach (self::getSources() as $source) {
      if ($source['type'] == $_type) {
        array_push($sources, $source);
      }
    }

    return $sources;
  }


  /**
   * Returns all the sources of data.
   */
  public static function getSources() {
    if (file_exists(DATA_SOURCES)) {
      return unserialize(file_get_contents(DATA_SOURCES));
    }
  }

  public static function sourceExists(string $_name) {
    return !is_null(self::getSources()[$_name]);
  }



  public static function import() {
    $count = 0;
    $records = array();
    foreach (self::getSources() as $source) {
      $items = unserialize(file_get_contents($source['path']));

      foreach ($items as $item) {
        $item['active'] = true;
        $item['id'] = ++$count;
        $item['name'] = $source['name'];
        $item['type'] = $source['type'];
        $records[$count] = $item;
      }
    }

    self::saveRecords($records);
  }



  private static function saveRecords(array $_records) {
    file_put_contents(DB_FILE, serialize($_records));
  }

  /**
   * Save a source.
   */
  private static function saveSource($_source) {

    $sources = self::getSources();
    $sources[$_source['name']] = $_source;
    file_put_contents(DATA_SOURCES, serialize($sources));
  }

  /**
   * Process the form submission and update the source.
   */
  public static function updateSource(array $_post) {
    $source = self::getSourceByName($_post['name']);

    if (isset($source)) {
      // Changing the name of a source is unsupported.
      unset($_post['name']);

      // Set all the properties of the source to the values
      // sumbitted to the form.
      foreach ($_post as $key => $value) {

        if (isset($_post[$key])) {
          $source[$key] = $value;
        }
      }

      self::saveSource($source);
    }
  }

  public static function updateRecord(array $_post) {
    if (!isset($_post['active'])) {
      $_post['active'] = false;
    }

    $record = self::getById($_post['id']);

    foreach ($_post as $key => $value) {
      $record[$key] = $value;
    }

    $records = self::getRecords();
    $records[$record['id']] = $record;

    self::saveRecords($records);
  }
}
?>
