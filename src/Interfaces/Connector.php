<?php
namespace Interfaces;
/**
 * @update 10/29/18
 * @author Michael McCulloch
 */

Interface Connector {

  public static function createSource(array $_post);

  public static function getById(int $_id);

  public static function getRecordsByName(string $_name);

  public static function getSourceByName(string $_name);

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
