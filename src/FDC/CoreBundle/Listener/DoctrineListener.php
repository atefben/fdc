<?php
    
namespace FDC\CoreBundle\Listener;

use Doctrine\ORM\Event\OnFlushEventArgs;

use FDC\CoreBundle\Entity\NewsArticleTranslation;

class DoctrineListener
{
    private $localeDefaultTranslation;

    public function setLocaleDefaultTranslation($localeDefaultTranslation)
    {
        $this->localeDefaultTranslation = $localeDefaultTranslation;
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();
        $entities = array_merge(
            $uow->getScheduledEntityInsertions(),
            $uow->getScheduledEntityUpdates()
        );

        foreach ($entities as $entity) {
          //  var_dump($entity instanceof NewsArticleTranslation);
            if (!($entity instanceof NewsArticleTranslation)) {
                continue;
            }
            
            if ($entity->getLocale() != $this->localeDefaultTranslation) {
                continue;
            }

            var_dump(get_class($entity));
            $article = $entity->getTranslatable();
            $article->setTitle($entity->getTitle());
            $md = $em->getClassMetadata('FDC\CoreBundle\Entity\NewsArticle');
            $uow->recomputeSingleEntityChangeSet($md, $article);
        }
    }
}