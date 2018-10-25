<?php
namespace Controllers;
use Controllers\BaseController as BaseController;
use Util\Route as Route;

/**
 * @update 10/15/18
 * @author Michael McCulloch
 */

class SourceController extends BaseController {
  private $sources;

  public function __construct() {
    parent::__construct();

    // Get the sources of data.
    $this->sources = $this->db->getSources();

  }


  /**
   * This action is for adding new data sources.
   */
  public function addAction() {
    if (!empty($_POST)) {

      // Add the source if the name is unique.
      if (!isset($this->sources[$_POST['name']])) {
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

        return Route::redirect(SOURCE_INDEX_URL);
      } else {
        // The is already a source with the given name.
      }
    }

    $this->view->setTemplate(SOURCE_ADD_TEMPLATE);
    $this->view->render();

  }


  /**
   * This action lists the data sources.
   */
  public function indexAction() {
    $this->view->setData($this->sources);
    $this->view->setTemplate(SOURCE_INDEX);
    $this->view->render();
  }


  /**
   * This action allows for editing a data source.
   */
  public function editAction() {
    if (!empty($name = $_GET["name"])) {
      $this->view->setData($this->sources[$name]);
      $this->view->setTemplate(SOURCE_EDIT);
      $this->view->render();
    }

    // No name was given, this needs to be handled.

  }

  /**
   * This action handles the changes to a data source.
   */
  public function updateAction() {
    // Check to see if any changes were made to the source.
    if ($this->sources[$_POST['name']]->getUrl() != $_POST['url']) {
      $this->sources[$_POST['name']]->setUrl($_POST['url']);
    }

    // Save the changes to the source.
    $this->db->updateSource($this->sources[$_POST['name']]);

    // Send the user to the index action.
    Route::redirect(SOURCE_INDEX_URL);

  }

}
?>
