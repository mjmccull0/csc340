<?php
namespace DB;
/**
 * @update 10/12/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */
class TextDB {
  private $records;
  private $sources = array();


  /**
   * A magic method that is called when the "new" keyword is
   * used with this class name.
   * @see http://php.net/manual/en/language.oop5.magic.php
   * @see http://php.net/manual/en/language.oop5.decon.php#object.construct
   */
  private function __construct() {

    // If there is saved data, load it.
    if (file_exists($db = DB_FILE)) {
      $data = unserialize(file_get_contents($db));
      // Load the data sources.
      $this->sources = $data['sources'];
      // Load the data sources' records.
      $this->records = $data['records'];
    } elseif (file_exists($dataSources = DATA_SOURCES)) {
      $this->sources = unserialize(file_get_contents($dataSources));
    }
  }


  /**
   * A magic method that is called after there are not more
   * references to this object.
   * @see http://php.net/manual/en/language.oop5.decon.php#object.destruct
   */
  public function __destruct() {
      // Save changes to data served by TextDB.
      file_put_contents(DB_FILE, serialize(
          array(
            'records' => $this->records,
            'sources' => $this->sources
          )
        )
      );
  }


  /**
   * Connecting provides access to DataSource.
   */
  public static function connect() {

    $textDB = new self();

    return $textDB;

  }

  /**
   * Make TextDB aware of new dataSources.
   */
  public function addSource($_dataSource) {
    $this->sources[$_dataSource->getName()] = $_dataSource;
    $this->records[$_dataSource->getName()] = unserialize(file_get_contents($_dataSource->getPath()));
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
   * Returns all the sources of data.
   */
  public function getSources() {
    return $this->sources;
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

    return false;
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

  public function updateSource($_source) {
    if (isset($this->sources[$_source->getName()])) {
      $this->sources[$_source->getName()] = $_source; 
    }
  }

}
?>
