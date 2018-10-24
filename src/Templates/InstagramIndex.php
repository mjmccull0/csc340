<!--
View for Source Controller index action.
@10/24/2018
@author Michael McCulloch
@author Jacob Oleson
-->
<ul>
  <?php foreach ($this->data as $data) { ?>
  <li>
    <span><?php echo $data->getTitle(); ?></span>
    <img src = <?php echo $data->getImgUrl() ; ?>>
    <a href="<?php echo INSTAGRAM_EDIT_URL . '?' . ID . '=' . $data->getId() ?>">
      <?php echo INSTAGRAM_EDIT_LINK_TEXT ?></a>
  </li>
  <?php } ?>
</ul>
