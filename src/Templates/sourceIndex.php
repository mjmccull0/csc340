<!-- 
View for Source Controller index action.
@update 10/30/18
@author Michael McCulloch
-->
<div class="header-menu">
  <a href="<?php echo SOURCE_ADD_URL; ?>"><?php echo ADD; ?></a>
</div>
<ul class="list-view">
  <?php foreach ($this->sources as $source) { ?>
  <li class="list-view-item">
    <div>
      <span class="title"><?php echo $source->getName(); ?></span>
    </div>
    <a href="<?php echo SOURCE_EDIT_URL . '?' . NAME . '=' . $source->getName() ?>">
      <?php echo EDIT ?></a>
    <a href="<?php echo "/" . $source->getType() . '?' . NAME . '=' . $source->getName() ?>">
      <?php echo VIEW ?></a>
    <a href="<?php echo '/' . $source->getType() . '/' . SHOW . '?' . NAME . '=' . $source->getName(); ?>">
      <?php echo SHOW ?></a>
  </li>
  <?php } ?>
</ul>
