<?php
/**
 * @date 9/9/18
 * @author Michael McCulloch
 */

// Tells php to look in the the same directory this file is in
// for invoked classes.
spl_autoload_register(
  function ($className) {
    include $className . '.php';
  }
);

// Creates a data source by providing a url to get data from
// and providing a location to store the relevant information.
$dataSource = WpDataSource::create(
  array(
    'path' => 'posts.txt',
    'url' => 'https://newsandfeatures.uncg.edu/wp-json/wp/v2/posts?_embed'
  )
);

// Creates a queriable data object.
$data = TextDB::create(
  array(
    'path' => $dataSource->getPath(),
    'keys' =>   array( 'id', 'title', 'imgUrl', 'dateTime', 'active'),
    'model' => 'WpModel' 
  )
);

// The following will soon be removed.
// Note: var_dump($blah) will dump the value of $blah.

// This is an example of how to get a record with a given id.
var_dump($data->fetchById(36329));
var_dump($data->fetchById(36329)->getTitle());

// This is an example of how to get all the records.
var_dump($data->fetchAll());

?>
