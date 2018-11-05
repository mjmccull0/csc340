<!--
View for Source Controller edit action.
@11/04/2018
@author Michael McCulloch
-->
<?php 
if ($this->isSource) {
    include 'sourceEdit.php';
} else {
  switch ($this->data->getType()) {
    case 'Youtube':
      include 'youtubeEdit.php';
      break;
    case 'Posts':
      include 'PostsEdit.php';
      break;
    case 'Instagram':
      include 'InstagramEdit.php';
      break;
  }
}
?>
