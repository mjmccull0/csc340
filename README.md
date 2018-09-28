# CSC340 Group Project

This project is a website using PHP, object-oriented programming, and MVC architecture.  The intended use case for the project is to gather and display online sources of information, and is an example use case of [Digital signage](https://en.wikipedia.org/wiki/Digital_signage).  The current online sources of information for this project are UNCG's news posts, Instagram, and one of their YouTube channels.  UNCG's news posts and Instagram profile both provide an image and a title or caption.  The information collected from UNCG's YouTube channel consists of video-id and title.  Information from UNCG news and Instagram data sources will be presented in a slideshow format; where as the YouTube data will be used to create a video playlist displayed in a fullscreen embeded player.

## Getting Started

To access data that has been collected from DataSources use TextDB.  To use TextDB, add this to the top of a php file just under the namespace declaration, if there is one.

```
use DB\TextDB as TextDB;
```

To initialize TextDB, do something like:

```
$db = TextDB::connect();
```

There are three DataSources setup in bootstrap.php.  There names are posts, instagram, and youtube.  To access active records for the DataSource with the name posts, for example,

```
$db->get('posts');
```

To access all posts, both active and inactive posts:

```
$db->fetchActive('posts');
```

Both $db->get(name) and $db->fetchActive(name) return an array of models whose properties can be accessed with getters and modified with setters.


### Prerequisites

At a minimum PHP 7.1.0, if your version of PHP is less than 7.1.0 then the code as written now will not work.  PHP has a built-in web-server which can be used for the development purposes of this class project.  It is possible to use a development environment such as a LAMP stack for development; but instructions for configuring and administrating a LAMP environment cannot be given here.

### Development with PHP built-in Web-server

Clone a copy of the repository.  On windows, open a command prompt and navigate to the cloned copy of the repository.  Then enter the following

```
php -S localhost:8000 -t public/
```

The built-in PHP web-server should now be serving the project at http://localhost:8000.

### IMPORTANT NOTES

Until there is a way to use controllers from the web-browser using the PHP built-in web-server will be of little help.  Instead to test controllers or views execute your controllers or views from the command-line:

```
php path_to_your_code.php
```

or write something to allow accessing controllers from a web-browser.
