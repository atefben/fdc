<?php

namespace Base\CoreBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use \Twig_Extension;

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
        return array(
            new \Twig_SimpleFunction('festival_date', array($this, 'getFestivalDate')),
            new \Twig_SimpleFunction('get_all_festivals', array($this, 'getAllFestivals')),
        );
    }

    public function getFestivalDate()
    {
        $settings = $this
            ->manager
            ->getRepository('BaseCoreBundle:Settings')
            ->getFestivalDate();

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


    /**
     * @return string
     */
    public function getName()
    {
        return 'festival_extension';
    }
}