<?php
/**
 * @date 9/12/18
 * @author Michael McCulloch
 */

class InstagramDataSource implements DataSource {
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
    $source = new self();

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
    $html = file_get_contents("https://www.instagram.com/uncg", TRUE);

    $document = new DOMDocument();
    // Ensure UTF-8 is respected by using 'mb_convert_encoding'
    $document->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $sourceContent = file_get_contents($this->url, TRUE);
    $data = json_decode($sourceContent, TRUE);

    $entries = array();

    preg_match_all("'window._sharedData = ({.*})'", $document->textContent, $matches);
    $jsonObject = json_decode($matches[1][0]);

    foreach($jsonObject->entry_data->ProfilePage[0]->graphql->user->edge_owner_to_timeline_media->edges as $img) {
      array_push($entries, array(
	  // This is the active flag.
	  1,
	  $img->node->edge_media_to_caption->edges[0]->node->text,
          $img->node->id,
	  $img->node->display_url,
          $img->node->thumbnail_src
        )
      );
    }

    $this->add($entries);

  }

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
