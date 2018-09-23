<?php
namespace DataSources;

use DataSources\DataSource as DataSource;
/**
 * Contains YouTube specific methods for a DataSource.
 * @date 9/20/18
 * @author Michael McCulloch
 */
class YoutubeDataSource extends DataSource {

  protected const FIELDS = array("active", "id", "title"); 

  /**
   * Import a YouTube channel xml feed and add it to a YoutubeDataSource.
   */
  public function import() {
    $xml = file_get_contents($this->getUrl(), TRUE);
    $content = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);

    $entries = array();

    foreach ($content->entry as $entry) {
      array_push($entries,
        array(
	  // This is the active flag.
	  self::ACTIVE,
	  // Remove the yt:video: from the id.
	  str_replace("yt:video:", "", $entry->id),
	  (string) $entry->title
        )
      );
    }

    $this->add($entries);
  }

}
?>
