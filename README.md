
# Micro

Micro - a quickstart Core PHP skeleton application.

Micro is an simple, robust, easy to understand skeleton PHP application to quickstart a new project for developers. It is not a framework and has not all the features which exists in any framework, but it is designed to provide the max of a framework without any unnecessary overloads. I have tried to pick the best and compact available libraries which can help reducing the code and provide a nice structure to the application

Micro is easy and micro.

## Features
- Frontend Pages
- User login authentication
- User CRUD
- Admin Panel

## Structure
- Bootstrap 3
- Bootstrap SweetAlert
- DataTables
- MVC Structure
- Klein Router Library
- NotORM Database Library
- Valitron PHP Validation Library
- PSR-4 autoloader
- Creative Tim bootstrap lightweight admin panel

 ## The Best
- Simple and clean structure
- Easy to understand
- Klein makes beautiful and clean URLs
- User Management demo CRUD : Create, Read, Update, Delete, Block user actions
- User Profile edit page
- AJAX calls
- Tried to follow PSR guidelines
- NotORM database library to pass a clean and structural database actions.
- Tried to comment the code whereever necessary
- Used PSR-4 autoloader to use the OOP interface with namespaces
- Database requests are made with PDO, so SQL injection is prohibited.

## Requirements

- PHP 5.6 or PHP 7.0
- MySQL
- mod_rewrite activated

## Demo
[php-micro.tk](http://php-micro.tk)
Admin un/pw : (admin/admin)

## Installation

 - Install via composer:
`composer create-project ranapartap/micro`
 - Edit the database credentials in `application/config/config.php`
 - Create the required SQL database/tables with .sql statements in the `_install/`-folder
 - Make sure you have mod_rewrite activated on your server/in your server environment.
 - Install composer and run `composer install` in the project's folder to create the PSR-4 autoloading stuff from Composer automatically.
	- Basically composer install the required support libraries like Klien Router/NoORM and othrs etc.
	- Also autolad the application PSR-4  system which works just like "include filename.php" all over our projects to include and use anything. PSR is the modern, clean and automatic version of old school "include" command.
 - Open `micro\public` folder and run `serve.bat` batch file. It will start the server at `http://localhost:8081`. You can type this address in browser and application will starts. (Make sure you have set path `php` path in you local environment correctly to run php, You can check the same by typing "php" on command prompt. If it does not give any error like (Windows 10) `php is not recognized as an internal or external command, operable program or batch file.)`. Then everything is fine and server will be started.

    **OR create an virtual host on your machine and use it. It is easy to create virtual host on Windows 10**

 - Browse your windows folder (eg: `C:\Windows\System32\drivers\etc`)
 - Open "hosts" file in notepad.
 - At the end of file just add your local server address and hostname you wish (eg: `127.0.0.1 local-micro.com`)

**NOW apache configuration (on XAMPP)**

 - Browse your apache folder (eg: `Z:\xampp\apache\conf\extra`) Open `httpd-vhosts.conf` file in notepad.
 - At the end of the file add the following code (obviously update your relative paths)

```
    <VirtualHost *:80>
      ServerName local-micro.com
      ServerAlias www.local-micro.com
      DocumentRoot "Z:\xampp\htdocs\others\micro\public"
      <Directory "Z:\xampp\htdocs\others\micro\public">
          Options Indexes FollowSymLinks
          AllowOverride all
          Order Allow,Deny
          Allow from all
      </Directory>
    </VirtualHost>
```
## Login credential
`Username:admin, Password:admin`

**Micro runs without any complex configuration.**

## Server configuration for
### Apache
Apache configuration file `.htaccess` is already there in public as well as on app root folder.

### nginx

```nginx
server {
    server_name default_server _;   # Listen to any servername
    listen      [::]:80;
    listen      80;

    root /var/www/html/you-project-name/public;

    location / {
        index index.php;
        try_files /$uri /$uri/ /index.php?url=$uri;
    }

    location ~ \.(php)$ {
        fastcgi_pass   unix:/var/run/php5-fpm.sock;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## Security

The script makes use of mod_rewrite and blocks all access to everything outside the /public folder.
SQL injection is prohibited, database requests are made with PDO. No worries.
Just keep in mind do not use any obsolete versions of PHP/MySql etc.

## License

This project is licensed under the MIT License.
This means you can use and modify it for free in private or commercial projects.

## Support the project

We are on the way. If you like the project and wish we will keep on going the good work. Please donate some bitcoins at our following address Bitcoin Address: `1ALrZnQ3R8Y5LrvqtkHme4goQBfPtPNdUB`
