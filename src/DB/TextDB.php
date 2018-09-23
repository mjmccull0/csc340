<?php
namespace DB;
use Models\SourceModel as SourceModel;

/**
 * @update 9/12/18
 * @author Michael McCulloch
 */
class TextDB {
  private $records;
  private $sources = array();

  /**
   * Connecting provides access to DataSource.
   */
  public static function connect() {
    $textDB = new self();  
    if ( file_exists( DATA_SOURCES ) ) {
      $fileContents = file(DATA_SOURCES, FILE_IGNORE_NEW_LINES);
      $fields = explode("|", array_shift($fileContents));
    }

    foreach($fileContents as $recordString) {
      $record = explode('|', $recordString);

      array_push($textDB->sources, SourceModel::load(
          array_combine( $fields, $record )
        )
      );

    }

    return $textDB;

  }

  /**
   * Get the records from DataSource files.
   */
  public function get($_name = '') {

    // Return the all the sources.
    if (empty($_name)) {
      return $this->sources;
    }

    // If the records for a source have already been loaded
    // return the records.
    if (isset($this->records[$_name])) {
      return $this->records[$_name];
    } else {
      // Try to find the requested source.
      foreach($this->sources as $source) {
        if ($source->getName() == $_name) {
	  $this->records[$source->getName()] = $this->load($source);
	  return $this->records[$source->getName()];
	} else {
	  // Do something because the requested source does not exist.
	}
      }
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

  /**
   * Load the records for a given DataSource.
   */
  public static function load($_source) {
    $fileContents = file($_source->getPath(), FILE_IGNORE_NEW_LINES);
    $properties = array_shift($fileContents);

    $models = array();
    
    foreach($fileContents as $record) {
      array_push($models, $_source->getModel()::load(array_combine(explode("|", $properties), explode('|', $record))));
    }

    return $models;

  }

  /**
   * Save changes to a DataSource record.
   */
  public function update($_object) {
    // Not yet implemented.
  }
}
?>
