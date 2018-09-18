# CSC340 Group Project

This project is a website using PHP, object-oriented programming, and MVC architecture.  The intended use case for the project is to gather and display online sources of information, and is an example use case of [Digital signage](https://en.wikipedia.org/wiki/Digital_signage).  The current online sources of information for this project are UNCG's news posts, Instagram, and one of there YouTube channels.  UNCG's news posts and Instagram profile both provide an image and a title or caption.  The information collected from UNCG's YouTube channel consists of video-id and title.  Information from UNCG news and Instagram data sources will be presented in a slideshow format; where as the YouTube data will be used to create a video playlist displayed in a fullscreen embeded player.

## Getting Started

This is where instructions for setting up a copy of the project for development and testing purposes will go.

### Prerequisites

At a minimum PHP 7.  PHP has a built-in web-server which can be used for the development purposes of this class project.  It is possible to use a development environment such as a LAMP stack for development; but instructions for configuring and administrating a LAMP environment cannot be given here.

### Development with PHP built-in Web-server

Clone a copy of the repository.  On windows, open a command prompt and navigate to the cloned copy of the repository.  Then enter the following

```
php -S localhost:8000
```

The built-in PHP web-server should now be serving the project at http://localhost:8000.

