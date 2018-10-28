<?php
namespace DB;

use Interfaces\Connector as Connector;

/**
 * @update 10/27/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */
class TextDB implements Connector {
  private static $records;
  private static $sources = array();



  /**
   * Make TextDB aware of new dataSources.
   */
  private static function addSource($_dataSource) {
    self::$sources[$_dataSource->getName()] = $_dataSource;
    self::$records[$_dataSource->getName()] = unserialize(file_get_contents($_dataSource->getPath()));
  }

  public static function createSource(array $_post) {

    $dataSourceType = $_post['type'];
    unset($_post['type']);

    $dataSourceFqn = "\\DataSources\\" . $dataSourceType;

    // Need to prevent adding of dataSource name collisions.
    $dataSource = $dataSourceFqn::create($_post);
  }


  /**
   * Get the records from DataSource files.
   */
  public function get($_name) {
    // If the records for a source have already been loaded
    // return the records.
    if (isset($this->records[$_name])) {
      return $this->records[$_name];
    } else {

      // Try to find the requested source.
      if (array_key_exists($_name, $this->sources)) {
        $this->records[$_name] = unserialize(file_get_contents($this->sources[$_name]->getPath()));
      }

      return $this->records[$_name];
    }
  }


  /**
   * Returns a record given an id.
   */
  public function getById(int $_id) {
    // TODO
  }


  public static function getSourceByName(string $_name) {
    return self::getSources()[$_name];
  }

  /**
   * Returns all the sources of data.
   */
  public static function getSources() {
    if (file_exists($dataSources = DATA_SOURCES)) {
      return unserialize(file_get_contents($dataSources));
    }
  }


  /**
   * Return an array with all the active records.
   */
  public function fetchActive($_name) {
    $active = array();

    foreach ($this->get($_name) as $record) {
      if ($record->getActive()) {
        array_push($active, $record);
      }
    }

    return $active;
  }


  /**
   * Given the name of a DataSource and the id of a record
   * return the record.
   */
  public function fetchById($_name, $_id) {
    if (isset($this->records[$_name][$_id])) {
      return $this->records[$_name][$_id];
    } else {
      // Source with requested name and id does not exist.
    }
  }

  public static function import() {
  }


  /**
   * Updates data sources and adds new records while preserving
   * any changes made to the data sources since they have been
   * added.
   */
  public function update($_dataSourceName = '') {
    $sources = array();

    if (empty($_dataSourceName)) {
      $sources = $this->sources;
    } elseif (array_key_exists($_dataSourceName, $this->sources[$_dataSourceName])) {
      $sources = $this->sources[$_dataSourceName];
    } else {
      // An update was requested for a non-existent data source.
    }

    foreach ($sources as $source) {
      // Source import saves gets the current records for a source and saves them to a file.
      $source->import();
      // Get the contents of a file containing the current records.
      $sourceData = unserialize(file_get_contents($source->getPath()));

      // Look at each record and determine if it is new.
      foreach ($sourceData as $key => $record) {
        // Skip any records that we know about.
        if (array_key_exists($key, $this->records[$source->getName()])) {
          continue;
        } else {
          // Add new records.
          $this->records[$source->getName()][$key] = $record;
        }
      }
    }

  }

  /**
   * Update the source.
   */
  private static function save($_source) {
    if (file_exists($dataSources = DATA_SOURCES)) {
      $sources = unserialize(file_get_contents($dataSources));
      $sources[$_source->getName()] = $_source;
      file_put_contents(DATA_SOURCES, serialize($sources));
    }
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
        $method = 'set' . ucfirst($key);
        $source->$method($value);
      }

      self::save($source);
    }
  }

}
?>
