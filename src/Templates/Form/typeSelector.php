<?php $dir = SRC_DIR . DS . 'Models' . DS . 'Content' . DS . 'Type' . DS; ?>
<select id="type-selector" name="type" onchange="getFields()">
  <option label=" "></option>
  <?php foreach(glob($dir . "*.php") as $filename) { ?>
  <option value='<?php echo basename($filename, '.php'); ?>'><?php echo str_replace('Model', '', basename($filename, '.php')); ?></option>
  <?php } ?>
</select>
