<?php
namespace DB;

use Interfaces\Connector as Connector;

/**
 * @update 12/03/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */
class TextDB implements Connector {

  /**
   * Adds a new record from a source into the Database.
   *
   * Called froma translator class to add a new record into the Text DB.
   *
   * @param array $_source contains informaiton about the source this record
   * is being added from.
   * @param array $_record contains information about the record being added.
   */
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


  /**
   * Adds a new source to draw information from to the database.
   *
   * Called from a translator class to add a new soure to the DB.
   *
   * @param array $_post contains information about the source being added.
   */
  public static function createSource(array $_post) {
    if (!self::sourceExists($_post['name'])) {
      self::addToSourceFile($_post);
    }

    self::updateDB();
  }

  /**
   * Delete the file from the file system.
   */
  private function deleteFile(string $_filename) {
    if (file_exists($_filename)) {
      unlink($_filename);
    }
  }



  /**
   * Adds the new soure to the list of soures we are currently using.
   *
   * Used as a helper function with createSource this will add the new source
   * to the file where we hold our sources. This will also handle name
   * collsiions.
   *
   * @param array $_source contains information about the source we are putting
   * in our database.
   */
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


  /**
   * Delete a data source and remove its records.
   *
   * Called from a Translator class with infomration of the source to be
   * deleted.
   *
   * @param string $_sourceName is the name of the source to be deleted.
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
   * Return active records for the given parameters.
   *
   * Called from a translator class to return the specified active records.
   *
   * @param array $_params contains parameters to retrieve records, either by
   * type or name.
   * @return will return an array of active records specified by
   * the parameters.
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
   * Get both inactive and active records.
   *
   * Called from a Translator class to return all records based off of type,
   * or name, or a user query.
   *
   * @param array $_params specifies how the contents should be retrieved and
   * what contents to be retrieved
   * @return returns an array of records specified.
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
   *
   * Called from a Translator class which passes the id of a record in the
   * DB to me retrieved.
   *
   * @param int $_id is the id of the record requested.
   * @return will return the requested record.
   */
  public static function getById(int $_id) {
    $records = self::readFile(DB_FILE);
    return $records[$_id];
  }


  /**
   * Returns record(s) by a given name.
   *
   * Called from a Translator class which passes a name of a record or records
   * to be loaded and sent back.
   *
   * @param string $_name is the name of the title of the record requested.
   * @return is an array of matched records to be sent back.
   */
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


  /**
   * Retrieves records in the database by a given type.
   *
   * Called from a Translator class or in DB this will return all records
   * specified by the type parameter.
   *
   * @param string $_type the type of records to be loaded.
   * @return is an array of the mathced records of requested type.
   */
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


  /**
   * Returns a source given its name.
   *
   * Called from a Translator class this sill return a source specified by its
   * name by loading all sources into an array and picking the index
   * the matched name.
   *
   * @param string $_name is the name of the source requrested.
   * @return will return the requested source after loading an array of all
   * sources and selecting the requested one.
   */
  public static function getSourceByName(string $_name) {
    return self::getSources()[$_name];
  }


  /**
   * Returns a source given its type.
   *
   * Called from a Translator class this sill return a source specified by its
   * type by loading all sources of that type into an array.
   *
   * @param string $_type is the type of source requrested.
   * @return will return an array of matched sources.
   */
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
   *
   * Called from a Translotor class or inside of DB. Loads from a file
   * all the data source we are currently using.
   *
   * @return will return an array of unserialized source records.
   */
  public static function getSources() {
    if (file_exists(DATA_SOURCES)) {
      return self::readFile(DATA_SOURCES);
    }
  }


  /**
   * Method used to set parameters for each record and set them inside DB.
   *
   * Called from inside DB and used to help with adding and getting records.
   * Imports data sources and adds new records while preserving
   * any changes made to the data sources since they have been
   * added.
   *
   */
  public static function import() {
    $count = 0;
    $records = array();
    foreach (self::getSources() as $source) {
      $items = self::readFile($source['path']);

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


  /**
   *Checks if a requested source is actually inside of the database.
   *
   * Called from a Translator class and from inside DB and is used when adding
   * new sources to check and see if we already are using the source.
   *
   * @param string $_name is the name of the soure we're checking
   * @return will return a boolean value on wheter the soure is set or not.
   */
  public static function sourceExists(string $_name) {
    return isset(self::getSources()[$_name]);
  }


  /**
   * Updates a specific record.
   *
   * Called from a Translator class. Updates the record
   * from the information inside the post request by laoding in all records,
   * finding the correct one by checking id, and updating it with the associated
   * inforamation
   *
   * @param contains the information of the record we're updating
   * as well as the information we are updating it with.
   */
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


  /**
   * Process the form submission and update the source.
   *
   * Called from a Translator class and updates the information associated
   * with a source that we are drawing data from.
   *
   * @param array $_post contains information about the source we are updating
   * as well as the information that we are updating it with.
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
   * Save a source.
   *
   * Used in conjunction with updateSource to put the newly updated source
   * back into the database and overwriting what used to be there.
   *
   * @param $_source contains the information about the source that we are
   * saving such as its name.
   */
  private static function saveSource($_source) {
    $sources = self::getSources();
    $sources[$_source['name']] = $_source;
    self::writeFile(DATA_SOURCES, $sources);
  }


  /**
   * Return active records.
   *
   * Called inside of DB to return an array of all active records currently
   * in our database.
   *
   * @param array $_records contains the array of all records which will be
   * trimmed down to only send active records.
   * @return contains the array of all active records to be sent back.
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
   * Returns all records.
   *
   * Returns all records but unlike similar methods, doesn't require form action.
   *
   * @return returns an array of all records.
   */
  private static function getRecords() {
    if (file_exists(DB_FILE)) {
      return self::readFile(DB_FILE);
    } else {
      self::import();
      return self::getRecords();
    }
  }


  /**
   * Read serialized data from the filesytem.
   *
   * Called from inside DB. Unserializes the contents of the requsted file
   * and sends it back in an array. Used in adding, getting and deleting.
   *
   * @param string $_filename contains the contents contents from the Database
   * or from post request that we want read.
   * @return will return the specified file we want.
   */
  private static function readFile(string $_filename) {
    if (file_exists($_filename)) {
      return unserialize(file_get_contents($_filename));
    }
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


  /**
   * Saves the changes made to a record.
   *
   * Called from inside database and used when updating records. Writes
   * to the file the newly updated record.
   *
   * @param array $_records contains the updated record we want written.
   */
  private static function saveRecords(array $_records) {
    self::writeFile(DB_FILE, $_records);
  }


  /**
   * Searches through data to find sources that match user's query.
   *
   * Called from inside the database and used to match a user query with
   * record titles. Loads all records and pushes matches into an array to be
   * sent back to user.
   *
   * @param $_query user query sent down from form to use in search.
   * @return an array of all matches.
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
   * Deletes the DB file which will result in it being rebuilt.
   */
  public static function updateDB() {
    self::deleteFile(DB_FILE);
  }


  /**
   * Writes serialized data to the filesystem.
   *
   * Called from inside DB. Used in adding, saving and deleting. Writes any
   * changes to the text file where we keep our data.
   *
   * @param string $_filename contains the file that we are changing.
   * @param contains the data that will be used in the change.
   */
  private static function writeFile(string $_filename, array $_data) {
    file_put_contents($_filename, serialize($_data));
  }
}
?>
