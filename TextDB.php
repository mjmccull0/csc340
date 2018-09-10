<?php
/**
 * @update 9/10/18
 * @author Michael McCulloch
 */
class TextDB implements DataObjectInterface {
  private $records;

  /**
   * Create a TextDB object.
   */
  public static function create($_options) {
    // It may be necessary to handle the cases when a path, keys,
    // and a model are not passed to the create method.
    if(file_exists($_options['path']) && isset($_options['keys']) && isset($_options['model'])) {
      $textDb = new TextDB();
      $fileContents = file_get_contents($_options['path']);
      $data = explode("\n", $fileContents);

      // Removes an empty array value resulting from using 
      // explode.
      array_pop($data);

      $records = array();
      foreach($data as $record) {
        array_push($records,
          array_combine($_options['keys'],
            explode('|', $record)
	  )
	);
      }

      $models = array();
      foreach($records as $record) {
        array_push($models, $_options['model']::load($record));
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
  }
}
?>
