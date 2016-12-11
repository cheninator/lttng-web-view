# LAMP analysis

Performance analysis for web application using LTTng

## Installation

### Prerequisite
You need to have PHP7 on your machine,

`$ sudo apt-get install php`

### Composer
You need to install Composer for dependency management. Open a Linux terminal and execute :

`$ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer`

### NPM
You need also to install npm for angular2 packages

`$ sudo apt-get install nodejs npm`
  
### Clone 
Clone the project:

`$ git clone https://github.com/cheninator/lttng-web-view.git`

### Install librairies

`$ cd lttng-web-view`

`$ composer install`

`$ npm install`

### Environment file
`$ cp .env.example .env`

`$ php artisan key:generate`

### Gulp
Launch gulp program with command:

`$ gulp`

In root project

### Launch
Before launche the web server, you have to make sure that the data folder in resources/lttng-parser exists. If not, extract the .tar.gz and run

`$ php ChartJSGenerator.php && php Flamegraph.php`

And then, you can launch the web server by executing:

`$ php artisan serve`

from the root folder of the project
