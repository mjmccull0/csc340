<div class="list-view-item">
    <div class="source">
      <span class="title"><?php echo $this->source->getName(); ?></span>
    </div>
    <a href="<?php echo SOURCE_EDIT_URL . '?' . NAME . '=' . $this->source->getName() ?>">
      <?php echo EDIT ?></a>
    <a href="<?php echo SOURCE_INDEX_URL . '/' . SHOW . '?' . NAME . '=' . $this->source->getName(); ?>">
      <?php echo SHOW ?></a>
</div>
