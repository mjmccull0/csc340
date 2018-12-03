<!--
view for search results
@ Update 12/03/18
@author Jacob Oleson
@author Michael McCulloch
-->

<h1>Search Results:</h1>


<form>

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

        <input type="checkbox" name="active" value="active" <?php if ($data->getActive()) echo 'checked' ; ?>>
      </div>

      <a href="<?php echo $this->baseUrl . EDIT . '?' . ID . '=' . $data->getId()   ?>">
        <?php echo EDIT ?></a>
      <br>
    </li>
    <?php } ?>

</ul>
<input class="button" type="submit" value="Save">
</form>
