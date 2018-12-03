<!DOCTYPE html>
<!-- 
View for Source Controller index action.
@update 12/13/18
@author Michael McCulloch
-->
<html lang="<?php echo LANG; ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/main.css">
  <?php echo $this->headStyles ?>
  <?php echo $this->headScripts ?>
</head>
<body>
  <div class="content">
    <div class="sidebar">
      <?php include($this->getTemplatePath(NAV)); ?>
    </div>
    <div class="content-wrapper">
      <?php echo $this->content ?>
    </div>
  </div>
</body>
</html>
