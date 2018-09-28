<?php
namespace DB;
use Models\SourceModel as SourceModel;

/**
 * @update 9/28/18
 * @author Michael McCulloch
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
    if (file_exists($db = DB_FILE)) {
      $data = unserialize(file_get_contents($db));
      $this->sources = $data['sources'];
      $this->records = $data['records'];
    }

    if (file_exists($dataSources = DATA_SOURCES)) {
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
   * Get the records from DataSource files.
   */
  public function get($_name = '') {

    // Return all the sources of data.
    if (empty($_name)) {
      return $this->sources;
    }

    // If the records for a source have already been loaded
    // return the records.
    if (isset($this->records[$_name])) {
      return $this->records[$_name];
    } else {

      // Try to find the requested source.
      if(array_key_exists($_name, $this->sources)) {
        $this->records[$_name] = unserialize(file_get_contents($this->sources[$_name]->getPath()));
      }


      return $this->records[$_name];
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
    foreach($this->get($_name) as $record) {
      if ($record->getId() == $_id) {
        return $record;
      }
    }

    return false;
  }

}
?>
