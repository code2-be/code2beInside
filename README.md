# code2beInside

You need to use composer to install this application.

```
~$ composer install
```

You have to edit propel.yml and app/config/parameters.yml for database connection

```
~$ ./bin/propel sql:build
~$ ./bin/propel sql:insert

~$ ./app/console fixtures:load
```
