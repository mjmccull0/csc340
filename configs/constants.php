<?php
/**
 * Global constants
 * @update 10/24/18
 * @author Michael McCulloch
 * @author Jacob Oleson
 */
define('ROOT_DIR', str_replace('public', '', $_SERVER['DOCUMENT_ROOT']));
define('DATA_DIR', ROOT_DIR . "resources" . DIRECTORY_SEPARATOR);
define('DATA_SOURCES', ROOT_DIR . "resources" . DIRECTORY_SEPARATOR . "sources");
define('DB_FILE', ROOT_DIR . "resources" . DIRECTORY_SEPARATOR . "db");
define('CONFIG_DIR', ROOT_DIR . "configs" . DIRECTORY_SEPARATOR);

define('TEMPLATE_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "Templates" . DIRECTORY_SEPARATOR);
define('LAYOUT', TEMPLATE_DIR . "layout.php");
define('SHOW_LAYOUT', TEMPLATE_DIR . "showLayout.php");


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

define('POSTS', 'Posts');
define('POSTS_INDEX', TEMPLATE_DIR . "PostsIndex.php");
define('POSTS_INDEX_URL', "/posts");
define('POSTS_EDIT', TEMPLATE_DIR . "PostsEdit.php");
define('POSTS_EDIT_URL', "/posts/edit");
define('POSTS_EDIT_HEADER', "Edit Post: ");
define('POSTS_EDIT_LINK_TEXT', "edit");
define('POSTS_EDIT_FORM_ACTION', "/posts/update");

define('POSTS_SHOW', TEMPLATE_DIR . "PostsShow.php");
define('INSTAGRAM_SHOW', TEMPLATE_DIR . "InstagramShow.php");

define('YOUTUBE', 'YouTube');
define('YOUTUBE_INDEX', TEMPLATE_DIR . "youtubeIndex.php");
define('YOUTUBE_INDEX_URL', '/youtube');
define('YOUTUBE_EDIT', TEMPLATE_DIR . "youtubeEdit.php");
define('YOUTUBE_EDIT_URL', "/youtube/edit");
define('YOUTUBE_EDIT_HEADER', "Edit YouTube: ");
define('YOUTUBE_EDIT_LINK_TEXT', "edit");
define('YOUTUBE_EDIT_FORM_ACTION', "/youtube/update");
define('YOUTUBE_SHOW', TEMPLATE_DIR . 'youtubeShow.php');

define('INSTAGRAM', 'Instagram');
define('INSTAGRAM_INDEX', TEMPLATE_DIR . "InstagramIndex.php");
define('INSTAGRAM_INDEX_URL', "/instagram");
define('INSTAGRAM_EDIT', TEMPLATE_DIR . "InstagramEdit.php");
define('INSTAGRAM_EDIT_URL', "/instagram/edit");
define('INSTAGRAM_EDIT_HEADER', "Edit Instagram: ");
define('INSTAGRAM_EDIT_LINK_TEXT', "edit");
define('INSTAGRAM_EDIT_FORM_ACTION', "/instagram/update");

define('ADD', 'Add');
define('NAV', TEMPLATE_DIR . 'nav.php');
define('ID', "id");
define('NAME', "name");
define('EDIT', "edit");
define('VIEW', 'view');
define('SHOW', 'show');
define('SOURCES', 'Sources');

define('LANG', 'en');
define('CHARSET', 'utf-8');
define('YOUTUBE_SHOW_URL', 'https://www.youtube.com/embed/0Cxt8DvyG2Q?autoplay=1&mute=1&autohide=0&loop=1&fs=1&rel=0&hd=0&wmode=window&enablejsapi=1&playlist=');
?>
