<?php
/**
 * Contains YouTube specific methods for a DataSource.
 * @date 9/13/18
 * @author Michael McCulloch
 */
class YoutubeDataSource extends DataSource {
  /**
   * Import a YouTube channel xml feed and
   * add it to a YoutubeDataSource.
   */
  public function import() {
    $xml = file_get_contents($this->getUrl(), TRUE);
    $content = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);

    $entries = array();

    foreach ($content->entry as $entry) {
      array_push($entries,
        array(
	  // This is the active flag.
	  1,
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
