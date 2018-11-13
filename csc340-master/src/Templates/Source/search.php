<!--
View for Source Controller search action.
@ 11/13/18
@author Jacob Oleson
-->
<label for="site-search">Search for specifc entries:</label>


<form action=<?php echo $this->baseUrl . SEARCH; ?> method="GET">
  <input type="text" name="query" placeholder="Search....">
  <input type="submit" value="Search">


</form>
