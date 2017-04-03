<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmParticiperPage
 * @ORM\Table(name="ccm_participer_page")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks() 
 */
class CcmParticiperPage implements TranslateMainInterface
{

    use Time;
    use SeoMain;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var CcmMediaImage
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage")
     */
    protected $image;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmParticiperPageLayerCollection", mappedBy="page", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $pageLayersCollection;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->pageLayersCollection = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getName();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getName()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getName();
        }

        return $string;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param ArrayCollection $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /**
     * @return CcmMediaImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param CcmMediaImage $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @param CcmParticiperPageLayerCollection $layerCollection
     * @return $this
     */
    public function addPageLayersCollection(\FDC\CourtMetrageBundle\Entity\CcmParticiperPageLayerCollection $layerCollection)
    {
        $layerCollection->setPage($this);
        $this->pageLayersCollection[] = $layerCollection;

        return $this;
    }

    /**
     * @param CcmParticiperPageLayerCollection $layerCollection
     */
    public function removePageLayersCollection(\FDC\CourtMetrageBundle\Entity\CcmParticiperPageLayerCollection $layerCollection)
    {
        $this->pageLayersCollection->removeElement($layerCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getPageLayersCollection()
    {
        return $this->pageLayersCollection;
    }
}