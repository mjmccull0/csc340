<!-- 
View for Source Controller index action.
@update 10/12/18
@author Michael McCulloch
-->
<ul>
  <?php foreach ($this->data as $source) { ?>
  <li>
    <span><?php echo $source->getName(); ?></span>
    <a href="<?php echo SOURCE_EDIT_URL . '?' . NAME . '=' . $source->getName() ?>">
      <?php echo SOURCE_EDIT_LINK_TEXT ?></a>
  </li>
  <?php } ?>
</ul>
