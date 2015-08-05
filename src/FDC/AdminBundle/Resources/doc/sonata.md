#ADMIN


We use [Sonata Bundles](https://sonata-project.org) to  generate the admin.

The media are handled by [Sonata Media Bundle](https://sonata-project.org/bundles/media/2-2/doc/index.html).


##Bundle modifications

FDC medias has translation on copyrights. We had to change the Sonata Media to handle this :

- I tried to change the BaseMedia.orm.xml mapper by removing the copyright field but after no properties were saved in database.
- I tried to add a FileProvider in the extension Bundle but there is an issue with BaseProvider:transform when activating it in the sonata_media.yml.

So I had to modify the following files in SonataMediaBundle to have this custom behaviour :

**Sonata\MediaBundle\Provider\FileProvider**

method buildEditForm  - added translations / removed copyright field

**Sonata\MediaBundle\Model\ModelInterface**

setCopyright / getCopyright removed

Those fields are handled in the MediaTranslation Entity instead of Media.