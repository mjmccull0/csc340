<?php
/**
 * @date 9/12/18
 * @author Michael McCulloch
 */

class InstagramDataSource extends DataSource {
  /**
   * Scrape the profile page of the a given url.
   */
  public function import() {
    
    $html = file_get_contents($this->getUrl(), TRUE);

    $document = new DOMDocument();
    $document->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $entries = array();

    preg_match_all("'window._sharedData = ({.*})'", $document->textContent, $matches);

    $jsonObject = json_decode($matches[1][0]);
    
    // Iterate through all the instagram user's shared data and take
    // what we need.
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

}
?>