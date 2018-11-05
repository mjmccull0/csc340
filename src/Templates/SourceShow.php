<!--
View for Source Controller show action.
@11/04/2018
@author Michael McCulloch
-->
<?php 
switch ($this->source->getType()) {
  case 'Youtube':
    include 'youtubeShow.php';
    break;
  case 'Posts':
    include 'PostsShow.php';
    break;
  case 'Instagram':
    include 'InstagramShow.php';
    break;
}
?>
