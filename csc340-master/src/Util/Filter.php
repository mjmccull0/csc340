<?php
namespace Util;
use Models\SourceModel as SourceModel;

  /**
  * @update 11/13/18
  * @author Jacob Oleson
  */

  class Filter {

    public static function filter() {
      //Here I would load the titles by type (Still unsure on if need by type)
      $line = self::loadTitles();

      /** Case-Insensitive search. Would need to loop through all titles
      *   and then send results back to controller to load in the view.
      *
      */
      $var = $_POST['searchterm'];

      if (preg_match("/\b$var\b/i", $line, $match)) {
        return "Match found for \"$var\". The results are: " . $line;
      } else {

        return "No match found.";
      }
    }

    private static function loadTitles() {

      $foo = "The quick brown fox jumps over the lazy dog.";

      return $foo;
    }
  }

?>
