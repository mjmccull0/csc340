<?php
/**
 * @update 9/27/18
 * @author Michael McCulloch
 */

include("../configs/constants.php");
include(ROOT_DIR . "autoloader.php");
include(ROOT_DIR . "bootstrap.php");

// For code review purposes
use DB\TextDB as TextDB;

$db = TextDB::connect();

$db->get('posts');
$db->get('instagram');
$db->get('youtube');

var_dump('<pre>');
var_dump($db);


?>
