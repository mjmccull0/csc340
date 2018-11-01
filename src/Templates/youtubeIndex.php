<!-- 
View for Youtube Controller index action.
@update 10/30/18
@author Michael McCulloch
-->
<ul class="list-view">
  <?php foreach ($this->data as $data) { ?>
  <li class="list-view-item">
    <div>
      <span><?php echo $data->getTitle(); ?></span>
    </div>
    <a href="<?php echo YOUTUBE_EDIT_URL . '?' . ID . '=' . $data->getId() ?>">
      <?php echo EDIT ?></a>
  </li>
  <?php } ?>
</ul>
