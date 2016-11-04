# LAMP analysis

Performance analysis for web application using LTTng

## Installation

### Prerequisite
You need to have PHP7 on your machine,

`$ sudo apt-get install php`

### Composer
You need to install Composer for dependency management. Open a Linux terminal and execute :

`$ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer`

### Clone 
Clone the project:

`$ git clone https://github.com/cheninator/lttng-web-view.git`

### Install librairies

`$ cd lttng-web-view`

`$ composer install`

### Environment file
`$ cp .env.example .env`

`$ php artisan key:generate`

### Launch

`$ php artisan serve`
