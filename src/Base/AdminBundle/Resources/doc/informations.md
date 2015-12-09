#Informations

## Lock mechanism

A lock is applied every time a user access a translation.
When a user tries to access an article, we check if a lock is active.
We check the role of each user and if a role matches the translation our user tries to access, we prevent the access.

## Translations

We use the bundle A2lix Translations.
There is an issue with the constraints, they are applied on ALL locales instead of only the required ones. (https://github.com/a2lix/TranslationFormBundle/pull/173)
The patch can be find in src/Base/CoreBundle/Resources/patches/a2lix-constraints-only-required-locales.patch.
It is applied automatically when you do composer install.