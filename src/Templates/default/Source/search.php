<!--
View for Source Controller search action.
@ 12/04/18
@author Jacob Oleson
@author Michael McCulloch
-->
<label for="site-search">Search for specifc entries:</label>

<?php $query = '' ?>
<?php if (isset($_GET['query'])) { ?>
    <?php $query = $_GET['query']; ?>
<?php } ?>

<form class="flex" action=<?php echo $this->baseUrl . SEARCH; ?> method="GET">
<input type="text" name="query" value="<?php echo $query; ?>" placeholder="Search....">
  <input type="submit" value="Search">
</form>
