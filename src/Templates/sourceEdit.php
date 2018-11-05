<!-- 
View for Source Controller edit action.
@update 11/02/18
@author Michael McCulloch
-->
<h2><?php echo SOURCE_EDIT_HEADER . $this->data->getName() ?></h2>

<form action="<?php echo EDIT_FORM_ACTION;

  if (isset($_GET['name'])) {
    echo "?" . NAME . '=' . $_GET['name'];
  } ?>" method="post">

  <input type="hidden" name="name" value="<?php echo $this->data->getName(); ?>">
  url:<br>
  <input type="text" name="url" value="<?php echo $this->data->getUrl(); ?>">
  <br>
  <br>
  <input class="button" type="submit" value="Save">
</form>
