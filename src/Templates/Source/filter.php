<!--
view for search results
@ Update 11/27/18
@author Jacob Oleson
-->

<h1>Search Results:</h1>


<?php foreach ($this->data as $data) { ?>

  <?php if (method_exists($data, 'getImgUrl')) { ?>
    <img src=<?php echo $data->getImgUrl(); ?>>
  <?php } ?>
  <div>
    <span class="title"><?php echo $data->getTitle(); ?></span>
    <br>

    <span class="type"><?php echo "TYPE: " . $data->getType(); ?></span>
    <br>

    <b>Active</b>

    <input type="checkbox" name="active" value="active" <?php if ($data->getActive()) echo 'checked' ; ?>>
  </div>

  <a href="<?php echo $this->baseUrl . EDIT . '?' . ID . '=' . $data->getId()   ?>">
    <?php echo EDIT ?></a>
  <br>
<?php } ?>

<input class="button" type="submit" value="Save">
