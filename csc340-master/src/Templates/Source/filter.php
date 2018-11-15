<!--
view for search results
@ Update 11/15/18
@author Jacob Oleson
-->

<h1>Search Results:</h1>
<?php
var_dump('<pre>');
var_dump($this->data);

// foreach($this->data as $record) {
//   echo $record->getTitle();
//   echo "      ";
// }
?>

<?php foreach ($this->data as $data) { ?>

  <?php if (method_exists($data, 'getImgUrl')) { ?>
    <img src=<?php echo $data->getImgUrl(); ?>>
  <?php } ?>
  <div>
    <span class="title"><?php echo $data->getTitle(); ?></span>
  </div>
  <a href="<?php echo $this->baseUrl . EDIT . '?' . ID . '=' . $data->getId()   ?>">
    <?php echo EDIT ?></a>
<?php } ?>
</ul>
