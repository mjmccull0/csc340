<?php
/**
 * @date 9/9/18
 * @author Michael McCulloch
 */

class WpDataSource implements DataSource {
  private $path;
  private $url;

  /**
   * Add new imported data to persistent storage.
   */
  public function add($_array) {
    $records = array();

    if(file_exists($this->path)) {
      $data = file_get_contents($this->path);
      $records = explode("\n", $data);
    }

    foreach($_array as $record) {
      if (!in_array(implode("|", $record), $records)) {
	$this->save($record);
      } 
    }
  }

  /**
   * Create a data source with the given options.
   */
  public static function create($_options = array()) {
    $source = new WpDataSource(); 

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
  public function import() {
    $sourceContent = file_get_contents($this->url, TRUE);
    $data = json_decode($sourceContent, TRUE);

    $entries = array();

    foreach ($data as $post) {
      if(!empty($post['_embedded']['wp:featuredmedia'][0]['source_url'])) {
         // For each of the entries in the source data with an image 
	 // create an entry with the content id, a cleaned version of the
	 // title, the date-time, and set active flag.
         array_push($entries, array(
               $post['id'],
	       // This is to handle an issue with wordpress titles using &#8217;
	       // instead of an apostrophe.
               str_replace("&#8217;", "'", $post['title']['rendered']),
               $post['_embedded']['wp:featuredmedia'][0]['source_url'],
               $post['date'],
	       // This is the active flag.
	       1
             )
         );
      }
    }

    $this->add($entries);

  }

  /**
   * Save a record to persistent storage.
   */
  public function save($_record) {
    file_put_contents($this->path, implode("|", $_record) . "\n", FILE_APPEND);
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
