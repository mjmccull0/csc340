<!--
View for Source Controller view action.
@11/04/2018
@author Michael McCulloch
@author Jacob Oleson
-->
<?php include 'source.php'; ?>
<ul class="list-view">
  <?php foreach ($this->data as $data) { ?>
  <li class="list-view-item">
    <?php if (method_exists($data, 'getImgUrl')) { ?>
      <img src=<?php echo $data->getImgUrl(); ?>>
    <?php } ?>
    <div>
      <span class="title"><?php echo $data->getTitle(); ?></span>
    </div>
    <a href="<?php echo SOURCE_INDEX_URL . '/' . EDIT . '?' . ID . '=' . $data->getId() . '&name=' . $this->source->getName(); ?>">
      <?php echo EDIT ?></a>
  </li>
  <?php } ?>
</ul>
