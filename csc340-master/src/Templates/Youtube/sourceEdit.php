<?php
$parts = parse_url($this->data->getUrl());
parse_str($parts['query'], $query);
$channel_id = $query['channel_id'];
?>
  <div id="YouTube">
    Channel ID:<br>
    <input type="text" name="channel_id" value="<?php echo $channel_id; ?>">
    <br>
  </div>
