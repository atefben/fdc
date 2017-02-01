<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use FDC\MarcheDuFilmBundle\Entity\GalleryMdf;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ServiceWidgetProduct
 *
 * @ORM\Table(name="mdf_service_widget_product")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceWidgetProduct
{
    use Translatable;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var MdfServiceGallery
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfServiceGallery", inversedBy="product")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $gallery;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="ServiceWidgetProductCollection", mappedBy="product")
     */
    protected $productsCollection;

    /**
     * @var ArrayCollection
     *
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->productsCollection = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getTitle();
        }

        return $string;
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param MdfServiceGallery|null $gallery
     * @return $this
     */
    public function setGallery(\FDC\MarcheDuFilmBundle\Entity\MdfServiceGallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * @return MdfServiceGallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @param ServiceWidgetProductCollection $productCollection
     * @return $this
     */
    public function addProductsCollection(\FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProductCollection $productCollection)
    {
        $productCollection->setProduct($this);
        $this->productsCollection[] = $productCollection;

        return $this;
    }

    /**
     * @param ServiceWidgetProductCollection $productCollection
     */
    public function removeProductsCollection(\FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProductCollection $productCollection)
    {
        $this->productsCollection->removeElement($productCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getProductsCollections()
    {
        return $this->productsCollection;
    }
}

