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

The database informations is available in [https://github.com/Ohwee/festival-cannes-2016/tree/master/src/Base/CoreBundle/Resources/doc/sql][1].

We use [MySQL Workbench][3] to create / generate the diagram png, the source file is FDC diagram.mwb.

## Initialization

You have to configure the parameters.yml

Have the mandatory php extensions and php.ini

Launch the command : php app/console d:d:c && php app/console d:s:u --force && php app/console d:f:l

You have to validate to load the fixtures in your database

## Bundles

- BaseCoreBundle : The core of the project Entities, Repository
- BaseAdminBundle : The admin of the project
- BaseSoifBundle : The Soif mapper
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

#Multisites
This project hosts multiple sites, the following parameters are used to defined the host for each site and redirect on the related bundle:

app/config/parameters.yml

    website_fdc_event_host: ~
    website_fdc_corporate_host: ~

#Sessions
Sessions are stored in database, you must import the [sessions.sql][4] file.

## Glossary
- Statement = Communiqué
- Info = Infos
- News = Articles

[1]: https://github.com/Ohwee/festival-cannes-2016/tree/master/src/Base/CoreBundle/Resources/doc/sql
[2]: https://github.com/Ohwee/festival-cannes-2016/tree/master/src/Base/CoreBundle/Resources/doc/sqlBase%20diagram.mwb
[3]: https://www.mysql.fr/products/workbench/
[4]: https://github.com/Ohwee/festival-cannes-2016/tree/master/src/Base/CoreBundle/Resources/doc/sessions.sql