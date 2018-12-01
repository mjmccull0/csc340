<?php
/**
 * @update 11/05/18
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
<a href="<?php echo $this->baseUrl; ?>"><?php echo SOURCES; ?></a>
<?php foreach ($types as $type) { ?>
  <a href="<?php echo $this->baseUrl . "?type=" . $type; ?>"><?php echo $type; ?></a>
<?php } ?>
</nav>
