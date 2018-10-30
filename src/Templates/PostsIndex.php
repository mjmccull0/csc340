<!--
View for Source Controller index action.
@10/30/2018
@author Michael McCulloch
@author Jacob Oleson
-->
<ul class="list-view">
  <?php foreach ($this->data as $data) { ?>
  <li class="list-view-item">
    <img src=<?php echo $data->getImgUrl(); ?>>
    <div>
      <span class="title"><?php echo $data->getTitle(); ?></span>
    </div>
    <a href="<?php echo POSTS_EDIT_URL . '?' . ID . '=' . $data->getId() ?>">
      <?php echo POSTS_EDIT_LINK_TEXT ?></a>
  </li>
  <?php } ?>
</ul>
