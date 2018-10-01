<?php
namespace DataSources;
use Models\SourceModel as SourceModel;
/**
 * @update 9/27/18
 * @author Michael McCulloch
 */

abstract class DataSource {
  protected const ACTIVE = 1;

  protected $name;
  protected $path;
  protected $url;

  /**
   * Add new imported data from DataSources.  This method is used by
   * classes extending the DataSource class.
   */
  public function add($_array) {
    if (file_exists($this->path)) {
      $records = unserialize(file_get_contents($this->path));

      foreach($_array as $item) {
        if (array_key_exists($item->getId(), $records)) {
          // Skip this item, it is already in our records.
          continue;
        } else {
          // Add the new item to our records.
          $records[$item->getId()] = $item;
        }
      }

    } else {
      // Create an associative array with the item id as the key.
      $ids = array();

      foreach($_array as $item) {
        array_push( $ids, $item->getId() );
      }

      $records = array_combine($ids, $_array);

    }

    // Save the records.
    file_put_contents($this->path, serialize($records));
  }

  /**
   * Add new sources to the DataSources file.
   */
  public static function addToSourceFile($_source) {
    
    $sources = array();
    // Get the current known sources.
    if (file_exists(DATA_SOURCES)) {
      $sources = unserialize(file_get_contents(DATA_SOURCES));
    }

    if (array_key_exists($_source->getName(), $sources)) {
      // Handle the name collision.
    } else {
      $sources[$_source->getName()] =  $_source;
    }

    file_put_contents(DATA_SOURCES, serialize($sources));

  }


  /**
   * Create a data source with the given options.
   */
  public static function create(array $_params) {

    // Create an instance of the DataSource which called the create method.
    $dataSource = new static();
    $dataSource->name = $_params['name'];
    $dataSource->url = $_params['url'];
    $dataSource->path = DATA_DIR . $_params['name'];

    $_params['path'] = $dataSource->path;

    // Collect data from a DataSource if there is none.
    if (!file_exists($dataSource->getPath())) {
      $dataSource->import();
    }

    // Add source to the DataSources file.
    self::addToSourceFile($dataSource);

    return $dataSource;
  }


  /**
   * Classes extending DataSource must implement an import method
   * to handle the specifics of collecting data from a DataSource.
   */
  abstract public function import();


  public function getName() {
    return $this->name;
  }


  public function getPath() {
    return $this->path;
  }


  public function getUrl() {
    return $this->url;
  }


  public function setName($_name) {
    $this->name = $_name;
  }


  public function setPath($_path) {
    $this->path = $_path;
  }


  public function setUrl($_url) {
    $this->url = $_url;
  }

}

?>
