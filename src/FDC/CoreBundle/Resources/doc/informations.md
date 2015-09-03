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
soap.wsdl_cache_enabled = 1; caching the soap methods
memory_limit = 512M; at least 512mb for the thubmnail generations
```

## Database

The database informations is available in [https://github.com/Ohwee/festival-cannes-2016/tree/master/src/FDC/CoreBundle/Resources/doc/sql][1].

We use [MySQL Workbench][3] to create / generate the diagram png, the source file is FDC diagram.mwb.

[1]: https://github.com/Ohwee/festival-cannes-2016/tree/master/src/FDC/CoreBundle/Resources/doc/sql
[2]: https://github.com/Ohwee/festival-cannes-2016/tree/master/src/FDC/CoreBundle/Resources/doc/sqlFDC%20diagram.mwb
[3]: https://www.mysql.fr/products/workbench/

## Initialization

You have to configure the parameters.yml
Have the mandatory php extensions and php.ini
- Command : php app/console d:d:c && php app/console

## Bundles

- FDCCoreBundle : The core of the project Entities, Repository
- FDCAdminBundle : The admin of the project
- FDCSoifBundle : The Soif mapper
- Application Bundles : The bundles extension used in the project (mostly Sonata)

#Development

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
