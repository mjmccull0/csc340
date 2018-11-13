<!--
View for Source Controller edit action.
@update 12/13/2018
@author Michael McCulloch
-->
<?php 
if ($this->isSource) {
  $template = $this->getTemplatePath(SOURCE . DS . EDIT . '.php');
} else {
  $template = $this->getTemplatePath($this->data->getType() . DS . EDIT . '.php');
}

include $this->getTemplatePath('Form' . DS . 'formUpdateAction.php');
include $template;
?>
