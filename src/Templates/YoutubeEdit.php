
<!--
View for Youtube Controller edit action.
@11/05/18
@author Michael McCulloch
@author Jacob Oleosn
-->
<?php include 'formUpdateAction.php'; ?>
<form action="<?php echo $formUpdateAction; ?>" method="post">
  <input type="hidden" name="id" value="<?php echo $this->data->getId(); ?>">
  Title:<br>
  <input type="text" name="title" value="<?php echo $this->data->getTitle(); ?>">
  Active
  <input type="checkbox" name="active" value="active" <?php if ($this->data->getActive()) echo 'checked' ; ?>>
<br>
  <input class="button" type="submit" value="Save">
</form>
