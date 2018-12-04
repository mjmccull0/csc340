<?php
namespace Translators;
use DB\TextDB as StorageManager;
/**
 * @update 12/03/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */

class DataStore {

  /**
   * Adds an entry from a source to be displayed on digitial billboard
   *
   * This method will call the database with information asscoiated with a
   * record to be added to the current records in the database.
   *
   * @param $_source is an array of sources, with the information associated
   * with this
   * record's source attached.
   * @param $_records is an array of the information regarding the record
   *  itself.
   */
  public static function add(array $_source, array $_records) {
    StorageManager::add($_source, $_records);
  }


  /**
   * Deletes a source and all of its entries from the database.
   *
   * Calls the database with a specific source to be deleted. The records
   * associated with that source will be deleted too.
   *
   * @param $_name is the name of the source to be deleted.
   */
  public static function delete(string $_name) {
    StorageManager::delete($_name);
  }


  /**
   * Gets active records from the database specified by some paraemeter.
   *
   * Calls the Database to load a record specifed by a name or type. Multiple
   * records could be returned.
   *
   * @param $_params is an array containing either the type or the name of
   * information requested.
   * @return will return an array of matched records.
   */
  public static function get(array $_params) {
    return StorageManager::get($_params);
  }


  /**
   * Gets all records from the database either active or inactive.
   *
   * Cals the database with specific parameters for entries to be
   * loaded regardless if they are set active or not.
   *
   * @param $_params specifies if the records should be loaded by type,
   * by name, or by a user query in a search.
   * @return will return an array of records.
   */
  public static function getAll(array $_params) {
    return StorageManager::getAll($_params);
  }


  /**
   * Returns a specific entry designated by an internal ID assigned from
   * the DB.
   *
   * Calls the Text DB with a specific ID to be loaded.
   *
   * @param $_id is the internal id that defines the specifc entry.
   * @return will return the record specified by that ID.
   */
  public static function getById(int $_id) {
    return StorageManager::getById($_id);
  }


  /**
   * Creates a new kind of source to load records from.
   *
   * Calls the Text DB with information to create a new source.
   *
   * @param $_post contains the information needed to create a new source
   */
  public static function createSource(array $_post) {
    StorageManager::createSource($_post);
  }


  /**
   * Retunrs all sources specified by a name.
   *
   * Calls the Text DB to give all soures specified by a name.
   *
   * @param $_name specifies the name of the source to be laoded.
   * @return will return an array of sources found.
   */
  public static function getSourceByName(string $_name) {
    return StorageManager::getSourceByName($_name);
  }


  /**
   * Returns all sources specified by a type.
   *
   * Calls the Text DB to give all sources of a given type it is currently
   * using.
   *
   * @param $_type specifies a type to be loaded.
   * @return will return an array of sources found.
   */
  public static function getSourceByType(string $_type) {
    return StorageManager::getSourceByType($_type);
  }


  /**
   *  Will return every record in the database and does not require
   *  any specification by name, type, or user query.
   *
   * Calls the database to give every record in currently holds.
   *
   * @return will return an array of all records in db.
   */
  public static function getRecords() {
    return StorageManager::getRecords();
  }


  /**
   * Gets all recrods specified by a name.
   *
   * Calls the database with a name and checks to see if a record exists by
   * that name.
   *
   * @param $_name specifies the name of the record(s) to be fetched.
   * @return will return an array of the records found in the search.
   */
  public static function getRecordsByName(string $_name) {
    return StorageManager::getRecordsByName($_name);
  }


  /**
   * Gets all records in the database specified by type
   *
   * This will call the database to return an array of the records in the
   * database that
   * are of the specified type.
   *
   * @param $_type determines the type of recrods to be fetched
   * @return will return an array of the records of the type.
   */
  public static function getRecordsByType(string $_type) {
    return StorageManager::getRecordsByType($_type);
  }


  /**
   * Fetches all sources our database draws from
   *
   * Calls the database and expects a return of an array of the types of sources
   * we draw from and infromation
   * associated with them.
   *
   * @return will return an array of the sources currently being used
   * in our database.
   */
  public static function getSources() {
    return StorageManager::getSources();
  }


  public static function saveRecord(array $_record) {
    StorageManager::saveRecord($_record);
  }

  /**
   * Checks the database to see if the source exists.
   *
   * Checks the sources contained in the databse and compares them
   * to see if we are currently using that source for our billboard.
   *
   * @param $_name is a string to check if a source name matches.
   * @return will return whatever the database will return,
   * in this case, a boolean value.
   */
  public static function sourceExists(string $_name) {
    return StorageManager::sourceExists($_name);
  }


  /**
   * Updates the infomration associated with a given source we're drawing from
   *
   * Sends to the database changes to the specified source as given in the post
   *  form
   * and then saves the whole database after the update is complete.
   *
   * @param $_post is an array of the updated information for a given source
   * including which source we're updating.
   *
   */
  public static function updateSource(array $_post) {
    StorageManager::updateSource($_post);
  }


  /**
   * Updates a record.
   *
   * Calls our database to update the information associated with a given record
   * we're holding. Will make the changes to the specified record as given in post form
   * and then save the whole database after the update is complete.
   *
   * @param array $_post is an array of the updated inforamation for a given record
   * including which record is being updated.
   */
  public static function updateRecord(array $_post) {
    StorageManager::updateRecord($_post);
  }
}
