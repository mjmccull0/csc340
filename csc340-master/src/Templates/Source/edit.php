<!-- 
View for Source Controller edit action.
@update 11/07/18
@author Michael McCulloch
-->
<?php include TEMPLATE_DIR . 'Form' . DS . 'formUpdateAction.php'; ?>

<h2><?php echo SRC_EDIT_HEADER . $this->data->getName() ?></h2>

<form action="<?php echo $formUpdateAction; ?>" method="post">
  <input type="hidden" name="name" value="<?php echo $this->data->getName(); ?>">
  <?php include TEMPLATE_DIR . $this->source->getType() . DS . 'sourceEdit.php'; ?>
  <br>
  <input class="button" type="submit" value="Save">
</form>
