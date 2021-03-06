<?php
namespace Models;
use Translators\DataStore as DataStore;
use DOMDocument;
/**
 * @update 12/04/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 * @author Mikael Williams
 */

class SourceModel {

  private $name;
  private $path;
  private $type;
  private $url;


  /**
   * Determines the type of source to be created and
   * calls the appropriate import method.
   *
   * Called from Souce Controller when adding in a new source.
   *
   * @param array $_post is the post form with information on how to create
   * a new source for the database
   */
  public static function create(array $_post) {

    // Construct a url for the new data source.
    if (isset($_post['channel_id'])) {
      $_post['url'] = YOUTUBE_CHANNEL_URL . '?channel_id=' . $_post['channel_id'];
      $_post['type'] = YOUTUBE;
      unset($_post['channel_id']);
    }

    if (isset($_post['wp-site-url'])) {
      $_post['url'] = $_post['wp-site-url'] . WP_JSON_URL;
      $_post['type'] = POSTS;
      unset($_post['wp-site-url']);
    }

    if (isset($_post['instagram-account'])) {
      $_post['url'] = INSTAGRAM_URL . '/' . $_post['instagram-account'] . '/';
      $_post['type'] = INSTAGRAM;
      unset($_post['instagram-account']);
    }


    if (isset($_post['twitter-account'])) {
      $_post['url'] = TWITTER_URL . '/' . $_post['twitter-account'] . '/';
      $_post['type'] = Twitter;
    }


    $source = self::loadSource($_post);
    $source->save();

    $importMethod = 'import' . $_post['type'];
    self::$importMethod($_post);

  }


  /**
   * Delete a data source.
   *
   * Called from Source Controller when deleting a data source and its
   * associated records.
   *
   * @param string $_name is the name of the source to be deleted.
   */
  public static function delete(string $_name) {
    DataStore::delete($_name);
  }


  /**
   * Get active records. Was getting warnings if this wasn't static.
   *
   * Called from Source Controller and will communicate with database. Database
   * has methods to get by type or by name, which will be set in $_params
   *
   * @param array $_params is the array requesting what records we want.
   * Could be by name, or by type.
   * @return returns an array of the retrieved records.
   */
  public static function get(array $_params) {
    return self::objectify(DataStore::get($_params));
  }


  /**
   * Get both active and inactive records.
   *
   * Called from SourceController and retrieves all records currently in
   * the database.
   *
   * @param array $_params contains how we want to get the records. Could be
   * by type, or by name.
   * @return returns an array of all recrods.
   */
  public static function getAll(array $_params) {
    return self::objectify(DataStore::getAll($_params));
  }


  /**
   * Get a record by id.
   *
   * Called from Source Controller to retrieve a specific record. Used in
   * editing.
   *
   * @param string $_id is the id used in the database to identify records.
   * @return returns the requested recrod.
   */
  public static function getById(string $_id) {
    return self::load(DataStore::getById($_id));
  }


  /**
   * Return a source given the source name.
   *
   * Called from Source Controller and used in editing and viewing the content.
   *
   * @param string $_name specifies the name of item requested.
   * @return returns the matched source from the database.
   */
  public static function getByName(string $_name) {
    $source = new self();

    foreach (DataStore::getSourceByName($_name) as $key => $value) {
      $source->$key = $value;
    }

    return $source;
  }


  /**
   * Gets the content ids from an array of data objects.
   *
   * Used in obtaining multiple cids.
   *
   * @param array $_records contains the data objects to get the cids from.
   */
  public function getCids(array $_records) {
    $cids = array();

    foreach ($_records as $record) {
      array_push($cids, $record->getCid());
    }

    return $cids;
  }

  /**
   * Returns instances of the source model.
   *
   * Called from Source Controller when initializing  and as its default action.
   *
   * @return returns an array of sources from the database.
   */
  public static function getSources() {
    $sources = array();

    foreach(DataStore::getSources() as $source) {
      array_push($sources, self::loadSource($source));
    }

    return $sources;
  }


