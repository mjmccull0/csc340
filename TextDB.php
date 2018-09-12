<?php
/**
 * @update 9/12/18
 * @author Michael McCulloch
 */
class TextDB implements DataObjectInterface {
  private $records;

  /**
   * Create a TextDB object.
   */
  public static function create($_source) {
    // It may be necessary to handle the cases when a path, keys,
    // and a model are not passed to the create method.
    if ( file_exists( $_source->getPath() )) {
      $textDb = new TextDB();

      $fileContents = file($_source->getPath(), FILE_IGNORE_NEW_LINES);

      // Ignore the first line of the file, it contains
      // the field names.
      unset($fileContents[0]);

      $models = array();

      foreach($fileContents as $record) {
        array_push($models, $_source->getModel()::load(
            array_combine(
	      Util::fields($_source->getModel()), explode('|', $record)
	    )
	  )
	);
      }

      $textDb->records = $models;

      return $textDb;
    }
  }

  /**
   * Return an array with all the records.
   */
  public function fetchAll() {
    return $this->records;
  }

  /**
   * Return the record matching the given id.
   */
  public function fetchById($_id) {
    foreach($this->records as $record) {
      if ($record->getId() == $_id) {
        return $record;
      }
    }

    return false;
  }

  public function save($_object) {
    // Not yet implemented.
  }
}
?>
