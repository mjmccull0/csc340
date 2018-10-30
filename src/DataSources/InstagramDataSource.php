<?php
namespace DataSources;

use DataSources\DataSource as DataSource;
use Models\InstagramModel as InstagramModel;
use DOMDocument;

/**
 * @date 10/29/18
 * @author Michael McCulloch
 */

class InstagramDataSource extends DataSource {

  private const FIELDS = array("type", "cid", "imgUrl", "thumbnailUrl", "title");
  protected const TYPE = "Instagram";

  /**
   * Scrape the profile page of the a given url.
   */
  public function import() {

    $html = file_get_contents($this->getUrl(), TRUE);

    $document = new DOMDocument();
    $document->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $entries = array();

    // This collects the photo information on the instagram profile page.
    preg_match_all("'window._sharedData = ({.*})'", $document->textContent, $matches);

    $jsonObject = json_decode($matches[1][0]);

    // Iterate through all the instagram user's shared data and take
    // what we need.
    foreach($jsonObject->entry_data->ProfilePage[0]->graphql->user->edge_owner_to_timeline_media->edges as $img) {
      array_push($entries,
        array_combine(
          self::FIELDS,
          array(
            self::TYPE,
            $img->node->id,
            $img->node->display_url,
            $img->node->thumbnail_src,
            $img->node->edge_media_to_caption->edges[0]->node->text,
          )
        )
      );
    }

    $this->add($entries);

  }

}
?>
