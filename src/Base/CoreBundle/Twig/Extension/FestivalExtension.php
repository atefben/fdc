<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\FilmFestivalMediaImageAssociated;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Doctrine\ORM\EntityManager;
use Twig_Extension;

/**
 * Class FestivalExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class FestivalExtension extends Twig_Extension
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * FestivalExtension constructor.
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('festival_date', [$this, 'getFestivalDate']),
            new \Twig_SimpleFunction('get_all_festivals', [$this, 'getAllFestivals']),
            new \Twig_SimpleFunction('get_festival_images', [$this, 'getFestivalImages']),
        ];
    }

    public function getFestivalDate()
    {
        $settings = $this
            ->manager
            ->getRepository('BaseCoreBundle:Settings')
            ->getFestivalDate()
        ;

        if (count($settings) == 1) {
            $settings = $settings[0];
        }

        return $settings;
    }

    /**
     * @return array|\Base\CoreBundle\Entity\FilmFestival[]
     */
    public function getAllFestivals()
    {
        return $this
            ->manager
            ->getRepository('BaseCoreBundle:FilmFestival')
            ->findAll()
            ;
    }

    public function getFestivalImages(FilmFestival $festival, $site)
    {
        $now = time();
        $images = [];

        $site = $this->manager->getRepository('BaseCoreBundle:Site')->findOneBy(['slug' => $site]);

        foreach ($festival->getAssociatedMediaImages() as $associatedMediaImage) {
            if ($associatedMediaImage instanceof FilmFestivalMediaImageAssociated) {
                if ($associatedMediaImage->getAssociation() instanceof MediaImage) {
                    $image = $associatedMediaImage->getAssociation();
                    $fr = $image->findTranslationByLocale('fr');
                    $isPublished = $image->getSites()->contains($site);
                    $isPublished = $isPublished && ($image->getPublishedAt()->getTimestamp() <= $now);
                    $isPublished = $isPublished && (!$image->getPublishEndedAt() || $image->getPublishEndedAt()->getTimestamp() >= $now);
                    $isPublished = $isPublished && $fr && $fr->getStatus() == TranslateChildInterface::STATUS_PUBLISHED;
                    if ($isPublished) {
                        $images[] = $image;
                    }
                }
            }
        }
        return $images;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'festival_extension';
    }
}