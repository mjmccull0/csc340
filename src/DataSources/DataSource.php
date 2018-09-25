<?php
namespace DataSources;
use Models\SourceModel as SourceModel;
/**
 * @update 9/23/18
 * @author Michael McCulloch
 */
abstract class DataSource {
  protected const ACTIVE = 1;
  private const FILE_EXTENSION = '.txt';
  private const SOURCES_FILE = DATA_DIR . "sources.txt";
  private const SOURCES_FILE_FIELDS = array("model", "name", "path", "url");

  protected $model;
  protected $name;
  protected $path;
  protected $url;

  /**
   * Add new imported data from DataSources.  This method is used by
   * classes extending the DataSource class.
   */
  public function add($_array) {
    if (!file_exists($this->path)) {
      file_put_contents($this->path, implode("|", static::FIELDS) . "\n", TRUE);
    }

    $fileContent = file($this->path, FILE_IGNORE_NEW_LINES);

    // Ignore the first line of the file, it contains the field names.
    unset($fileContent[0]);

    foreach($_array as $record) {
      if (!in_array(implode("|", $record), $fileContent)) {
	$this->save($record);
      }
    }
  }

  /**
   * Add new sources to the DataSources file.
   */
  public function addToSourceFile($_params) {
      $_params['path'] = DATA_DIR . $_params['name'] . self::FILE_EXTENSION;

      $source = SourceModel::load($_params);

      $fileContent = file(self::SOURCES_FILE, FILE_IGNORE_NEW_LINES);
      $fields = explode("|", array_shift($fileContent));

      $sourceExists = false;

      // Determine if a source of the same name already exists in the sources
      // file.
      foreach ($fileContent as $sourceString) {
        $sourceArray = explode("|", $sourceString);
        $sourceInstance = SourceModel::load(array_combine($fields, $sourceArray));

	if ($sourceInstance->getName() == $_params['name']) {
	  $sourceExists = true;
	  continue;
	}
      }

      // If a source with the same name doesn't exist add this source to the
      // sources file.
      if (!$sourceExists) {
        file_put_contents(self::SOURCES_FILE, (string) $source . "\n", FILE_APPEND);
      }

  }

  /**
   * Create a data source with the given options.
   */
  public static function create($_params = array()) {

    // Create a file to keep track of created sources, if it doesn't exist.
    if (!file_exists(self::SOURCES_FILE)) {
      self::createSourceFile();
    }

    // Add source to the DataSources file.
    self::addToSourceFile($_params);

    // Create an instance of the DataSource which called the create method.
    $dataSource = new static();
    $dataSource->url = $_params['url'];
    $dataSource->path = DATA_DIR . $_params['name'] . self::FILE_EXTENSION;
    $dataSource->fields = static::FIELDS;


    // Collect data from a DataSource if there is none.
    if (!file_exists($dataSource->getPath())) {
      $dataSource->import();
    }

    return $dataSource;
  }


  /**
   * Create a file to store the properties of every DataSource.
   */
  public static function createSourceFile() {
      file_put_contents(self::SOURCES_FILE, implode("|", self::SOURCES_FILE_FIELDS) . "\n", TRUE);
  }


  /**
   * Classes extending DataSource must implement an import method
   * to handle the specifics of collecting data from a DataSource.
   */
  abstract public function import();


  /**
   * Save a record to persistent storage.
   */
  public function save($_record) {
    file_put_contents($this->path, implode("|", $_record) . "\n", FILE_APPEND);
  }


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
