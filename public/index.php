<?php
/**
 * @update 11/03/18
 * @author Michael McCulloch
 */

include("../configs/constants.php");
include(ROOT_DIR . "autoloader.php");
include(ROOT_DIR . "bootstrap.php");

use Util\Route as Route;

Route::route();

?>
