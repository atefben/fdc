#INFORMATIONS

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
