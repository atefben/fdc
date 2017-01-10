<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use FDC\MarcheDuFilmBundle\Entity\GalleryMdf;
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
     * @var GalleryMdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\GalleryMdf", cascade={"all"})
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
     * @param \FDC\MarcheDuFilmBundle\Entity\GalleryMdf $gallery
     * @return ServiceWidgetProduct
     */
    public function setGallery(\FDC\MarcheDuFilmBundle\Entity\GalleryMdf $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\GalleryMdf 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
