<!-- 
View for Source Controller index action.
@update 10/30/18
@author Michael McCulloch
-->
<ul class="list-view">
  <?php foreach ($this->data as $source) { ?>
  <li class="list-view-item">
    <div>
      <span class="title"><?php echo $source['name']; ?></span>
    </div>
    <a href="<?php echo SOURCE_EDIT_URL . '?' . NAME . '=' . $source['name'] ?>">
      <?php echo EDIT ?></a>
    <a href="<?php echo "/" . $source['type'] . '?' . NAME . '=' . $source['name'] ?>">
      <?php echo VIEW ?></a>
    <a href="<?php echo '/' . $source['type'] . '/' . SHOW . '?' . NAME . '=' . $source['name']; ?>">
      <?php echo SHOW ?></a>
  </li>
  <?php } ?>
</ul>
