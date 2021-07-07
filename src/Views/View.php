<?php
namespace Views;
/**
 * @update 12/13/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */

class View {
  private $data;
  private $headScripts = '';
  private $headStyles = '';
  private $layout;
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

  // View for the UNCG Youtube.
  public function youtubeView(){
    render();    
  }
  
  // View for UNCG webpage.
  public function webpageView(){
    render();
  }
  
  // View for UNCG instagram.
  public function instagramView(){
    render();
  }
  
  public function getData() {
    return $this->data;
  }

  public function setData($_data) {
    $this->data = $_data;
  }

  public function setLayout($_layoutPath) {
    $this->layout = $this->getTemplatePath($_layoutPath);
  }

  public function setTemplate($_relativeTemplatePath) {
    $this->template = $this->getTemplatePath($_relativeTemplatePath);
  }

  public function getTemplatePath($_relativeTemplatePath) {
    if (true === ALLOW_TEMPLATE_OVERRIDE && file_exists(TEMPLATE_DIR . $_relativeTemplatePath)) {
      return TEMPLATE_DIR . $_relativeTemplatePath;
    } else if (file_exists(DEFAULT_TEMPLATE_DIR . $_relativeTemplatePath)) {
      return DEFAULT_TEMPLATE_DIR . $_relativeTemplatePath;
    } else {
      // A template wasn't found.
      echo "A template was not found at: " . TEMPLATE_DIR . $_relativeTemplatePath .
        " or " . DEFAULT_TEMPLATE_DIR . $_relativeTemplatePath;
    }
  }

}
?>
