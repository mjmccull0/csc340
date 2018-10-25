<?php
/**
 * Global constants
 * @update 10/12/18
 * @author Michael McCulloch
 */
define('ROOT_DIR', str_replace('public', '', $_SERVER['DOCUMENT_ROOT']));
define('DATA_DIR', ROOT_DIR . "resources" . DIRECTORY_SEPARATOR);
define('DATA_SOURCES', ROOT_DIR . "resources" . DIRECTORY_SEPARATOR . "sources");
define('DB_FILE', ROOT_DIR . "resources" . DIRECTORY_SEPARATOR . "db");
define('CONFIG_DIR', ROOT_DIR . "configs" . DIRECTORY_SEPARATOR);

define('TEMPLATE_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "Templates" . DIRECTORY_SEPARATOR);
define('LAYOUT', TEMPLATE_DIR . "layout.php");


define('SOURCE_INDEX_URL', "/source");
define('SOURCE_INDEX', TEMPLATE_DIR . "sourceIndex.php");
define('SOURCE_EDIT', TEMPLATE_DIR . "sourceEdit.php");


define('SOURCE_ADD_TEMPLATE', TEMPLATE_DIR . "sourceAdd.php");
define('SOURCE_ADD_URL', "/source/add");
define('SOURCE_ADD_HEADER', "Add Source");
define('SOURCE_ADD_FORM_ACTION', "/source/add");
define('SOURCE_TYPE', array(
  'Wordpress' => 'WpDataSource',
  'Instagram' => 'InstagramDataSource',
  'YouTube' => 'YoutubeDataSource'
));


define('SOURCE_EDIT_URL', "/source/edit");
define('SOURCE_EDIT_HEADER', "Edit Source: ");
define('SOURCE_EDIT_LINK_TEXT', "edit");
define('SOURCE_EDIT_FORM_ACTION', "/source/update");

define('NAME', "name");

define('YOUTUBE_SHOW_URL', 'https://www.youtube.com/embed/0Cxt8DvyG2Q?autoplay=1&mute=1&autohide=0&loop=1&fs=1&rel=0&hd=0&wmode=window&enablejsapi=1&playlist=');
?>
