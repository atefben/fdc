#Informations

## Load old FDC datas

* You have to import in your database the old.sql file (it's all the tables with data that must be imported on the new site, I added a prefix old_ on all the old tables to identify them) This file is on the server Ohwee dev and located in /home/web/import.festival-cannes.com/_offline.

* You have to launch the command to add the site Corporate (site-institutionnel) in the database

    php app/console fdc:event:launch on
    
    
* You have to launch the command to add the site Corporate (site-institutionnel) in the database

*  You can update the script OldFdcDatabaseImportCommand if needed and delete the entities / tables once the import is successful.


####Start the festival event website

    php app/console fdc:event:launch on

####Stop the festival event website

    php app/console fdc:event:launch off

## Translations

We use http://jmsyst.com/bundles/JMSTranslationBundle to handle translations, a web interface is available on /admin/_trans, you need the ROLE_SONATA_ADMIN to access it.

To extract the translations from the templates we use the following commands :

php app/console translation:extract fr --config=fdc_event

php app/console translation:extract en --config=fdc_event

php app/console translation:extract es --config=fdc_event

php app/console translation:extract zh --config=fdc_event

Configuration is located in [jms_translation.yml][1]

[1]: https://github.com/Ohwee/festival-cannes-2016/blob/master/app/config/bundles/jms_translation.yml