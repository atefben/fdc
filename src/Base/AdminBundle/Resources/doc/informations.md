#Informations

## Lock mechanism

A lock is applied every time a user access a translation.
When a user tries to access an article, we check if a lock is active.
We check the role of each user and if a role matches the translation our user tries to access, we prevent the access.

## Homepage

The homepage must be created manually in the database each year.
Just insert a new element with valid created_at / updated_at.
You must set in parameters.yml admin_homepage_id the identifier created.

## Roles

When you create new entities, roles you must do the following commands to refresh ACL :
* php app/console sonata:admin:setup-acl
* php app/console sonata:admin:generate-object-acl

## Translations

We use the bundle A2lix Translations.
There is an issue with the constraints, they are applied on ALL locales instead of only the required ones. (https://github.com/a2lix/TranslationFormBundle/pull/173)
The patch can be find in src/Base/CoreBundle/Resources/patches/a2lix-constraints-only-required-locales.patch.
It is applied automatically when you do composer install.

## Patches

SonataMediaBundle - Provider/FileProvider.php

Here is a patch to use the default action of Sonata when importing data from soif :
- cli tasks
- soif-refresh in admin on Film

We use getClientOriginalName when uploading in admin to use the extension provided.

protected function generateReferenceName(MediaInterface $media)
{
    // use default sonata method when using cli (soif commands) or soif-refresh in admin
    if (php_sapi_name() == "cli" ||
        (isset($_SERVER) && isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'soif-refresh') !== false)) {
        return sha1($media->getName().rand(11111, 99999)).'.'.$media->getBinaryContent()->guessExtension();
    } else {
        return sha1($media->getName().rand(11111, 99999)). '.'. substr(strrchr($media->getBinaryContent()->getClientOriginalName(), '.'), 1);
    }
}