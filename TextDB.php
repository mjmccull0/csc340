<?php
/**
 * @date 9/9/18
 * @author Michael McCulloch
 */
class TextDB implements DataObjectInterface {
  private $records;

  /**
   * Create a TextDB object.
   */
  public static function create($_options) {
    if(file_exists($_options['path']) && isset($_options['keys'])) {
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

      $textDb->records = $records;
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
    $key = array_search($_id, array_column($this->records, 'id'));
    if($key) {
      return $this->records[$key];
    }
    return false; 
  }

  public function save($_array) {
  }
}
?>
