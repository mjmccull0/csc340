<!--
view for search results
@ Update 12/03/18
@author Jacob Oleson
@author Michael McCulloch
-->

<?php include($this->getTemplatePath(SRC_SEARCH_TEMPLATE)); ?>

<?php if (!empty($query)) { ?>
  <h1><?php echo SEARCH_RESULTS_HEADER; ?></h1>

  <?php $formAction = $this->baseUrl . UPDATE;  ?>
  <?php if (!empty($query)) { ?>
   <?php  $formAction = $formAction . '?redirect=' . $this->baseUrl . SEARCH . '?query=' . $query; ?>
  <?php } ?>
  <form action=<?php echo $formAction; ?> method="POST">
    <ul class="list-view">
      <?php foreach ($this->data as $data) { ?>

      <li class="list-view-item">
        <?php if (method_exists($data, 'getImgUrl')) { ?>
          <?php $thumbUrl = $data->getImgUrl(); ?>
        <?php } else { ?>
          <?php $thumbUrl = "https://via.placeholder.com/120"; ?>
        <?php } ?>
        <img src=<?php echo $thumbUrl ?>>
        <div>
          <span class="title"><?php echo $data->getTitle(); ?></span>
          <br>

          <span class="type"><?php echo "TYPE: " . $data->getType(); ?></span>
          <br>

          <b>Active</b>

          <?php $checked = ''; ?>
          <?php if ($data->getActive()) { ?>
            <?php $checked = 'checked'; ?>
          <?php } ?>
          <input type="hidden" name="ids[<?php echo $data->getId(); ?>]" value="off">
          <input type="checkbox" name="ids[<?php echo $data->getId(); ?>]"  <?php echo $checked; ?>>
        </div>

        <a href="<?php echo $this->baseUrl . EDIT . '?' . ID . '=' . $data->getId()   ?>">
          <?php echo EDIT ?></a>
        <br>
      </li>
      <?php } ?>

    </ul>
    <input class="button" type="submit" value="Save">
  </form>

<?php } ?>
