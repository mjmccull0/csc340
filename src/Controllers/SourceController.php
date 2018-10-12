<?php
namespace Controllers;
use Views\View as View;
use DB\TextDB as TextDB;

/**
 * @update 10/12/18
 * @author Michael McCulloch
 */

class SourceController {
  private $db;
  private $sources;

  public function __construct() {
    // Get access to the data.
    $this->db = TextDB::connect();

    // Get the sources of data.
    $this->sources = $this->db->getSources();

    // Create a new view and give it data.
    $this->view = new View();
  }

  public function addAction() {
    if (!empty($_POST)) {
      $dataSourceType = $_POST['type'];

      $dataSourceFqn = "\\DataSources\\" . $dataSourceType;

      // Need to prevent adding of dataSource name collisions.

      $dataSource = $dataSourceFqn::create(
        array(
          'name' => $_POST['name'],
          'url' => $_POST['url']
        )
      );

      $this->db->addSource($dataSource);

      return $this->redirect(SOURCE_INDEX_URL);
    }

    $this->view->setTemplate(SOURCE_ADD_TEMPLATE);
    $this->view->render();

  }

  public function indexAction() {
    $this->view->setData($this->sources);
    $this->view->setTemplate(SOURCE_INDEX);
    $this->view->render();
  }

  public function editAction() {
    if (!empty($name = $_GET["name"])) {
      $this->view->setData($this->sources[$name]);
      $this->view->setTemplate(SOURCE_EDIT);
      $this->view->render();
    }

    // No name was given, this needs to be handled.

  }

  public function updateAction() {
    // Check to see if any changes were made to the source.
    // This needs to be refactored, we can't trust any user input.
    if ($this->sources[$_POST['name']]->getUrl() != $_POST['url']) {
      $this->sources[$_POST['name']]->setUrl($_POST['url']);
    }

    // Save the changes to the source.
    $this->db->updateSource($this->sources[$_POST['name']]);

    // Send the user to the index action.
     header("Location: " . SOURCE_INDEX_URL);

  }


  /**
   * Send to user's browser to the provided relative url.
   */
  public function redirect($_relativeUrl) {
    header("Location: " . $_relativeUrl);
  }
}
?>
