<?php
namespace Interfaces;
/**
 * @update 12/04/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */

Interface Connector {

  /**
   * Adds a new record from a source into the Database.
   *
   * Called froma translator class to add a new record into the Text DB.
   *
   * @param array $_source contains informaiton about the source this record
   * is being added from.
   * @param array $_record contains information about the record being added.
   */
  public static function add(array $_source, array $_records);


  /**
   * Adds a new source to draw information from to the database.
   *
   * Called from a translator class to add a new soure to the DB.
   *
   * @param array $_post contains information about the source being added.
   */
  public static function createSource(array $_post);


  /**
   * Delete a data source and remove its records.
   *
   * Called from a Translator class with infomration of the source to be
   * deleted.
   *
   * @param string $_sourceName is the name of the source to be deleted.
   */
  public static function delete(string $_sourceName);


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
  public static function get(array $_params);


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
  public static function getAll(array $_params);


  /**
   * Returns a record given an id.
   *
   * Called from a Translator class which passes the id of a record in the
   * DB to me retrieved.
   *
   * @param int $_id is the id of the record requested.
   * @return will return the requested record.
   */
  public static function getById(int $_id);


  /**
   * Returns record(s) by a given name.
   *
   * Called from a Translator class which passes a name of a record or records
   * to be loaded and sent back.
   *
   * @param string $_name is the name of the title of the record requested.
   * @return is an array of matched records to be sent back.
   */
  public static function getRecordsByName(string $_name);


  /**
   * Retrieves records in the database by a given type.
   *
   * Called from a Translator class or in DB this will return all records
   * specified by the type parameter.
   *
   * @param string $_type the type of records to be loaded.
   * @return is an array of the mathced records of requested type.
   */
  public static function getRecordsByType(string $_type);


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
  public static function getSourceByName(string $_name);


  /**
   * Returns a source given its type.
   *
   * Called from a Translator class this sill return a source specified by its
   * type by loading all sources of that type into an array.
   *
   * @param string $_type is the type of source requrested.
   * @return will return an array of matched sources.
   */
  public static function getSourceByType(string $_type);


  /**
   * Returns all the sources of data.
   *
   * Called from a Translotor class or inside of DB. Loads from a file
   * all the data source we are currently using.
   *
   * @return will return an array of unserialized source records.
   */
  public static function getSources();


  /**
   * Method used to set parameters for each record and set them inside DB.
   *
   * Called from inside DB and used to help with adding and getting records.
   * Imports data sources and adds new records while preserving
   * any changes made to the data sources since they have been
   * added.
   *
   */
  public static function import();


  /**
   * Attempt to save a record without a source.
   *
   * @param array $_record is the record to be saved.
   */
  public static function saveRecord(array $_record);


  /**
   *Checks if a requested source is actually inside of the database.
   *
   * Called from a Translator class and from inside DB and is used when adding
   * new sources to check and see if we already are using the source.
   *
   * @param string $_name is the name of the soure we're checking
   * @return will return a boolean value on wheter the soure is set or not.
   */
  public static function sourceExists(string $_name);


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
  public static function updateRecord(array $_post);


  /**
   * Process the form submission and update the source.
   *
   * Called from a Translator class and updates the information associated
   * with a source that we are drawing data from.
   *
   * @param array $_post contains information about the source we are updating
   * as well as the information that we are updating it with.
   */
  public static function updateSource(array $_post);

}
?>
