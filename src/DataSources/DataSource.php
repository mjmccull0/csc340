<?php
namespace DataSources;
/**
 * @update 10/29/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */

abstract class DataSource {

  protected $name;
  protected $path;
  protected $url;

  /**
   * Add new imported data from DataSources.  This method is used by
   * classes extending the DataSource class.
   */
  public function add(array $_array) {
    if (file_exists($this->path)) {
      $records = unserialize(file_get_contents($this->path));

      foreach($_array as $item) {
        if (array_key_exists($item['cid'], $records)) {
          // Skip this item, it is already in our records.
          continue;
        } else {
          // Add the new item to our records.
          $records[$item['cid']] = $item;
        }
      }

    } else {
      // Create an associative array with the item id as the key.
      $ids = array();

      foreach($_array as $item) {
        array_push( $ids, $item['cid'] );
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
      $sources[$_source->getName()] =  $_source->toArray();
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
    $dataSource->type = $_params['type'];
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

  private function toArray() {
    $array = (array) $this;

    foreach($array as $k => $x) {
      if ($k[0] == chr(0)) {
        $array[substr($k, 3)] = $array[$k];
        unset($array[$k]);
      }
    }

    return $array;

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


  public function getType() {
    return $this->type;
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

  public function setType($_type) {
    $this->type = $_type;
  }

  public function setUrl($_url) {
    $this->url = $_url;
  }

}

?>
