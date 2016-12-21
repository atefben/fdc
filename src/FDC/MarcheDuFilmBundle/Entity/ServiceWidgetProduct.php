<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\MediaImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ServiceWidgetProduct
 *
 * @ORM\Table(name="service_widget_product")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\ServiceWidgetProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceWidgetProduct extends ServiceWidget
{
    use Translatable;

    /**
     * @var Gallery
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\Gallery", cascade={"all"})
     */
    private $gallery;

    /**
     * @var ArrayCollection
     *
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return array
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }

    /**
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\Gallery $gallery
     * @return ServiceWidgetProduct
     */
    public function setGallery(\Base\CoreBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Base\CoreBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
