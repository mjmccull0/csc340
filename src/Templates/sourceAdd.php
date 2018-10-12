<!-- 
View for Source Controller add action.
@update 10/12/18
@author Michael McCulloch
-->
<h2><?php echo SOURCE_ADD_HEADER ?></h2>

<form action="<?php echo SOURCE_ADD_FORM_ACTION ?>" method="post">
  name:<br>
  <input type="text" name="name">
  <br>
  url:<br>
  <input type="text" name="url">
  <br>
  <select name="type">
    <?php foreach (SOURCE_TYPE as $option => $value) { ?>
      <?php echo "<option value='$value'>$option</option>" ?>
    <?php } ?>
  </select>
  <br>
  <input type="submit" value="Add">
</form>
