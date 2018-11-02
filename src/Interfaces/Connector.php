<?php
namespace Interfaces;
/**
 * @update 11/02/18
 * @author Michael McCulloch
 */

Interface Connector {

  /**
   * Create a source of data.
   */
  public static function createSource(array $_post);

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
   * Returns all the sources of data.
   */
  public static function getSources();

  /**
   * Imports data sources and adds new records while preserving
   * any changes made to the data sources since they have been
   * added.
   */
  public static function import();

  public static function updateSource(array $_post);

}
?>
