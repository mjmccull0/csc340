<?php
define('ROOT_DIR', str_replace('public', '', $_SERVER['DOCUMENT_ROOT']));
define('DATA_DIR', ROOT_DIR . "resources" . DIRECTORY_SEPARATOR);
define('DATA_SOURCES', ROOT_DIR . "resources" . DIRECTORY_SEPARATOR . "sources.txt");
define('CONFIG_DIR', ROOT_DIR . "configs" . DIRECTORY_SEPARATOR);
?>
