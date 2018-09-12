<?php
/**
 * @date 9/12/18
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
    'model' => 'WpModel',
    'url' => 'https://newsandfeatures.uncg.edu/wp-json/wp/v2/posts?_embed'
  )
);
$dataSource->import();
// Creates a queriable data object.
$wpData = TextDB::create($dataSource);

var_dump($wpData);

// The following will soon be removed.
// Note: var_dump($blah) will dump the value of $blah.

// This is an example of how to get a record with a given id.
// var_dump($wpData->fetchById(36329));
// var_dump($wpData->fetchById(36329)->getTitle());

// This is an example of how to get all the records.
var_dump($wpData->fetchAll());

$instagramDataSource = InstagramDataSource::create(
  array(
    'path' => 'instagram.txt',
    'model' => 'InstagramModel',
    'url' => 'https://www.instagram.com/uncg/'
  )
);


$instagramData = TextDB::create($instagramDataSource);
var_dump($instagramData->fetchAll());

?>
