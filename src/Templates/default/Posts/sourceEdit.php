<?php $siteUrl = 'http://' .  parse_url($this->data->getUrl())['host']; ?>
  <div id="Posts">
    Site Url:<br>
    <input type="text" name="wp-site-url" value="<?php echo $siteUrl; ?>">
    <br>
  </div>
