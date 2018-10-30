<?php
namespace Controllers;
use DB\TextDB as TextDB;
use Models\SourceModel as SourceModel;

class TestController {
  public function indexAction() {
    //TextDB::import();
    var_dump('<pre>');
    $db = unserialize(file_get_contents(DB_FILE));
    //$posts = unserialize(file_get_contents('/home/gnuisance/Public/mjmccull-csc340-repo/csc340/resources/posts'));
    //$instagram = unserialize(file_get_contents('/home/gnuisance/Public/mjmccull-csc340-repo/csc340/resources/instagram'));
    //var_dump($db);
    //echo "Posts\n";
    //var_dump($posts);
    //echo "Instagram\n";
    //var_dump($instagram);
    echo "DB\n";
    var_dump($db);
//    var_dump(SourceModel::getRecords());
    die('in test');
  }
}
?>
