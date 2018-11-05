<!--
View for Source Controller edit action.
@11/04/18
@author Michael McCulloch
@author Jacob Oleson
-->
<div class="edit-container">
  <div class="img-container"> 
    <img src="<?php echo $this->data->getImgUrl(); ?>">
  </div>
  
  <div class="edit-form">
    <form action="<?php echo EDIT_FORM_ACTION;
      ?><?php if (isset($_GET['name'])) { echo "?" . NAME . '=' . $_GET['name']; } ?>" method="post">
      <input type="hidden" name="id" value="<?php echo $this->data->getId(); ?>">
      Title:<br>
      <textarea type="text" name="title"><?php echo $this->data->getTitle(); ?></textarea>
      <br>
      Active
      <input type="checkbox" name="active" value="active" <?php if ($this->data->getActive()) echo 'checked' ; ?>>
      <br>
      <input class="button" type="submit" value="Save">
    </form>
  </div>
</div>
