<?php
    
namespace FDC\CoreBundle\Listener;

use Doctrine\ORM\Event\OnFlushEventArgs;

use FDC\CoreBundle\Entity\NewsArticleTranslation;
use FDC\CoreBundle\Entity\NewsAudioTranslation;
use FDC\CoreBundle\Entity\ThemeTranslation;

/**
 * DoctrineListener class.
 */
class DoctrineListener
{
    /**
     * localeDefaultTranslation
     * 
     * @var mixed
     * @access private
     */
    private $localeDefaultTranslation;

    /**
     * setLocaleDefaultTranslation function.
     * 
     * @access public
     * @param mixed $localeDefaultTranslation
     * @return void
     */
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
            if (($entity instanceof NewsAudioTranslation ||
                $entity instanceof NewsArticleTranslation) &&
                $entity->getLocale() == $this->localeDefaultTranslation) {
                $article = $entity->getTranslatable();
                $article->setTitle($entity->getTitle());
                $article->setTheme($entity->getTheme());
                $article->setCreatedAt($entity->getCreatedAt());
                $article->setUpdatedAt($entity->getUpdatedAt());
                $article->setStatus($entity->getStatus());
                $article->setPublishedAt($entity->getPublishedAt());
                $article->setPublishEndedAt($entity->getPublishEndedAt());
                
                $md = $em->getClassMetadata('FDC\CoreBundle\Entity\NewsArticle');
                $uow->recomputeSingleEntityChangeSet($md, $article);
            } else if ($entity instanceof ThemeTranslation && 
                $entity->getLocale() == $this->localeDefaultTranslation) {
                $theme = $entity->getTranslatable();
                $theme->setName($entity->getName());
                
                $md = $em->getClassMetadata('FDC\CoreBundle\Entity\Theme');
                $uow->recomputeSingleEntityChangeSet($md, $theme);
            }
        }
    }
}