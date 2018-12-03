<?php
namespace Interfaces;
/**
 * @update 12/02/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */

Interface Connector {

  /**
   * Add an entry of an existing type of data.
   */
  public static function add(array $_source, array $_records);


  /**
   * Create a source of data.
   */
  public static function createSource(array $_post);


  /**
   * Delete a source
   */
  public static function delete(string $_sourceName);


  /**
   * Get active records given parameters.
   */
  public static function get(array $_params);


  /**
   * Get both active and inactive records given parameters.
   */
  public static function getAll(array $_params);


  /**
   * Get a record given an id.
   */
  public static function getById(int $_id);


  /**
   * Get a record or records by their name/
   */
  public static function getRecordsByName(string $_name);


  /**
   * Get a record or records by their type.
   */
  public static function getRecordsByType(string $_type);


  /**
   * Get asource by its name.
   */
  public static function getSourceByName(string $_name);


  /**
   * Get a source by its type.
   */
  public static function getSourceByType(string $_type);


  /**
   * Returns all the sources of data.
   */
  public static function getSources();


  /**
   * Imports data sources and adds new records while preserving
   * any changes made to the data sources since they have been
   * added.
   */
  public static function import();


  /**
   * Checks if a given source is currenlty in the database.
   */
  public static function sourceExists(string $_name);


  /**
   * Makes requested changes to a record to be saved.
   */
  public static function updateRecord(array $_post);


  /**
   * Makes requested changes to a source to be saved.
   */
  public static function updateSource(array $_post);
}
?>
