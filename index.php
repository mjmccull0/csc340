<?php
/**
 * @date 9/18/18
 * @author Michael McCulloch
 */

// Tells php to look in the the same directory this file is in
// for invoked classes.
spl_autoload_register(
  function ($className) {
    include $className . '.php';
  }
);

// This is probably a temporary way to route an
// appropriate controller and action.
Util::getRoute($_SERVER['REQUEST_URI']);

?>
