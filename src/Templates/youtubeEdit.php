
<!--
View for Youtube Controller edit action.
@11/04/18
@author Michael McCulloch
@author Jacob Oleosn
-->
<form action="<?php echo EDIT_FORM_ACTION; ?><?php
  if (isset($_GET['name'])) {
    echo "?" . NAME . '=' . $_GET['name'];
  } ?>" method="post">
  <input type="hidden" name="id" value="<?php echo $this->data->getId(); ?>">
  Title:<br>
  <input type="text" name="title" value="<?php echo $this->data->getTitle(); ?>">
  Active
  <input type="checkbox" name="active" value="active" <?php if ($this->data->getActive()) echo 'checked' ; ?>>
<br>
  <input class="button" type="submit" value="Save">
</form>
