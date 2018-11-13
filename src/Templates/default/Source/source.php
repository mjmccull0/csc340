<div class="list-view-item">
    <div class="source">
      <span class="title"><?php echo $this->source->getName(); ?></span>
    </div>
    <a href="<?php echo $this->baseUrl . EDIT . '?' . NAME . '=' . $this->source->getName() ?>">
      <?php echo EDIT ?></a>
    <a href="<?php echo $this->baseUrl . SHOW . '?' . NAME . '=' . $this->source->getName(); ?>">
      <?php echo SHOW ?></a>
</div>
