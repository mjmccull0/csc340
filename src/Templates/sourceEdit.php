<!-- 
View for Source Controller edit action.
@update 10/12/18
@author Michael McCulloch
-->
<h2><?php echo SOURCE_EDIT_HEADER . $this->data->getName() ?></h2>

<form action="<?php echo SOURCE_EDIT_FORM_ACTION ?>" method="post">
  <input type="hidden" name="name" value="<?php echo $this->data->getName(); ?>">
  url:<br>
  <input type="text" name="url" value="<?php echo $this->data->getUrl(); ?>">
  <br>
  <input type="submit" value="Save">
</form>
