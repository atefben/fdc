#Informations

## Translations

We use http://jmsyst.com/bundles/JMSTranslationBundle to handle translations, a web interface is available on /admin/_trans, you need the ROLE_SONATA_ADMIN to access it.

To extract the translations from the templates we use the following commands :

php app/console translation:extract fr --config=fdc_press

php app/console translation:extract en --config=fdc_press

php app/console translation:extract es --config=fdc_press

php app/console translation:extract zh --config=fdc_press

## Sessions

Sessions are saved in database, you must insert the following sql script

CREATE TABLE `sessions` (
    `sess_id` VARBINARY(128) NOT NULL PRIMARY KEY,
    `sess_data` BLOB NOT NULL,
    `sess_time` INTEGER UNSIGNED NOT NULL,
    `sess_lifetime` MEDIUMINT NOT NULL
) COLLATE utf8_bin, ENGINE = InnoDB;