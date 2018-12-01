<?php
namespace Interfaces;
/**
 * @update 11/15/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */

Interface Connector {

  /**
   *
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


  public static function getRecordsByName(string $_name);


  public static function getRecordsByType(string $_type);


  public static function getSourceByName(string $_name);


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


  public static function sourceExists(string $_name);


  public static function updateRecord(array $_post);


  public static function updateSource(array $_post);
}
?>
