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

When using the global command or running it on translated entities (such as Article or Theme...)

```
php app/console doctrine:generate:entities
```

You should run right after to check the schema validation

```
php app/console doctrine:schema:validate
```

The translated entities might have duplicate properties (id, local, getter and setters) because we are using traits.
In this case you have to remove manually each duplication.