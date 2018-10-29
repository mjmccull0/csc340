<?php

namespace Views;
/**
 * @update 10/29/18
 * @author Michael McCulloch
 * @author Charles Brady
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
        // Gets the text for the html
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
    
        // Default view for the UNCG Youtube page.
    public function youtubeLayout($_youtubeView){
        $this->view = $_youtubeView;
    }
        // Default view for the UNCG homepage.
    public function webLayout($_webView){
        $this->view = $_webView;
    }
        // Default view for the UNCG instagram page.
    public function instagramLayout($_instagramView){
        $this->view = $_instagramView;
    }
    
        // Getter for data
    public function getData() {
        return $this->data;
    }
        // Setter for data
    public function setData($_data) {
        $this->data = $_data;
    }
        // Getter for Layout
    public function getLayout(){
        return $this->layout;
    }
        // Setter for Layout
    public function setLayout($_layoutPath) {
        $this->layout = $_layoutPath;
    }  
        // Getter for Template
    public function getTemplate(){
        return $this->template;
    }
        // Setter for Template
    public function setTemplate($_templatePath) {
        $this->template = $_templatePath;
    }
}
?>