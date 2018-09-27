<?php
/**
 * Global constants
 * @update 9/27/18
 * @author Michael McCulloch
 */
define('ROOT_DIR', str_replace('public', '', $_SERVER['DOCUMENT_ROOT']));
define('DATA_DIR', ROOT_DIR . "resources" . DIRECTORY_SEPARATOR);
define('DATA_SOURCES', ROOT_DIR . "resources" . DIRECTORY_SEPARATOR . "sources");
define('DB_FILE', ROOT_DIR . "resources" . DIRECTORY_SEPARATOR . "db");
define('CONFIG_DIR', ROOT_DIR . "configs" . DIRECTORY_SEPARATOR);
?>
