# CSC340 Group Project

This project is a website using PHP, object-oriented programming, and MVC architecture.  The intended use case for the project is to gather and display online sources of information, and is an example use case of [Digital signage](https://en.wikipedia.org/wiki/Digital_signage).  The current online sources of information for this project are UNCG's news posts, Instagram, and one of their YouTube channels.  UNCG's news posts and Instagram profile both provide an image and a title or caption.  The information collected from UNCG's YouTube channel consists of video-id and title.  Information from UNCG news and Instagram data sources will be presented in a slideshow format; where as the YouTube data will be used to create a video playlist displayed in a fullscreen embeded player.

## Getting Started



### Prerequisites

At a minimum PHP 7.1.0, if your version of PHP is less than 7.1.0 then the code as written now will not work.  PHP has a built-in web-server which can be used for the development purposes of this class project.  It is possible to use a development environment such as a LAMP stack for development; but instructions for configuring and administrating a LAMP environment cannot be given here.

### Development with PHP built-in Web-server

Clone a copy of the repository.  On windows, open a command prompt and navigate to the cloned copy of the repository.  Then enter the following

```
php -S localhost:8000 -t public/
```

The built-in PHP web-server should now be serving the project at http://localhost:8000.

### IMPORTANT NOTES

### Override View Templates

To override a default template replicate the path of the template in the Templates directory.  For example, to override the template with the path 

```
src/Templates/default/Source/index.php
```

create a file with the path

```
src/Templates/Source/index.php
```


### Updating Your Branch With Updated Master Code

In your local copy of your branch you can run these commands, where local_branch_name is your local branch name, to get any changes which have made it into the master repo and push them to your branch.  This means you will be developing with a copy of the code which is update-to-date.

```
git checkout master
git pull
git checkout local_branch_name
git rebase master
git push
```
