<!--
View for Source Controller edit action.
@11/05/2018
@author Michael McCulloch
-->
<?php 
if ($this->isSource) {
    include 'sourceEdit.php';
} else {
  include $this->data->getType() . ucfirst(EDIT) . '.php';
}
?>
