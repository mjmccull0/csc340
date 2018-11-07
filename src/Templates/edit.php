<!--
View for Source Controller edit action.
@11/07/2018
@author Michael McCulloch
-->
<?php 
if ($this->isSource) {
  $template = SRC_TEMPLATE_DIR . DS . EDIT . '.php';
} else {
  $template = TEMPLATE_DIR . $this->data->getType() . DS . EDIT . '.php';
}

include TEMPLATE_DIR . 'Form' . DS . 'formUpdateAction.php';
include $template;
?>
