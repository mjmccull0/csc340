<?php
/**
 * @date 9/12/18
 * @author Michael McCulloch
 */

abstract class DataSource implements DataSourceInterface {
  private $model;
  private $path;
  private $url;

  /**
   * Add new imported data to persistent storage.
   */
  public function add($_array) {
    if (!file_exists($this->path)) {
      file_put_contents($this->path, implode("|", Util::fields($this->model)) . "\n", TRUE);
    }

    $fileContent = file($this->path, FILE_IGNORE_NEW_LINES);

    // Ignore the first line of the file, it contains
    // the field names.
    unset($fileContent[0]);

    foreach($_array as $record) {
      if (!in_array(implode("|", $record), $fileContent)) {
	$this->save($record);
      }
    }
  }

  /**
   * Create a data source with the given options.
   */
  public static function create($_options = array()) {
    // This will call new on the class the create method
    // was called on. For more information see the link below.
    // https://stackoverflow.com/questions/5197300/new-self-vs-new-static/5197655
    $source = new static();

    foreach($_options as $option => $value) {
      $source->$option = $value;
    }

    if(!file_exists($source->path)) {
      $source->import();
    }

    return $source;
  }

  /**
   * Get the content from the WP Rest API.
   */
  abstract public function import();

  /**
   * Save a record to persistent storage.
   */
  public function save($_record) {
    file_put_contents($this->path, implode("|", $_record) . "\n", FILE_APPEND);
  }

  public function getModel() {
    return $this->model;
  }

  public function getPath() {
    return $this->path;
  }

  public function getUrl() {
    return $this->url;
  }

  public function setPath($_path) {
    $this->path = $_path;
  }

  public function setUrl($_url) {
    $this->url = $_url;
  }

}

?>
