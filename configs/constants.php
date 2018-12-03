<?php
/**
 * Global constants
 * @update 12/13/18
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

define('ALLOW_TEMPLATE_OVERRIDE', true);
define('TEMPLATE_DIR', ROOT_DIR . DS . "src" . DS . "Templates" . DS);
define('DEFAULT_TEMPLATE_DIR', TEMPLATE_DIR . 'default' . DS);
define('DEFAULT_LAYOUT', "Layouts/default.php");
define('SHOW_LAYOUT', "Layouts/show.php");


define('ADD', 'add');
define('NAV', 'nav.php');
define('ID', "id");
define('NAME', "name");
define('EDIT',"edit");
define('DELETE',"delete");
define('VIEW', 'view');
define('SHOW', 'show');
define('SOURCE', 'Source');
define('SOURCES', 'Sources');
define('SEARCH', 'search');
define('UPDATE', 'update');
define('LANG', 'en');
define('CHARSET', 'utf-8');

define('EDIT_TEMPLATE', 'edit.php');
define('SRC_INDEX', "Source/index.php");
define('SRC_TEMPLATE_DIR', TEMPLATE_DIR . SOURCE);
define('SRC_VIEW', SOURCE . DS . "view.php");
define('SRC_EDIT', SOURCE . DS . "edit.php");
define('SRC_SHOW', SOURCE . DS . "show.php");

define('SRC_ADD_TEMPLATE', SOURCE . DS . "add.php");
define('SRC_ADD_HEADER', "Add Source");

define('SRC_SEARCH_TEMPLATE', SOURCE . DS . "search.php");
define('FILTER', SOURCE . DS . "filter.php");

define('SRC_EDIT_HEADER', "Edit Source: ");

define('POSTS', 'Posts');
define('POSTS_EDIT_HEADER', "Edit Post: ");

define('YOUTUBE', 'Youtube');
define('YOUTUBE_EDIT_HEADER', "Edit YouTube: ");

define('INSTAGRAM', 'Instagram');
define('INSTAGRAM_EDIT_HEADER', "Edit Instagram: ");

define('YOUTUBE_CHANNEL_URL', 'https://www.youtube.com/feeds/videos.xml');
define('YOUTUBE_SHOW_URL', 'https://www.youtube.com/embed/0Cxt8DvyG2Q?autoplay=1&mute=1&autohide=0&loop=1&fs=1&rel=0&hd=0&wmode=window&enablejsapi=1&playlist=');

define('WP_JSON_URL', '/wp-json/wp/v2/posts?_embed');
define('INSTAGRAM_URL', 'https://www.instagram.com');

?>
