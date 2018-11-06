<!-- 
View for Source Controller edit action.
@update 11/02/18
@author Michael McCulloch
-->
<?php
  $formAction = $this->baseUrl . UPDATE;
  if (isset($_GET['name'])) {
    $formAction .= '?' . NAME . '=' . $_GET['name'];
  }
?>
<h2><?php echo SOURCE_EDIT_HEADER . $this->data->getName() ?></h2>

<form action="<?php echo $formAction; ?>" method="post">
  <input type="hidden" name="name" value="<?php echo $this->data->getName(); ?>">
  url:<br>
  <input type="text" name="url" value="<?php echo $this->data->getUrl(); ?>">
  <br>
  <br>
  <input class="button" type="submit" value="Save">
</form>
