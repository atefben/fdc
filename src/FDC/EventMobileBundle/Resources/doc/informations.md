## Translations

We use http://jmsyst.com/bundles/JMSTranslationBundle to handle translations, a web interface is available on /admin/_trans, you need the ROLE_SONATA_ADMIN to access it.

To extract the translations from the templates we use the following commands :

php app/console translation:extract fr --config=fdc_event_mobile

php app/console translation:extract en --config=fdc_event_mobile

php app/console translation:extract es --config=fdc_event_mobile

php app/console translation:extract zh --config=fdc_event_mobile

Configuration is located in [jms_translation.yml][1]

[1]: https://github.com/Ohwee/festival-cannes-2016/blob/master/app/config/bundles/jms_translation.yml
