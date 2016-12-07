<?php

namespace Base\SoifBundle\Listener;

use Base\CoreBundle\Entity\FilmFilm;
use Doctrine\ORM\Event\LifecycleEventArgs;

class DoctrineListener
{
    public function preRemove(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof FilmFilm) {
            if ($object->getNews()->count()) {
                foreach ($object->getNews() as $news) {
                    $object->removeNews($news);
                }
            }
            $object
                ->setNews(null)
            ;

            foreach ($object->getAssociatedNews() as $associatedNews) {
                $args->getEntityManager()->remove($associatedNews);
            }
        }
    }
}