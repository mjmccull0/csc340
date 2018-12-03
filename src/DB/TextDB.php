<?php
namespace DB;

use Interfaces\Connector as Connector;

/**
 * @update 12/03/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */
class TextDB implements Connector {

  public static function addSource(array $_source) {
    self::addToSourceFile($_source);
    self::updateDB();
  }

  private static function addToSourceFile(array $_source) {

    $sources = array();
    // Get the current known sources.
    if (file_exists(DATA_SOURCES)) {
      $sources = self::readFile(DATA_SOURCES);
    }

    if (array_key_exists($_source['name'], $sources)) {
      // Handle the name collision.
    } else {
      $_source['path'] = DATA_DIR . $_source['name'];
      $sources[$_source['name']] =  $_source;
    }

    self::writeFile(DATA_SOURCES, $sources);

  }

  public static function add(array $_source, array $_records) {
    if (file_exists($_source['path'])) {
      $records = self::readFile($_source['path']);

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
    self::writeFile($_source['path'], $records);

    self::import();
  }

  public static function createSource(array $_post) {
    if (!self::sourceExists($_post['name'])) {
      self::addToSourceFile($_post);
    }
  }

  /**
   * Delete a data source and remove its records.
   */
  public static function delete(string $_sourceName) {
    $sources = self::readFile(DATA_SOURCES);

    // Delete the file containing the sources' records from
    // the file system.
    self::deleteFile($sources[$_sourceName]['path']);


    // Remove the source from the source file.
    unset($sources[$_sourceName]);
    self::writeFile(DATA_SOURCES, $sources);

    // Remove the records of the source from the database file.
    $records = self::getRecords();
    foreach ($records as $key => $record) {
      if ($record['name'] == $_sourceName) {
        unset($records[$key]);
      }
    }

    self::saveRecords($records);

  }

  /**
   * Delete the file from the file system.
   */
  private function deleteFile(string $_filename) {
    unlink($_filename);
  }

  /**
   * Return active records for the given parameters.
   */
  public static function get(array $_params) {
    $records = array();

    if (isset($_params['type'])) {
      return self::getActive(self::getRecordsByType($_params['type']));
    }

    if (isset($_params['name'])) {
      return self::getActive(self::getRecordsByName($_params['name']));
    }
  }

  /**
   * Return active records.
   */
  private static function getActive(array $_records) {
    $records = array();

    foreach ($_records as $record) {
      if ($record['active']) {
        array_push($records, $record);
      }
    }

    return $records;
  }

  /**
   * Read serialized data from the filesytem.
   */
  private static function readFile(string $_filename) {
    if (file_exists($_filename)) {
      return unserialize(file_get_contents($_filename));
    }
  }

  /**
   * Get both inactive and active records.
   */
  public static function getAll(array $_params) {
    if (isset($_params['type'])) {
      return self::getRecordsByType($_params['type']);
    }

    if (isset($_params['name'])) {
      return self::getRecordsByName($_params['name']);
    }

    if (isset($_params['query'])) {
      return self::search($_params['query']);

    }
  }


  /**
   * Returns a record given an id.
   */
  public static function getById(int $_id) {
    $records = self::readFile(DB_FILE);
    return $records[$_id];
  }

  private static function getRecords() {
    if (file_exists(DB_FILE)) {
      return self::readFile(DB_FILE);
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
      return self::readFile(DATA_SOURCES);
    }
  }

  public static function sourceExists(string $_name) {
    return isset(self::getSources()[$_name]);
  }



  public static function import() {
    $count = 0;
    $records = array();
    foreach (self::getSources() as $source) {
      $items = self::readFile($source['path']);

      foreach ($items as $item) {
        if (is_null($item['active'])) {
          $item['active'] = true;
        }
        $item['id'] = ++$count;
        $item['name'] = $source['name'];
        $item['type'] = $source['type'];
        $records[$count] = $item;
      }
    }

    self::saveRecords($records);
  }



  public static function saveRecord(array $_record) {
    if (self::sourceExists($_record['sourceName'])) {
      $source = self::getSourceByName($_record['sourceName']);
      $records = self::readFile($source['path']);
      $records[$_record['cid']] = $_record;
      self::writeFile($source['path'], $records);
    } else {
      // This is an attempt to save a record without a source.
    }
  }

  private static function saveRecords(array $_records) {
    self::writeFile(DB_FILE, $_records);
  }

  /**
   * Save a source.
   */
  private static function saveSource(array $_source) {
    $sources = self::getSources();
    $sources[$_source['name']] = $_source;
    self::writeFile(DATA_SOURCES, $sources);
  }

  /**
   * Searches through data to find sources that match user's query.
   */
  private static function search(string $_query) {
    $results = array();
    $list = self::getRecords();
    foreach ($list as $record) {
        if (preg_match("/\b$_query\b/i", $record["title"], $match)) {
          array_push($results, $record);
        }
     }
     return $results;
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

  /**
   * Deletes the DB file which will result in it being rebuilt.
   */
  public static function updateDB() {
    self::deleteFile(DB_FILE);
  }

  public static function updateRecord(array $_post) {
    if (!isset($_post['active'])) {
      $_post['active'] = false;
    }

    $record = self::getById($_post['id']);
    foreach ($_post as $key => $value) {
      $record[$key] = $value;
    }

    // Updates the record in the source's data file.
    self::saveRecord($record);

    $records = self::getRecords();
    $records[$record['id']] = $record;

    // Updates the record in the db file
    self::saveRecords($records);
  }

  /**
   * Writes serialized data to the filesystem.
   */
  private static function writeFile(string $_filename, array $_data) {
    file_put_contents($_filename, serialize($_data));
  }
}
?>
