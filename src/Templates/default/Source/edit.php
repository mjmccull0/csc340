<!-- 
View for Source Controller edit action.
@update 12/13/18
@author Michael McCulloch
-->
<?php
include $this->getTemplatePath('Form' . DS . 'formUpdateAction.php');
?>

<h2><?php echo SRC_EDIT_HEADER . $this->data->getName() ?></h2>

<form action="<?php echo $formUpdateAction; ?>" method="post">
  <input type="hidden" name="name" value="<?php echo $this->data->getName(); ?>">
  <?php include $this->getTemplatePath($this->source->getType() . DS . 'sourceEdit.php'); ?>
  <br>
  <input class="button" type="submit" value="Save">
</form>
