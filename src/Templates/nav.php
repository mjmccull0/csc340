<?php
/**
 * @update 11/03/18
 * @auther Michael McCulloch
 */
$types = array();
foreach ($this->sources as $source) {
  if(!in_array($source->getType(), $types)) {
    array_push($types, $source->getType());
  }
}
?>
<nav>
<a href="<?php echo SOURCE_INDEX_URL; ?>"><?php echo SOURCES; ?></a>
<?php foreach ($types as $type) { ?>
  <a href="<?php echo SOURCE_INDEX_URL . "?type=" . $type; ?>"><?php echo $type; ?></a>
<?php } ?>
</nav>
