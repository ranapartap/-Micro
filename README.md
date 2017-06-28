
# Micro

Micro - a quickstart Core PHP skeleton application with:

Micro is an simple, robust, easy to understand skeleton PHP application to quickstart a new project for developers. It is not a framework and has not all the features which exists in any framework, but it is designed to provide the max of a framework without any unnecessary overloads. I have tried to pick the best and compact available libraries which can help reducing the code and provide a nice structure to the application

Micro is easy and micro.

## Features
- Frontend Pages
- User login authentication
- User CRUD
- Admin Panel

## Structure
- Bootstrap 3
- MVC Structure
- Klein Router Library
- NotORM Database Library
- PSR-4 autoloader
- Creative Tim bootstrap lightweight admin panel

 ## The Best
- Simple and clean structure
- Easy to understand
- Klein makes beautiful and clean URLs
- Demo CRUD user management: Create, Read, Delete, Update, Block Actions
- User Profile Editor
- AJAX calls
- Tried to follow PSR guidelines
- NotORM database library to pass a clean and structural database actions.
- Tried to comment the code whereever necessary
- Used PSR-4 autoloader to use the OOP interface with namespaces
- Database requests are made with PDO, so SQL injection is prohibited.

## Requirements

- PHP 5.6 or PHP 7.0
- MySQL
- mod_rewrite activated (see below for tutorials)

## Installation

1. Install via composer:
`composer create-project ranapartap/micro`
2. Edit the database credentials in `application/config/config.php`
3. Create the required SQL database/tables with .sql statements in the `_install/`-folder
4. Make sure you have mod_rewrite activated on your server/in your server environment.
5. Install composer and run `composer install` in the project's folder to create the PSR-4 autoloading stuff from Composer automatically.
	- Basically composer install the required support libraries like Klien Router/NoORM and othrs etc.
	- Also autolad the application PSR-4  system which works just like "include filename.php" all over our projects to include and use anything. PSR is the modern, clean and automatic version of old school "include" command.
6. Open `micro\public` folder and run `serve.bat` batch file. It will start the server at `http://localhost:8081`. You can type this address in browser and application will starts. (Make sure you have set path `php` path in you local environment correctly to run php, You can check the same by typing "php" on command prompt. If it does not give any error like (Windows 10) `php is not recognized as an internal or external command, operable program or batch file.)`. Then everything is fine and server will be started.

Micro runs without any complex configuration.

## Server configuration for

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

## How to include stuff / use PSR-4

As this project uses proper PSR-4 namespaces, make sure you load/use your stuff correctly:
Instead of including classes with old-school code like `include xxx.php`, simply do something like `use Micro\Model\Song;` on top of your file (modern IDEs even do that automatically).
This would automatically include the file *Song.php* from the folder *Micro/Model* (it's case-sensitive!).

But wait, there's no `Micro/Model/Song.php` in the project, but a `application/Model/Song.php`, right ?
To keep things cleaner, the composer.json sets a *namespace* (see code below), which is basically a name or an alias, for a certain folder / area of your application,
in this case the folder `application` is now reachable via `Micro` when including stuff.

```
{
    "psr-4":
    {
        "Micro\\" : "application/"
    }
}
```

This might look stupid at first, but comes in handy later. To sum it up:

To load the file `application/Model/Song.php`, write a `use Micro\Model\Song;` on top of your controller file.
Have a look into the SongController to get an idea how everything works!

FYI: As decribed in the install tutorial, you'll need do perform a "composer install" when setting up your application for the first time, which will
create a set of files (= the autoloader) inside /vendor folder. This is the normal way Composer handle this stuff. If you delete your vendor folder
the autoloading will not work anymore. If you change something in the composer.json, always make sure to run composer install/update again!

## License

This project is licensed under the MIT License.
This means you can use and modify it for free in private or commercial projects.

## Support the project

We are on the way. If you like the project and wish we will keep on going the good work. Please donate some bitcoins at our following address Bitcoin Address: `1ALrZnQ3R8Y5LrvqtkHme4goQBfPtPNdUB`
