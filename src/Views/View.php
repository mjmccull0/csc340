<?php
namespace Views;
/**
 * @update 10/22/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */

class View {
  private $data;
  private $headScripts = '';
  private $headStyles = '';
  private $layout = LAYOUT;
  private $template;

  public function addHeadScript($_scriptPath) {
    $this->headScripts .= <<<EOT
<script src="$_scriptPath"></script>
EOT;
  }


  public function addHeadStyle($_stylePath) {
    $this->headStyles .= <<<EOT
<link rel="stylesheet" href="$_stylePath">
EOT;
  }

  public function getText($_text) {
    return htmlspecialchars($_text);
  }

  public function render() {

    // Enables the output buffer.
    ob_start();

    // Include the template file.
    include($this->template);

    // Set the rendered template file to a variable
    // and disable the output buffer.
    $this->content = ob_get_clean();

    // Enables the output buffer.
    ob_start();

    // Include the layout file.
    include($this->layout);

    // Set the rendered layout file to a variable
    // and disable the output buffer.
    $output = ob_get_clean();

    // Display the layout with the template.
    echo $output;
  }

  public function getData() {
    return $this->data;
  }

  public function setData($_data) {
    $this->data = $_data;
  }

  public function setLayout($_layoutPath) {
    $this->layout = $_layoutPath;
  }

  public function setTemplate($_templatePath) {
    $this->template = $_templatePath;
  }

  public function display($_data) {
    var_dump($_data);
  }
}
?>
