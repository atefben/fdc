#Admin

We use [Sonata Bundles](https://sonata-project.org) to  generate the admin.

The media are handled by [Sonata Media Bundle](https://sonata-project.org/bundles/media/2-2/doc/index.html).

## Translations

We use http://jmsyst.com/bundles/JMSTranslationBundle to handle translations, a web interface is available on /admin/_trans, you need the ROLE_SONATA_ADMIN to access it.

To extract the translations from the templates we use the following commands :

php app/console translation:extract fr --config=admin

php app/console translation:extract en --config=admin