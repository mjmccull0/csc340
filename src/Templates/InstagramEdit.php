<!--
View for Source Controller edit action.
@10/24/18
@author Michael McCulloch
@author Jacob Oleson
-->
<h2><?php echo INSTAGRAM_EDIT_HEADER ?></h2>

<form action="<?php echo INSTAGRAM_EDIT_FORM_ACTION ?>" method="instagram">
  <input type="hidden" name="id" value="<?php echo $this->data->getId(); ?>">
  Title:<br>
  <input type="text" name="title" value="<?php echo $this->data->getTitle(); ?>">
  Active
  <input type="checkbox" name="active" value="active" <?php if ($this->data->getActive()) echo 'checked' ; ?>>
<br>
  <input type="submit" value="Save">
</form>
