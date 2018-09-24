<?php
namespace DataSources;

use DataSources\DataSource as DataSource;
/**
 * @date 9/20/18
 * @author Michael McCulloch
 */

class WpDataSource extends DataSource {

  protected const FIELDS = array("active", "dateTime", "id", "imgUrl", "title");

  /**
   * Get the content from the WP Rest API.
   */
  public function import() {
    $sourceContent = file_get_contents($this->getUrl(), TRUE);
    $data = json_decode($sourceContent, TRUE);

    $entries = array();

    foreach ($data as $post) {
      if(!empty($post['_embedded']['wp:featuredmedia'][0]['source_url'])) {
         // For each of the entries in the source data with an image
	 // create an entry with the content id, a cleaned version of the
	 // title, the date-time, and set active flag.
         array_push($entries, array(
	       // This is the active flag.
	       self::ACTIVE,
               $post['date'],
               $post['id'],
               $post['_embedded']['wp:featuredmedia'][0]['source_url'],
	       // This is to handle an issue with wordpress titles using &#8217;
	       // instead of an apostrophe.
               str_replace("&#8217;", "'", $post['title']['rendered'])
             )
         );
      }
    }

    $this->add($entries);

  }

}

?>
