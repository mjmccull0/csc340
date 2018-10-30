<?php
namespace DataSources;

use DataSources\DataSource as DataSource;
use Models\YoutubeModel as YoutubeModel;
/**
 * Contains YouTube specific methods for a DataSource.
 * @update 10/29/18
 * @author Michael McCulloch
 */
class YoutubeDataSource extends DataSource {

  private const FIELDS = array("type", "cid", "title");
  private const TYPE = "Youtube";

  /**
   * Import a YouTube channel xml feed and add it to a YoutubeDataSource.
   */
  public function import() {

    $xml = file_get_contents($this->getUrl(), TRUE);
    $content = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);

    $entries = array();

    foreach ($content->entry as $entry) {
      array_push($entries,
        array_combine(
          self::FIELDS,
          array(
            self::TYPE,
            // Remove the yt:video: from the id.
            str_replace("yt:video:", "", $entry->id),
            (string) $entry->title
          )
        )
      );
    }

    $this->add($entries);
  }

}
?>
