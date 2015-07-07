# code2beInside

You need to use composer to install this application.

```
~$ composer install
```

You have to edit app/config/runtime-conf.xml, app/config/build.properties and app/config/parameters.yml for database connection / mailing

```
~$ ./bin/propel app/config/ om
~$ ./bin/propel app/config/ sql 
~$ ./bin/propel app/config/ insert-sql 
~$ ./bin/propel app/config/ convert-conf 

~$ ./app/console fixtures:load
```
