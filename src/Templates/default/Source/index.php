<!-- 
View for Source Controller index action.
@update 12/03/18
@author Michael McCulloch
@author Jacob Oleson
-->
<div class="header-menu">
  <a href="<?php echo $this->baseUrl . ADD; ?>"><?php echo ucfirst(ADD); ?></a>
  <a href="<?php echo $this->baseUrl . SEARCH; ?>"><?php echo ucfirst(SEARCH); ?></a>
  <a href="<?php echo $this->baseUrl . UPDATE; ?>"><?php echo ucfirst(UPDATE); ?></a>
</div>
<ul class="list-view">
  <?php foreach ($this->data as $source) { ?>
  <li class="list-view-item">
    <div class="source">
      <span class="title"><?php echo $source->getName(); ?></span>
    </div>
    <a href="<?php echo $this->baseUrl .  EDIT . '?' . NAME . '=' . $source->getName() ?>">
      <?php echo EDIT ?></a>
    <a href="<?php echo $this->baseUrl .  DELETE . '?' . NAME . '=' . $source->getName() ?>">
      <?php echo DELETE ?></a>
    <a href="<?php echo $this->baseUrl  . VIEW . '?' . NAME . '=' . $source->getName() ?>">
      <?php echo VIEW ?></a>
    <a href="<?php echo $this->baseUrl  . SHOW . '?' . NAME . '=' . $source->getName(); ?>">
      <?php echo SHOW ?></a>
  </li>
  <?php } ?>
</ul>
