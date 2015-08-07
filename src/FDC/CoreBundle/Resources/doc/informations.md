#Informations

## Environment - minimum configuration

Php version : 5.4 (to support Traits)

A mySQL Server

### Php Extensions 
- php-curl 
- php-soap
- php-intl

###php.ini
```
soap.wsdl_cache_enabled = 1 ; caching the soap methods
```


## Database

The database informations is available in [https://github.com/Ohwee/festival-cannes-2016/tree/master/src/FDC/CoreBundle/Resources/doc/sql][1].

We use [MySQL Workbench][3] to create / generate the diagram png, the source file is FDC diagram.mwb.

[1]: https://github.com/Ohwee/festival-cannes-2016/tree/master/src/FDC/CoreBundle/Resources/doc/sql
[2]: https://github.com/Ohwee/festival-cannes-2016/tree/master/src/FDC/CoreBundle/Resources/doc/sqlFDC%20diagram.mwb
[3]: https://www.mysql.fr/products/workbench/

##Entities

When using the following command or running it on entity

```
php app/console doctrine:generate:entities
```

You should run right after to check the schema validation

```
php app/console doctrine:schema:validate
```

And also you should check if the entity uses traits you have to remove manually the duplicate properties / setters / getters

This issue is opened on the doctrine bug tracker : http://www.doctrine-project.org/jira/browse/DDC-1825