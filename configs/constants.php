<?php
/**
 * Global constants
 * @update 11/05/18
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
define('LAYOUT', TEMPLATE_DIR . "layout.php");
define('SHOW_LAYOUT', TEMPLATE_DIR . "showLayout.php");

define('SOURCE_INDEX', TEMPLATE_DIR . "sourceIndex.php");
define('SOURCE_EDIT', TEMPLATE_DIR . "edit.php");

define('SOURCE_ADD_TEMPLATE', TEMPLATE_DIR . "sourceAdd.php");
define('SOURCE_ADD_HEADER', "Add Source");

// FIXME: Remove source types.
define('SOURCE_TYPE', array(
  'Wordpress' => 'PostsModel',
  'Instagram' => 'InstagramModel',
  'YouTube' => 'YoutubeModel'
));

define('SOURCE_EDIT_HEADER', "Edit Source: ");

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
define('EDIT', "edit");
define('VIEW', 'view');
define('SHOW', 'show');
define('SOURCES', 'Sources');
define('UPDATE', 'update');

define('LANG', 'en');
define('CHARSET', 'utf-8');
define('YOUTUBE_CHANNEL_URL', 'https://www.youtube.com/feeds/videos.xml');
define('YOUTUBE_SHOW_URL', 'https://www.youtube.com/embed/0Cxt8DvyG2Q?autoplay=1&mute=1&autohide=0&loop=1&fs=1&rel=0&hd=0&wmode=window&enablejsapi=1&playlist=');

define('WP_JSON_URL', '/wp-json/wp/v2/posts?_embed');
define('INSTAGRAM_URL', 'https://www.instagram.com');

define('SOURCE_VIEW', TEMPLATE_DIR . "SourceView.php");
define('SOURCE_SHOW', TEMPLATE_DIR . "SourceShow.php");
?>