  /**
   * Return instances of the source model given the type
   * of source.
   *
   * Called from Source Controller and is used to search the database given
   * a specific type of source we have.
   *
   * @param string $_type specifies the type of source requested. Right now
   * we have Instagram, Posts, and YouTube.
   * @return returns all found soures of the specified type.
   */
  public static function getSourcesByType(string $_type) {
    $sources = array();
    foreach (DataStore::getSourceByType($_type) as $source) {
      array_push($sources, self::loadSource($source));
    }
    return $sources;
  }


  /**
   * Create an instance of the source model.
   *
   * Used in importing and getting the sources in our database.
   *
   * @param array $_params
   * @return returns an array of all found sources held in the database
   */
  public static function loadSource(array $_params) {
    $source = new self();

    foreach ($_params as $key => $value) {
      $setMethod = 'set'. ucfirst($key);
      if (method_exists($source, $setMethod)) {
        $source->$setMethod($value);
      }
    }

    return $source;
  }


  /**
   * Import the various sources
   *
   * Calls the database to see what source we are using.
   */
  public static function import() {
    $sources = self::getSources();

    foreach ($sources as $source) {
      $_params = array(
        'url' => $source->getUrl(),
        'name' => $source->getName(),
        'type' => $source->getType()
      );

      $importMethod = 'import' . $source->getType();
      self::$importMethod($_params);
    }
  }


  /**
   * Imports the Instagram Records.
   *
   * @param array $_params contains the information necessary to load
   * the url as a source and be able to grab records from it.
   */
  public static function importInstagram(array $_params) {
    $source = self::loadSource($_params);

    $fields = array("cid", "imgUrl", "thumbnailUrl", "title", "sourceName", "type");
    $html = file_get_contents($_params['url'], TRUE);
    $document = new DOMDocument();
    $document->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    // This collects the photo information on the instagram profile page.
    preg_match_all("'window._sharedData = ({.*})'", $document->textContent, $matches);

    $jsonObject = json_decode($matches[1][0]);

    // Iterate through all the instagram user's shared data and take
    // what we need.
    foreach($jsonObject->entry_data->ProfilePage[0]->graphql->user->edge_owner_to_timeline_media->edges as $img) {
      $model = self::load(
        array_combine(
          $fields,
          array(
            $img->node->id,
            $img->node->display_url,
            $img->node->thumbnail_src,
            $img->node->edge_media_to_caption->edges[0]->node->text,
            $source->getName(),
            $source->getType()
          )
        )
      );

      $model->save();
    }
  }


  /**
   * Import records from a wordpress site using the
   * json v2 api.
   *
   * @param array $_params contains the information necssary to grab records
   * from the source of these posts.
   */
  public static function importPosts(array $_params) {
    $source = self::loadSource($_params);

    $fields = array('dateTime', 'cid', 'imgUrl', 'title', 'sourceName', 'type');
    $sourceContent = file_get_contents($_params['url'], TRUE);
    $data = json_decode($sourceContent, TRUE);

    foreach ($data as $post) {
      if(!empty($post['_embedded']['wp:featuredmedia'][0]['source_url'])) {
        // For each of the entries in the source data with an image
        // create an entry with the content id, a cleaned version of the
        // title, the date-time, and set active flag.
        $model = self::load(
          array_combine(
            $fields,
            array(
              $post['date'],
              $post['id'],
              $post['_embedded']['wp:featuredmedia'][0]['source_url'],
              // This is to handle an issue with wordpress titles using &#8217;
              // instead of an apostrophe.
              str_replace("&#8217;", "'", $post['title']['rendered']),
              $source->getName(),
              $source->getType()
            )
          )
        );
      }

      $model->save();
    }
  }


  /**
  * This will import the twitter data for a given twitter account.
  * @params array of fields that are used by the database that define the source.
  */
  public static function importTwitter(array $_params) {
      throw new Exception("Not yet implemented");
  }


  /**
   * Import youtube video data
   *
   * @param array $_param contains the information with the YouTube source
   * for the database to use.
   */
  public static function importYoutube(array $_params) {
    $source = self::loadSource($_params);
    // There may be a better way to get the fields.
    $fields = array("cid", "title", "sourceName", "type");
    $xml = file_get_contents($_params['url'], TRUE);
    $content = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);

