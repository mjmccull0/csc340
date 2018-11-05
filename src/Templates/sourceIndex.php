<!-- 
View for Source Controller index action.
@update 11/04/18
@author Michael McCulloch
-->
<div class="header-menu">
  <a href="<?php echo SOURCE_ADD_URL; ?>"><?php echo ADD; ?></a>
</div>
<ul class="list-view">
  <?php foreach ($this->data as $source) { ?>
  <li class="list-view-item">
    <div class="source">
      <span class="title"><?php echo $source->getName(); ?></span>
    </div>
    <a href="<?php echo SOURCE_EDIT_URL . '?' . NAME . '=' . $source->getName() ?>">
      <?php echo EDIT ?></a>
    <a href="<?php echo SOURCE_INDEX_URL . '/' . VIEW . '?' . NAME . '=' . $source->getName() ?>">
      <?php echo VIEW ?></a>
    <a href="<?php echo SOURCE_INDEX_URL . '/' . SHOW . '?' . NAME . '=' . $source->getName(); ?>">
      <?php echo SHOW ?></a>
  </li>
  <?php } ?>
</ul>
