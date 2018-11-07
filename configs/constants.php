<?php
/**
 * Global constants
 * @update 11/07/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', str_replace('public', '', $_SERVER['DOCUMENT_ROOT']));
define('SRC_DIR', ROOT_DIR . DS . 'src');
define('DATA_DIR', ROOT_DIR . "resources" . DS);
define('DATA_SOURCES', ROOT_DIR . "resources" . DS . "sources");
define('DB_FILE', ROOT_DIR . "resources" . DS . "db");
define('CONFIG_DIR', ROOT_DIR . "configs" . DS);

define('TEMPLATE_DIR', ROOT_DIR . DS . "src" . DS . "Templates" . DS);
define('DEFAULT_LAYOUT', TEMPLATE_DIR . "Layouts/default.php");
define('SHOW_LAYOUT', TEMPLATE_DIR . "Layouts/show.php");

define('EDIT_TEMPLATE', TEMPLATE_DIR . 'edit.php');
define('SRC_INDEX', TEMPLATE_DIR . "Source/index.php");
define('SRC_EDIT', TEMPLATE_DIR . "Source/edit.php");

define('SRC_ADD_TEMPLATE', TEMPLATE_DIR . "Source/add.php");
define('SRC_ADD_HEADER', "Add Source");


define('SRC_EDIT_HEADER', "Edit Source: ");

define('POSTS', 'Posts');
define('POSTS_EDIT_HEADER', "Edit Post: ");

define('YOUTUBE', 'Youtube');
define('YOUTUBE_EDIT_HEADER', "Edit YouTube: ");

define('INSTAGRAM', 'Instagram');
define('INSTAGRAM_EDIT_HEADER', "Edit Instagram: ");

define('ADD', 'add');
define('NAV', TEMPLATE_DIR . 'nav.php');
define('ID', "id");
define('NAME', "name");
define('EDIT',"edit");
define('DELETE',"delete");
define('VIEW', 'view');
define('SHOW', 'show');
define('SOURCE', 'Source');
define('SOURCES', 'Sources');
define('UPDATE', 'update');

define('LANG', 'en');
define('CHARSET', 'utf-8');
define('YOUTUBE_CHANNEL_URL', 'https://www.youtube.com/feeds/videos.xml');
define('YOUTUBE_SHOW_URL', 'https://www.youtube.com/embed/0Cxt8DvyG2Q?autoplay=1&mute=1&autohide=0&loop=1&fs=1&rel=0&hd=0&wmode=window&enablejsapi=1&playlist=');

define('WP_JSON_URL', '/wp-json/wp/v2/posts?_embed');
define('INSTAGRAM_URL', 'https://www.instagram.com');

define('SRC_TEMPLATE_DIR', TEMPLATE_DIR . SOURCE);
define('SRC_VIEW', SRC_TEMPLATE_DIR . DS . "view.php");
define('SRC_SHOW', SRC_TEMPLATE_DIR . DS . "show.php");
?>
