<!--
Form update action.
@11/05/18
@author Michael McCulloch
@author Jacob Oleosn
-->
<?php
  $formUpdateAction = $this->baseUrl . UPDATE;
  if (isset($_GET['name'])) {
    $formUpdateAction .= '?' . NAME . '=' . $_GET['name'];
  }
?>
