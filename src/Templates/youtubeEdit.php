
<!--
View for Youtube Controller edit action.
@10/30/18
@author Michael McCulloch
@author Jacob Oleosn
-->
<form action="<?php echo YOUTUBE_EDIT_FORM_ACTION ?>" method="post">
  <input type="hidden" name="id" value="<?php echo $this->data->getId(); ?>">
  Title:<br>
  <input type="text" name="title" value="<?php echo $this->data->getTitle(); ?>">
  Active
  <input type="checkbox" name="active" value="active" <?php if ($this->data->getActive()) echo 'checked' ; ?>>
<br>
  <input class="button" type="submit" value="Save">
</form>