    foreach ($content->entry as $entry) {
      $model = self::load(
        array_combine(
          $fields,
          array(
          // Remove the yt:video: from the id.
          str_replace("yt:video:", "", $entry->id),
          (string) $entry->title,
          $source->getName(),
          $source->getType()
          )
        )
      );

      $model->save();
    }
  }


  /**
   * Load an instance of one of the record types.
   *
   * @param array $_record contains the type of record to be loaded.
   */
  private static function load(array $_record) {
    $model = 'Models\Content\Type\\' . $_record['type'] . 'Model';
    return $model::load($_record);
  }


  /**
   * Check to see if a source exists for the given name.
   * Needed to make this static to stop its whining. Might be a php 7 problem?
   *
   * Used when adding new items to the database so we don't have any
   * redundant records or possible errors.
   *
   * @param string $_name is the name of the source to check.
   * @return calls the database to see if that source exists and will return a
   * boolean value.
   */
  public static function sourceExists(string $_name) {
    return DataStore::sourceExists($_name);
  }


  /**
   * Determines what to do with form post requests.
   *
   * Depending on what was set in form either a record or a source will be
   * updated, and this will determine which.
   *
   * @param array $_post contains the post id to be updated as well as inforamation
   * from form to update the record with.
   */
  public static function update(array $_post) {
    if (isset($_post['id'])) {
      self::updateRecord($_post);
    } else if (isset($_post['ids'])) {
      self::updateRecords($_post);
    } else if (isset($_post['name'])) {
      self::updateSource($_post);
    } else {
      self::import($_post);
    }
  }


  /**
   * Update a source.
   *
   * @param array $_post contains the information associated with the source
   * to be updated as well as the information to update it with.
   */
  public static function updateSource(array $_post) {
    DataStore::updateSource($_post);
  }


  /**
   *  Create an array of record objects.
   *
   * Called from the Source Model to make an array of records to be
   * given back to the controller and used as data for the view.
   *
   * @param array $_records contains the records to be loaded and objectified.
   */
  private static function objectify(array $_records) {
    $records = array();

    foreach ($_records as $record) {
      array_push($records, self::load($record));
    }

    return $records;
  }


  /**
   * Saves any changes to an entry.
   *
   * Sends to the database an array of information to overwrite the previous
   * record with.
   *
   * @param array $_entries contains the entries to be saved to the database.
   */
  /*
  private function save(array $_entries) {
    DataStore::add($this->toArray(), $_entries);
  }
   */
  private function save() {
    DataStore::createSource($this->toArray());
  }


  /**
   * Convert an instance of this model to an array.
   *
   * Called from inside the model. Used in saving entries to the database.
   */
  private function toArray() {
    return get_object_vars($this);
  }


  /**
   * Update a record.
   *
   * Populate a record and apply the submitted changes.
   *
   * @param array $_post contains changes to a record.
   */
  private function updateRecord(array $_post) {
    $record = self::getById($_post['id']);
    if (!isset($_post['active'])) {
        $_post['active'] = false;
    }

    foreach ($_post as $key => $value) {
      $setMethod = 'set'. ucfirst($key);
      if (method_exists($record, $setMethod)) {
        $record->$setMethod($value);
      }
    }
    $record->update();
  }


  /**
   * Update multiple records.
   *
   * Populate each record and apply the provided acitve state.
   *
   * @param array $_post contains record ids and record states.
   */
  private function updateRecords(array $_post) {
    foreach ($_post['ids'] as $id => $value) {
        $record = self::getById($id);
        if ($value == "off") {
            $record->setActive(false);
        }

        if ($value == "on") {
            $record->setActive(true);
        }

        $record->update();
    }
  }


  /**
   * Getters and setters for this model.
   */
  public function getName() {
    return $this->name;
  }

  public function getPath() {
    return $this->path;
  }

  public function getRecords() {
    // Need to convert to objects.
    return DataStore::getRecordsByName($this->name);
  }

  public function getType() {
    return $this->type;
  }

  public function getUrl() {
    return $this->url;
  }

  public function setName(string $_name) {
    $this->name = $_name;
  }

  public function setPath(string $_path) {
    $this->path = $_path;
  }

  public function setType(string $_type) {
    $this->type = $_type;
  }

  public function setUrl(string $_url) {
    $this->url = $_url;
  }

}
