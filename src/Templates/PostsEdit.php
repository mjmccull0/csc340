<!--
View for Source Controller edit action.
@10/24/18
@author Michael McCulloch
@author Jacob Oleosn
-->
<h2><?php echo POSTS_EDIT_HEADER ?></h2>

<form action="<?php echo POSTS_EDIT_FORM_ACTION ?>" method="post">
  <input type="hidden" name="id" value="<?php echo $this->data->getId(); ?>">
  Title:<br>
  <input type="text" name="title" value="<?php echo $this->data->getTitle(); ?>">
  Active
  <input type="checkbox" name="active" value="active" <?php if ($this->data->getActive()) echo 'checked' ; ?>>
<br>
  <input type="submit" value="Save">
</form>
