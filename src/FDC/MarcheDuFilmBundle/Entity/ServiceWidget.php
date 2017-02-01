<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ServiceWidget
 * @ORM\Table(name="mdf_service_widget")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceWidget
{
    use Time;
    use Translatable;
    use SeoMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="ServiceWidgetCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="widget")
     */
    protected $widgetsCollection;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProductCollection", mappedBy="serviceWidget", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $productCollections;
    

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->productCollections = new ArrayCollection();
        $this->widgetsCollection = new ArrayCollection();
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

    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }


    public function getWidgetType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return ServiceWidget
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add products
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProductCollection $products
     * @return ServiceWidget
     */
    public function addProductCollection(\FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProductCollection $product)
    {
        $product->setServiceWidget($this);
        $this->productCollections[] = $product;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProductCollection $products
     */
    public function removeProductCollection(\FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProductCollection $products)
    {
        $this->productCollections->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductCollections()
    {
        return $this->productCollections;
    }

    /**
     * @param ServiceWidgetCollection $widgetCollection
     * @return $this
     */
    public function addWidgetsCollection(\FDC\MarcheDuFilmBundle\Entity\ServiceWidgetCollection $widgetCollection)
    {
        $widgetCollection->setWidget($this);
        $this->widgetsCollection[] = $widgetCollection;

        return $this;
    }

    /**
     * @param ServiceWidgetCollection $widgetCollection
     */
    public function removeWidgetsCollection(\FDC\MarcheDuFilmBundle\Entity\ServiceWidgetCollection $widgetCollection)
    {
        $this->widgetsCollection->removeElement($widgetCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getWidgetsCollection()
    {
        return $this->widgetsCollection;
    }
}
