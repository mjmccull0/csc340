<!-- 
View for Source Controller add action.
@update 11/05/18
@author Michael McCulloch
-->
<h2><?php echo SOURCE_ADD_HEADER ?></h2>

<form action="<?php echo $this->baseUrl . ADD ?>" method="post">
  <div>
    <div>
      name:<br>
      <input type="text" name="name">
    </div>

    <div id="dynamic-form-fields-container">
    </div>
  </div>
  <?php include 'typeSelector.php'; ?>
  <br>
  <input type="submit" value="Add">
</form>

<div id="dynamic-form-fields" style="display: none";>
  <div id="YouTube">
    Channel ID:<br>
    <input type="text" name="channel_id">
    <br>
  </div>
  <div id="Wordpress">
    Site Url:<br>
    <input type="text" name="wp-site-url">
    <br>
  </div>
  <div id="Instagram">
    Instagram Account:<br>
    <input type="text" name="instagram-account">
    <br>
  </div>
</div>

<script>
function getFields() {
  document.getElementById("dynamic-form-fields-container").innerHTML = '';

  let selection = document.getElementById("type-selector");
  let id = selection.options[selection.selectedIndex].text;

  let fields = document.getElementById(id);

  let inputs = document.createElement('div');
  inputs.innerHTML = fields.innerHTML;
  

  let container = document.getElementById("dynamic-form-fields-container");
  container.appendChild(inputs);
}
</script>
